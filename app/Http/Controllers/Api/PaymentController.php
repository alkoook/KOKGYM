<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    // الدوال القياسية (CRUD)

    public function index()
    {
        if (!Auth::user()->can('manage payments')) {
            return response()->json(['message' => 'Unauthorized action.'], 403);
        }
        
        $payments = Payment::all();
        return response()->json([
            'message' => 'All Payments',
            'data' => $payments
        ], 200);
    }

    public function store(Request $request)
    {
        if (!Auth::user()->can('manage payments')) {
            return response()->json(['message' => 'Unauthorized action.'], 403);
        }
        
        $validated = $request->validate([
            'user_id'         => 'nullable|exists:users,id',
            'subscription_id' => 'nullable|exists:subscriptions,id',
            'machine_id'      => 'nullable|exists:machines,id', 
            'supplement_id'   => 'nullable|exists:supplements,id',
            'amount'          => 'required|numeric|min:0',
            'payment_date'    => 'required|date',
            'payment_method'  => 'required|in:cash,card,transfer', 
            'type'            => 'required|in:expense,income', 
            'notes'           => 'nullable|string'
        ]);
        
        $foreignKeys = ['subscription_id', 'machine_id', 'supplement_id'];
        $filledKeys = collect($foreignKeys)->filter(fn($key) => !empty($validated[$key]))->count();
        
        if ($filledKeys > 1) {
             return response()->json(['message' => 'Only one item (Subscription, Machine, or Supplement) can be linked per payment record.'], 422);
        }

        $payment = Payment::create($validated);
        return response()->json([
            'message' => 'Payment Added Successfully',
            'data' => $payment,
        ], 201); 
    }

    public function show(string $id)
    {
        $payment = Payment::findOrFail($id); 
        
        if (!Auth::user()->can('manage payments') && Auth::id() !== $payment->user_id) {
            return response()->json(['message' => 'Unauthorized action.'], 403);
        }

        return response()->json([
            'data' => $payment
        ], 200);
    }

    public function update(Request $request, string $id)
    {
        if (!Auth::user()->can('manage payments')) {
            return response()->json(['message' => 'Unauthorized action.'], 403);
        }
        
        $payment = Payment::findOrFail($id); // 💡 استخدام findOrFail
        
        $validated = $request->validate([
            'user_id'         => 'nullable|exists:users,id',
            'subscription_id' => 'nullable|exists:subscriptions,id',
            'machine_id'      => 'nullable|exists:machines,id',
            'supplement_id'   => 'nullable|exists:supplements,id',
            'amount'          => 'sometimes|numeric|min:0',
            'payment_date'    => 'sometimes|date',
            'payment_method'  => 'sometimes|in:cash,card,transfer',
            'type'            => 'sometimes|in:expense,income',
            'notes'           => 'nullable|string'
        ]);
        
        $payment->update($validated);
        return response()->json(['data' => $payment], 200);
    }

    public function destroy(string $id)
    {
        if (!Auth::user()->can('manage payments')) {
            return response()->json(['message' => 'Unauthorized action.'], 403);
        }
        
        Payment::findOrFail($id)->delete(); // 💡 استخدام findOrFail
        return response()->json([
            'message' => 'Payment Deleted Successfully'
        ], 204); // 💡 استخدام 204 للحذف بنجاح (No Content)
    }

    // دوال العرض المخصصة (Custom Reading Functions)
    
    public function myPayments()
    {
        // هذه الدالة مخصصة فقط للعضو لرؤية سجل دفعاته
        $userId = Auth::id();
        $myPayments = Payment::where('user_id', $userId)->get();
        
        return response()->json(['data' => $myPayments], 200);
    }
}