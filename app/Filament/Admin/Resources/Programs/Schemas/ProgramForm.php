<?php

namespace App\Filament\Admin\Resources\Programs\Schemas;

use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use App\Models\User;
use Filament\Schemas\Schema;

class ProgramForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('name')
                ->label('اسم البرنامج')
                ->required()
                ->maxLength(255),

            Textarea::make('description')
                ->label('وصف البرنامج')
                ->rows(3)
                ->nullable(),
            Select::make('created_by')
                ->label('المدرب أو الأدمن')
                ->options(
                    User::role(['admin', 'trainer'])->pluck('name', 'id') // الأدوار يلي بدك ياها
                )
                ->searchable()
                ->required(),


          Select::make('assign_to')
            ->label('مخصص لليوزر')
            ->searchable()
            ->options(
                    User::role(['member'])->pluck('name', 'id') // الأدوار يلي بدك ياها
                )            ->nullable()
            ->helperText('إذا تركته فارغ → البرنامج عام للجميع')
        ]);
    }
}
