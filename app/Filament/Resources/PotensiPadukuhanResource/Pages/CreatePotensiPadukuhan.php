<?php

namespace App\Filament\Resources\PotensiPadukuhanResource\Pages;

use App\Filament\Resources\PotensiPadukuhanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePotensiPadukuhan extends CreateRecord
{
    protected static string $resource = PotensiPadukuhanResource::class;

    protected static ?string $title = 'Tambah Potensi Padukuhan';

}
