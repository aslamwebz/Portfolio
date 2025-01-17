<?php

namespace App\Filament\Resources\RestaurentResource\Pages;

use App\Filament\Resources\RestaurentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRestaurent extends EditRecord
{
    protected static string $resource = RestaurentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
