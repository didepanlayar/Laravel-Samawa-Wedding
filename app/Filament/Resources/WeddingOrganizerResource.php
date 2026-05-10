<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WeddingOrganizerResource\Pages;
use App\Filament\Resources\WeddingOrganizerResource\RelationManagers;
use App\Models\WeddingOrganizer;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WeddingOrganizerResource extends Resource
{
    protected static ?string $model = WeddingOrganizer::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('phone')
                    ->required()
                    ->maxLength(255),
                FileUpload::make('icon')
                    ->required()
                    ->image()
                    ->disk('public')
                    ->directory('organizer')
                    ->visibility('public'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('phone'),
                ImageColumn::make('icon')
                    ->disk('public'),
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
            'index' => Pages\ListWeddingOrganizers::route('/'),
            'create' => Pages\CreateWeddingOrganizer::route('/create'),
            'edit' => Pages\EditWeddingOrganizer::route('/{record}/edit'),
        ];
    }
}
