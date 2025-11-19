<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MemberShip;
use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
    {
        $subscriptions =Subscription::all();
        return response()->json([
            $subscriptions
        ]);
    }



/**
     * Store a newly created resource in storage.
*/
public function store(Request $request)
    {
        $validated=$request->validate([
            'user_id'=>'required|exists:users,id',
            'membership_id'=>'required|exists:memberships,id',
            'start_date'=>'required|date',
            'is_active'=>'sometimes',
        ]);
    $membershipPlan = Membership::findOrFail($validated['membership_id']);
    $startDate = Carbon::parse($validated['start_date']);
    

    $endDate = $startDate->copy()->addDays($membershipPlan->duration_days);

    $validated['end_date'] = $endDate->format('Y-m-d');

    $subscription = Subscription::create($validated);
    $membership=MemberShip::where('id',$subscription->membership_id)->first();
        $user_name=User::where('id',$subscription->user_id)->pluck('name')->first();
        Payment::create([
            'amount'=>$membership->price,
            'payment_date'=>Carbon::now(),
            'payment_method'=>'cash',
            'type'=>'income',
            'user_id'=>$subscription->user_id,
            'subscription_id'=>$subscription->id,
            'notes'=>'اشتراك اللاعب '. $user_name

        ]);
        return response()->json([
            'message' => 'subscription created successfully',
            'data'=>$subscription,
        ],201);

    }


public function show(string $id)
    {
        $subscription = Subscription::findOrFail($id);
        
        return response()->json(['data' => $subscription], 200);
    }

public function update(Request $request, string $id)
    {
        $subscription = Subscription::findOrFail($id);
        $validated = $request->validate([
            'user_id'       => 'sometimes|exists:users,id',
            'membership_id' => 'sometimes|exists:memberships,id',
            'start_date'    => 'sometimes|date',
            'is_active'     => 'sometimes|boolean',
            'end_date'      => 'prohibited', 
        ]);

        if ($request->has(['start_date', 'membership_id']) || $request->has('start_date') || $request->has('membership_id')) {
            $startDate = Carbon::parse($validated['start_date'] ?? $subscription->start_date);
            $membershipId = $validated['membership_id'] ?? $subscription->membership_id;
            $membershipPlan = Membership::findOrFail($membershipId);
            $endDate = $startDate->copy()->addDays($membershipPlan->duration_days);
            $validated['end_date'] = $endDate->format('Y-m-d');
        }

        $subscription->update($validated);

        return response()->json([
            'message' => 'Subscription updated successfully',
            'data'    => $subscription
        ], 200);
    }
/**
     * Remove the specified resource from storage.
*/
    public function destroy(string $id){
         $subscription = Subscription::find($id);
        if(!$subscription){
            return response()->json(['subscription not found'],401);
        }
        $subscription->delete($id);
        return response()->json(['message' => 'Susbcription deleted successfully']);
    }





















    }
