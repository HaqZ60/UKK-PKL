<?php

namespace App\Filament\Admin\Resources\IndustriResource\Pages;

use App\Filament\Admin\Resources\IndustriResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIndustri extends EditRecord
{
    protected static string $resource = IndustriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
