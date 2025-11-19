<?php

namespace App\Filament\Admin\Resources\Users\Pages;

use App\Filament\Admin\Resources\Users\UserResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $userRole = $data['role'] ?? null;

        // 🔐 تشفير كلمة السر فقط إذا تغيّرت
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        // 🖼️ حذف الصورة القديمة فقط إذا تغيّرت الصورة
        if (!empty($data['photo']) && $data['photo'] !== $record->photo) {
            if ($record->photo && Storage::disk('members')->exists($record->photo)) {
                Storage::disk('members')->delete($record->photo);
            }
        }

        // ✅ تحديث بيانات المستخدم
        $record->update($data);

        // ✅ تحديث الدور الجديد
        if ($userRole) {
            $record->syncRoles([$userRole]);
        }

        return $record;
    }
    protected function mutateFormDataBeforeCreate(array $data): array
{
    if (!empty($data['photo'])) {
        $file = $data['photo'];
        $name = $data['name'] ?? 'user';
        $data['photo'] = \Str::slug($name) . '-' . now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();
        $file->storeAs('', $data['photo'], 'members');
    }
    return $data;
}

}
