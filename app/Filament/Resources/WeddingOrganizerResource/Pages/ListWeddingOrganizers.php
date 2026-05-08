<?php

namespace App\Filament\Resources\WeddingOrganizerResource\Pages;

use App\Filament\Resources\WeddingOrganizerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWeddingOrganizers extends ListRecords
{
    protected static string $resource = WeddingOrganizerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
