<?php

namespace App\Filament\Admin\Resources\Machines\Pages;

use App\Filament\Admin\Resources\Machines\MachineResource;
use App\Models\Machine;
use App\Models\Payment;
use Carbon\Carbon;
use Filament\Resources\Pages\CreateRecord;

class CreateMachine extends CreateRecord
{
    protected static string $resource = MachineResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
{
    if (!empty($data['image']) && $data['image'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
        $file = $data['image'];
        $fileName = 'Machine_' . now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();
        $file->storeAs('images', $fileName, 'machines'); // مجلد الصور داخل disk
        $data['image'] = $fileName;
    }

    return $data;
}

    protected function afterCreate():void{
        $machine = $this->record;
        $machine = Machine::findOrFail($machine->id);
        Payment::create([
            'machine_id' => $machine->id,
            'amount'          => $machine->price,
            'payment_date'    => Carbon::now('Asia/Damascus'),
            'type'            => 'expense',
            'payment_method'  =>  'cash',
            'notes'           => ' سعر شراء  '.  $machine->name
        ]);
    }

}
