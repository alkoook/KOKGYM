<?php

namespace App\Filament\Admin\Resources\Users\Pages;

use App\Filament\Admin\Resources\Users\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    public function getTitle(): string
    {
        return 'إضافة مستخدم جديد';
    }

protected function handleRecordCreation(array $data): Model
{
    // إذا المستخدم ما كتب UID → ولّد واحد
    if (empty($data['uid'])) {

        do {
            $uid = rand(1000, 9999);
        } while (User::where('uid', $uid)->exists());

        $data['uid'] = $uid;
    }

    // استخرج الدور
    $userRole = $data['role'] ?? null;
    unset($data['role']);

    // إنشاء المستخدم
    $record = static::getModel()::create($data);

    // تعيين الدور
    if ($userRole) {
        $record->assignRole($userRole);
    }

    return $record; // 🔥 ضرورية يا زعيم
}

        public function mount(): void
    {
        // توليد رقم عشوائي وفريد عند فتح الفورم
        do {
            $this->uid = rand(1000, 9999);
        } while (User::where('uid', $this->uid)->exists());

        // املى الفورم مباشرة بالـ UID
        $this->form->fill([
            'uid' => $this->uid,
        ]);
    }

    protected function afterCreate(): void {}
}
