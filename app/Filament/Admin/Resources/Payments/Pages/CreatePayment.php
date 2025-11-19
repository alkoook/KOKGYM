<?php

namespace App\Filament\Admin\Resources\Payments\Pages;

use App\Filament\Admin\Resources\Payments\PaymentResource;
use App\Models\Supplement;
use Filament\Resources\Pages\CreateRecord;

class CreatePayment extends CreateRecord
{
    protected static string $resource = PaymentResource::class;

    protected function afterCreate(): void
    {
        $record = $this->record;
        if ($record->supplement_id) {
            $supplement = Supplement::find($record->supplement_id);

            if ($supplement) {
                if ($record->type === 'income') {
                    $supplement->quantity -= ($record->amount)/$supplement->sale_price;
                }
                elseif ($record->type === 'expense') {
                    $supplement->quantity +=($record->amount)/$supplement->purchase_price ;
                }
                $supplement->save();
            }
        }
    }
}
