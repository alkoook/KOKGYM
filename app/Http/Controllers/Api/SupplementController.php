<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Supplement;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class SupplementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplements=Supplement::all();
        return response()->json($supplements, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'description'=>'sometimes',
            'type'=>'required',
            'purchase_price'=>'required',
            'quantity'=>'required|integer',
            'sale_price'=>'required',
            'origin_country'=>'sometimes',
            'usage'=>'sometimes'
        ]);
       $data= Supplement::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'type'=>$request->type,
            'purchase_price'=>$request->purchase_price,
            'sale_price'=>$request->sale_price,
            'origin_country'=>$request->origin_country,
            'usage'=>$request->usage,
        ]);
        return response()->json($data, 201);
    }



    public function purchaseSupplement(Request $request){
        if (!Auth::user()->can('manage supplements')) {
            return response()->json(['message' => 'Unauthorized action.'], 403);
        }
        $validated=$request->validate([
            'supplement_id'=>'required|exists:supplements,id',
            'quantity'=>'required',
            'payment_method'=> 'required'
        ]);
        $supplement=Supplement::findOrFail($validated['supplement_id']);
        DB::beginTransaction();
        try{
            $supplement->increment('quantity',$validated['quantity']);
            $payment=Payment::create([
                'supplement_id'=>$supplement->id,
                'amount'=>$supplement->purchase_price * $validated['quantity'],
                'payment_method'=>$validated['payment_method'],
                'payment_date'=> Carbon::now(),
                'type'=>'expense',
                'notes'=> 'سعر شراء ' . $validated['quantity'] . ' قطعة من ' . $supplement->name,
            ]);
            DB::commit();
            
            return response()->json([
                        'message' => 'تم الشراء و تسجيل الإيراد بنجاح.',
                        'remaining_stock' => $supplement->quantity,
                        'payment_details' => $payment
                    ], 201);            
                }
                   catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'فشل عملية الشراء. تم التراجع عن الخصم من المخزون.'], 500);
        }
        

    }


    public function saleSupplement(Request $request){
        if (!Auth::user()->can('manage supplements')) {
            return response()->json(['message' => 'Unauthorized action.'], 403);
        }
     $validated=   $request->validate([
            'user_id'=>'nullable|exists:users,id',
            'supplement_id'=>'required|exists:supplements,id',
            'quantity'=>'required',
            'payment_method'=>'required'
        ]);
    $supplement = Supplement::findOrFail($validated['supplement_id']); 
         if ($supplement->quantity < $validated['quantity']) {
            return response()->json([
                'message' => 'عذراً، الكمية المطلوبة غير متوفرة في المخزون. المتاح: ' . $supplement->quantity
            ], 422);
        }

            DB::beginTransaction();
        try {
            $supplement->decrement('quantity', $validated['quantity']);
            $payment = Payment::create([
                'user_id'         => $validated['user_id'] ?? null,
                'supplement_id'   => $supplement->id,
                'amount'          => $supplement->sale_price * $validated['quantity'],
                'payment_date'    => Carbon::now(),
                'payment_method'  => $validated['payment_method'],
                'type'            => 'income',
                'notes'           =>  ' ثمن بيع  '. $validated['quantity'] . ' قطعة من ' .  $supplement->name ?? null,
            ]);

            DB::commit();
            return response()->json([
                'message' => 'تم البيع وتسجيل الإيراد بنجاح.',
                'remaining_stock' => $supplement->quantity,
                'payment_details' => $payment
            ], 201); 
        }
            catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'فشل عملية البيع. تم التراجع عن الخصم من المخزون.'], 500);
        }
    }
    

    

        
      
        

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $supplement=Supplement::findOrFail($id);
        return response()->json($supplement, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $supplement = Supplement::findOrFail($id);
        $supplement->update(
            $request->all()
        );
        return response()->json($supplement, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplement = Supplement::findOrFail($id);
        $supplement->delete();
        return response()->json('Supplement is Deleted', 204);
    }
}
