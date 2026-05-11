<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WeddingPackageResource\Pages;
use App\Filament\Resources\WeddingPackageResource\RelationManagers;
use App\Models\BonusPackage;
use App\Models\WeddingPackage;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WeddingPackageResource extends Resource
{
    protected static ?string $model = WeddingPackage::class;

    protected static ?string $navigationIcon = 'heroicon-o-heart';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Details')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        FileUpload::make('thumbnail')
                            ->disk('public')
                            ->directory('packages')
                            ->visibility('public'),
                        Repeater::make('photos')
                            ->relationship('photos')
                            ->schema([
                                FileUpload::make('photo')
                                    ->required()
                                    ->disk('public')
                                    ->directory('packages/photos')
                                    ->visibility('public'),
                            ]),
                        Repeater::make('weddingBonusPackages')
                            ->relationship('weddingBonusPackages')
                            ->label('Wedding Bonus Packages')
                            ->schema([
                                Select::make('bonus_package_id')
                                    ->label('Bonus Package')
                                    ->options(BonusPackage::all()->pluck('name', 'id'))
                                    ->required()
                                    ->searchable(),
                            ]),
                    ]),
                Fieldset::make('Additional')
                    ->schema([
                        Textarea::make('about')
                            ->required(),
                        TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('IDR'),
                        Select::make('is_popular')
                            ->required()
                            ->options([
                                true => 'Popular',
                                false => 'Not Popular',
                            ]),
                        Select::make('city_id')
                            ->relationship('city', 'name')
                            ->required()
                            ->preload()
                            ->searchable(),
                        Select::make('wedding_organizer_id')
                            ->relationship('weddingOrganizer', 'name')
                            ->required()
                            ->preload()
                            ->searchable(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('weddingOrganizer.name'),
                ImageColumn::make('thumbnail')
                    ->disk('public'),
                IconColumn::make('is_popular')
                    ->label('Popular')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),
            ])
            ->filters([
                SelectFilter::make('city_id')
                    ->label('City')
                    ->relationship('city', 'name'),
                SelectFilter::make('wedding_organizer_id')
                    ->label('Wedding Organizer')
                    ->relationship('weddingOrganizer', 'name'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListWeddingPackages::route('/'),
            'create' => Pages\CreateWeddingPackage::route('/create'),
            'edit' => Pages\EditWeddingPackage::route('/{record}/edit'),
        ];
    }
}
