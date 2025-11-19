<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Machine;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MachineController extends Controller
{
    // جلب كل الماكينات (Member يرى جزء فقط)
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('admin') || $user->hasRole('trainer')) {
            $machines = Machine::all();
        } else {
            $machines = Machine::select('id', 'name', 'origin_country', 'target_muscles', 'image', 'video')->get();
        }

        return response()->json($machines, 200);
    }

    // إضافة ماكينة جديدة
   public function store(Request $request)
{

    $request->validate([
        'name'           => 'required|string|max:255',
        'origin_country' => 'nullable|string|max:255',
        'price'          => 'required|numeric|min:0',
        'image'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'payment_method' =>'required|in:cash,card,transfer'
    ]);
    $data = $request->only(['name', 'origin_country', 'target_muscles','price']);

    if ($request->hasFile('image')) {
    $image      = $request->file('image');
    $imageName  = $request->name . '_' . Carbon::now('Asia/Damascus')->format('Y-m-d_H-i-s') . '.' . $image->getClientOriginalExtension();

    $data['image'] = $image->storeAs('images', $imageName, 'machines');
}

    DB::beginTransaction(); 
    try{
    $machine = Machine::create($data);
    Payment::create([
        'machine_id'     => $machine->id,
        'amount'         => $machine->price,
        'payment_date'   => today(),
        'type'           => 'expense',
        'payment_method' => $request->payment_method,
        'notes'          => 'سعر شراء الماكينة ' . $machine->name
    ]);
    DB::commit();
    return response()->json($machine, 201);
    }
    catch (\Exception $e) {
            DB::rollBack();
    if (isset($data['image']) && \Storage::disk('machines')->exists($data['image'])) {
        \Storage::disk('machines')->delete($data['image']);
    }
        return response()->json(['message'=>'لم يتم إضافة الآلة و لا الدفعة'],500);
    }
}


    // مشاهدة ماكينة واحدة
    public function show($id)
    {
        $user = auth()->user();
        $machine = Machine::with('exercises')->findOrFail($id);

        if (!$user->hasRole('admin') && !$user->hasRole('trainer')) {
            $machine = $machine->only(['id', 'name', 'origin_country', 'target_muscles', 'image', 'video']);
        }

        return response()->json($machine, 200);
    }

public function update(Request $request, $id)
{
    $machine = Machine::findOrFail($id);
    $validated = $request->validate([
        'name' => 'sometimes|string|max:255',
        'price' => 'sometimes|numeric',
        'origin_country' => 'sometimes|string|max:255',
        'target_muscles' => 'sometimes|string|max:255',
        'image' => 'sometimes|file|image|max:2048',
    ]);
    // الصورة
    if ($request->hasFile('image')) {
        if ($machine->image && Storage::disk('machines')->exists($machine->image)) {
            Storage::disk('machines')->delete($machine->image); // ✅ الحذف الآمن
        }

        $image = $request->file('image');
        $imageName = ($request->name ?? $machine->name) . '_' . Carbon::now('Asia/Damascus')->format('Y-m-d_H-i-s') . '.' . $image->getClientOriginalExtension();
        $validated['image'] = $image->storeAs('images', $imageName, 'machines');
    }

        // تحديث كل الحقول يدوياً لضمان تعديلها
    $machine->update([
        'name' => $validated['name'] ?? $machine->name,
        'price' => $validated['price'] ?? $machine->price,
        'origin_country' => $validated['origin_country'] ?? $machine->origin_country,
        'target_muscles' => $validated['target_muscles'] ?? $machine->target_muscles,
        'image' => $validated['image'] ?? $machine->image,
    ]);
    return response()->json($machine, 200);
}


   public function destroy($id)
{
    $machine = Machine::findOrFail($id);
    // ✅ حذف الصورة إذا موجودة
    if ($machine->image && Storage::disk('machines')->exists($machine->image)) {
        Storage::disk('machines')->delete($machine->image);
    }

    $machine->delete();

    return response()->json(['message' => 'Machine deleted successfully'], 200);
}
public function logMaintenance(Request $request, $id)
{
    $validated = $request->validate([
        'amount'         => 'required|numeric|min:0',
        'payment_method' => 'required|in:cash,card,transfer',
        'notes'          => 'required|string|max:500', // ضروري لتفاصيل الصيانة
    ]);

    $machine = Machine::findOrFail($id);
    DB::beginTransaction();
    try {
        $payment = Payment::create([
            'machine_id'     => $machine->id,
            'amount'         => $validated['amount'],
            'payment_date'   => Carbon::now(),
            'type'           => 'expense', // نوع الدفعة هو مصروف
            'payment_metho' => $validated['payment_method'],
            'notes'          => $validated['notes'] . ' للـ  ' . $machine->name,
        ]);
        DB::commit();

        return response()->json([
            'message' => 'تم تسجيل مصروف الصيانة بنجاح.',
            'payment' => $payment
        ], 201);

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['message' => 'فشل تسجيل مصروف الصيانة. تم التراجع عن العملية.'], 500);
    }
}

}
