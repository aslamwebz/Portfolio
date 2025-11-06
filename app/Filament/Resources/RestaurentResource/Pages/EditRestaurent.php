<?php

declare(strict_types=1);

namespace App\Filament\Resources\restaurantResource\Pages;

use App\Filament\Resources\restaurantResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class Editrestaurant extends EditRecord
{
    protected static string $resource = restaurantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
