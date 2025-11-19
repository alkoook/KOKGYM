<?php

namespace App\Filament\Admin\Resources\Supplements\Pages;

use App\Filament\Admin\Resources\Supplements\SupplementResource;
use App\Models\Payment;
use App\Models\Supplement;
use Carbon\Carbon;
use Filament\Resources\Pages\CreateRecord;

class CreateSupplement extends CreateRecord
{
    protected static string $resource = SupplementResource::class;


     protected function afterCreate():void{
        $supplement = $this->record;
        $s = Supplement::findOrFail($supplement->id);
        Payment::create([
            'supplement_id' => $supplement->id,
            'amount'          => $supplement->purchase_price * $supplement->quantity,
            'payment_date'    => Carbon::now('Asia/Damascus'),
            'type'            => 'expense',
            'payment_method'  =>  'cash',
            'notes'           => ' سعر شراء  '.$supplement->quantity .' قطعة من ' .  $supplement->name
        ]);
    }

}
