<?php

namespace App\Filament\Admin\Resources\PKLResource\Pages;

use App\Filament\Admin\Resources\PKLResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPKLS extends ListRecords
{
    protected static string $resource = PKLResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
