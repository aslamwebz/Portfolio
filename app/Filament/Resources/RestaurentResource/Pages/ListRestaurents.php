<?php

namespace App\Filament\Resources\restaurantResource\Pages;

use App\Filament\Resources\restaurantResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class Listrestaurants extends ListRecords
{
    protected static string $resource = restaurantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
