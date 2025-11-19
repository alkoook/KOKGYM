<?php

namespace App\Filament\Admin\Resources\Subscriptions\Pages;

use App\Filament\Admin\Resources\Subscriptions\SubscriptionResource;
use App\Models\MemberShip;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Filament\Resources\Pages\CreateRecord;

class CreateSubscription extends CreateRecord
{
    protected static string $resource = SubscriptionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $startDate = Carbon::parse($data['start_date']); 

        $membershipPlan = MemberShip::findOrFail($data['membership_id']);
        
        $endDate = $startDate->copy()->addDays($membershipPlan->duration_days);

        $data['end_date'] = $endDate;
        return $data; 
    }

    protected function afterCreate():void{
        $subscription = $this->record;
        $membershipPlan = MemberShip::findOrFail($subscription->membership_id);
        $playerName= User::findOrFail($subscription->user_id);
        Payment::create([
            'subscription_id' => $subscription->id,
            'user_id'         => $subscription->user_id,
            'amount'          => $membershipPlan->price,
            'payment_date'    => Carbon::today(),
            'type'            => 'income',
            'payment_method'  =>  'cash',
            'notes'           => 'اشتراك اللاعب ' .  $playerName->name
        ]);
    }
}
