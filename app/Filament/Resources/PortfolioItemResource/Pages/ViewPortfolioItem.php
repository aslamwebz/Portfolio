<?php

namespace App\Filament\Resources\PortfolioItemResource\Pages;

use App\Filament\Resources\PortfolioItemResource;
use Filament\Actions;
use Filament\Infolists\Components\ViewEntry;
use Filament\Infolists\Components\Section;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewPortfolioItem extends ViewRecord
{
    protected static string $resource = PortfolioItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Project Details')
                    ->schema([
                        TextEntry::make('title'),
                        TextEntry::make('category'),
                        TextEntry::make('description')
                            ->columnSpanFull(),
                    ])->columns(2),
                Section::make('Image')
                    ->schema([
                        ViewEntry::make('image')
                            ->label('')
                            ->view('filament.infolists.components.image-entry'),
                    ]),
                Section::make('Links & Technologies')
                    ->schema([
                        TextEntry::make('link')
                            ->label('Live Demo')
                            ->url(fn (string $state): string => $state)
                            ->openUrlInNewTab(),
                        TextEntry::make('github')
                            ->label('GitHub')
                            ->url(fn (string $state): string => $state)
                            ->openUrlInNewTab(),
                        TextEntry::make('technologies')
                            ->badge()
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }
}
