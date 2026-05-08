<?php

namespace App\Filament\Resources\WeddingTestimonialResource\Pages;

use App\Filament\Resources\WeddingTestimonialResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWeddingTestimonial extends EditRecord
{
    protected static string $resource = WeddingTestimonialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
