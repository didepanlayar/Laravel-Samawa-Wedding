<?php

namespace App\Filament\Resources\BonusPackageResource\Pages;

use App\Filament\Resources\BonusPackageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBonusPackages extends ListRecords
{
    protected static string $resource = BonusPackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
