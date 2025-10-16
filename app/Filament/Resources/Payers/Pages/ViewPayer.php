<?php

namespace App\Filament\Resources\Payers\Pages;

use App\Filament\Resources\Payers\PayerResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPayer extends ViewRecord
{
    protected static string $resource = PayerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
