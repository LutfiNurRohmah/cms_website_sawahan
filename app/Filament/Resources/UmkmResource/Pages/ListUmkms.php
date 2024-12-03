<?php

namespace App\Filament\Resources\UmkmResource\Pages;

use App\Filament\Resources\UmkmResource;
use App\Filament\Resources\UmkmResource\Widgets\Umkmstats;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUmkms extends ListRecords
{
    protected static string $resource = UmkmResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah UMKM'),
        ];
    }

    protected function getHeaderWidgets():array
    {
        return [
            Umkmstats::class,
        ];
    }
}
