<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index()
{

    // جلب كل المستخدمين
    $members = User::where('trainer_id',null)->get(); // eager load roles

    // تهيئة البيانات لإرجاع الدور لكل مستخدم
    $data = $members->map(function ($member) {
        return [
            'id'    => $member->id,
            'name'  => $member->name,
            'email' => $member->email,
            'phone' => $member->phone,
            'photo' => $member->photo,
            'age' => Carbon::parse($member->birth_date)->age,
            'role'  => $member->getRoleNames(), // ترجع array بالأدوار
            'trainer_id'=>$member->tariner_id
        ];
    });

    return response()->json([
        'data' => $data
    ]);
}




    public function store(Request $request)
{
    $request->validate([
        'name'     => 'required|string',
        'email'    => 'required|email|unique:users',
        'password' => 'required|min:6',
        'birth_date'=> 'required',
        'role'     => 'required|string',
    ]);

    if($request->hasFile('photo')){
        $photo=$request->file('photo');
        $photoName=$request->name . '_'.date('Y-m-d').'.' .  $photo->getClientOriginalExtension();
        $path=$photo->storeAs('',$photoName,'members');
    }
    // إنشاء اليوزر مع تشفير الباسوورد
    $member = User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
        'birth_date'=> $request->birth_date,
        'phone'    => $request->phone,
        'photo'    => $path,
        'trainer_id'=>$request->trainer_id,
        'uid'  =>$request->uid
        ]);


            // تعيين الدور
        $member->assignRole($request->role);

         return response()->json([
        'message' => 'Member created successfully',
        'data'    => $member
        ], 201);
}


    // ✅ عرض عضو واحد

public function show($id)
{

    // جلب العضو
    $member = User::find($id);

    if (!$member) {
        return response()->json(['message' => 'Member not found'], 404);
    }

    // تجهيز البيانات للإرجاع
    $data = [
        'id'    => $member->id,
        'name'  => $member->name,
        'email' => $member->email,
        'phone' => $member->phone,
        'photo' => $member->photo,
        'age'   => Carbon::parse($member->birth_date)->age, // أو Carbon::parse($member->dob)->age لو عندك تاريخ ميلاد
        'role'  => $member->getRoleNames()
    ];

    return response()->json($data);
}


    // ✅ تعديل بيانات عضو
    public function update(Request $request, $id)
    {
            $member = User::find($id);

            if (!$member) {
                return response()->json(['message' => 'Member not found'], 404);
            }
            if($request->has('role')){
                $member->syncRoles([$request->role]);
            }

            $member->update($request->all());

            return response()->json([
                'message' => 'Member updated successfully',
                'data'    => $member,
                'role'    =>$member->getRoleNames(),
            ]);
    }

    // ✅ حذف عضو
    public function destroy($id)
    {
            $member = User::find($id);
            if (!$member) {
                return response()->json(['message' => 'Member not found'], 404);
            }
            $member->syncRoles([]);
            $member->delete();
            return response()->json(['message' => 'Member deleted successfully']);
    }


   public function showAllTrainres() {
        $trainers = User::role('trainer')->get();
    return response()->json($trainers, 200);
    }

}
