<?php

namespace App\Filament\Resources\FileResource\Pages;

use App\Filament\Resources\FileResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageFiles extends ManageRecords
{
    protected static string $resource = FileResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
