<?php

namespace App\Filament\Clusters\Infografis\Resources\TotalPopulationResource\Pages;

use App\Filament\Clusters\Infografis\Resources\TotalPopulationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTotalPopulation extends CreateRecord
{
    protected static string $resource = TotalPopulationResource::class;

    protected static ?string $title = 'Tambah Data Populasi';
}
