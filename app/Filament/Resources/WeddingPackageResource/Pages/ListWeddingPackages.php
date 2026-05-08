<?php

namespace App\Filament\Resources\WeddingPackageResource\Pages;

use App\Filament\Resources\WeddingPackageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWeddingPackages extends ListRecords
{
    protected static string $resource = WeddingPackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
