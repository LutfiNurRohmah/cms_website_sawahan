<?php

namespace App\Filament\Resources\PotensiPadukuhanResource\Pages;

use App\Filament\Resources\PotensiPadukuhanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPotensiPadukuhans extends ListRecords
{
    protected static string $resource = PotensiPadukuhanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Potensi'),
        ];
    }
}
