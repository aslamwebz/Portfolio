<?php

namespace App\Filament\Resources\HMCategoriesResource\Pages;

use App\Filament\Resources\HMCategoriesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHMCategories extends EditRecord
{
    protected static string $resource = HMCategoriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
