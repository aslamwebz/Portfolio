<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\HMCategoriesResource\Pages;
use App\Models\HMCategories;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HMCategoriesResource extends Resource
{
    protected static ?string $model = HMCategories::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('icon')
                    ->image()
                    ->required()
                    ->imagePreviewHeight('100')
                    ->directory('category-icons')
                    ->storeFileNamesIn('original_filename')
                    ->afterStateUpdated(function ($state, Forms\Set $set): void {
                        if ($state && is_string($state)) {
                            $originalName = pathinfo($state, PATHINFO_BASENAME);
                            $set('icon', json_encode(['url' => 'img/HeartyMeal/Categories/'.$originalName]));
                        }
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('icon')
                    ->circular()
                    ->size(40)
                    ->state(function ($record) {
                        $icon = null;
                        if (is_object($record) && isset($record->icon)) {
                            $icon = $record->icon;
                        } elseif (is_array($record) && isset($record['icon'])) {
                            $icon = $record['icon'];
                        }

                        if ($icon === null || ! is_string($icon)) {
                            return null;
                        }

                        /** @var array{url?: string}|null $iconData */
                        $iconData = json_decode($icon, true);

                        if (! is_array($iconData) || ! isset($iconData['url']) || ! is_string($iconData['url'])) {
                            return null;
                        }

                        return $iconData['url'];
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHMCategories::route('/'),
            'create' => Pages\CreateHMCategories::route('/create'),
            'edit' => Pages\EditHMCategories::route('/{record}/edit'),
        ];
    }
}
