<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WeddingTestimonialResource\Pages;
use App\Filament\Resources\WeddingTestimonialResource\RelationManagers;
use App\Models\WeddingTestimonial;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WeddingTestimonialResource extends Resource
{
    protected static ?string $model = WeddingTestimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('occupation')
                    ->required()
                    ->maxLength(255),
                FileUpload::make('photo')
                    ->required()
                    ->image()
                    ->disk('public')
                    ->directory('testimonials')
                    ->visibility('public'),
                Select::make('wedding_package_id')
                    ->relationship('weddingPackage', 'name')
                    ->label('Wedding Package')
                    ->required()
                    ->preload()
                    ->searchable(),
                Textarea::make('message')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')
                    ->circular(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('weddingPackage.name')
                    ->label('Wedding Package'),
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
            'index' => Pages\ListWeddingTestimonials::route('/'),
            'create' => Pages\CreateWeddingTestimonial::route('/create'),
            'edit' => Pages\EditWeddingTestimonial::route('/{record}/edit'),
        ];
    }
}
