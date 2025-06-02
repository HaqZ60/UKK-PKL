<?php

namespace App\Filament\Admin\Resources\PKLResource\Pages;

use App\Filament\Admin\Resources\PKLResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPKL extends EditRecord
{
    protected static string $resource = PKLResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
