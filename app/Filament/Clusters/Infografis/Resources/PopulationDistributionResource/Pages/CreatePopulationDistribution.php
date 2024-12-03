<?php

namespace App\Filament\Clusters\Infografis\Resources\PopulationDistributionResource\Pages;

use App\Filament\Clusters\Infografis\Resources\PopulationDistributionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePopulationDistribution extends CreateRecord
{
    protected static string $resource = PopulationDistributionResource::class;

    protected static ?string $title = 'Tambah Data Persebaran Penduduk';

}
