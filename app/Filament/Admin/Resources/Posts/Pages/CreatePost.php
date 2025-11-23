<?php

namespace App\Filament\Admin\Resources\Posts\Pages;

use App\Filament\Admin\Resources\Posts\PostResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePost extends CreateRecord
{

    public function getTitle(): string
    {
        return 'إضافة منشور جديد';
    }

    protected static string $resource = PostResource::class;
}
