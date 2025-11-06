<?php

declare(strict_types=1);

namespace App\Filament\Resources\HMCategoriesResource\Pages;

use App\Filament\Resources\HMCategoriesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHMCategories extends ListRecords
{
    protected static string $resource = HMCategoriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
