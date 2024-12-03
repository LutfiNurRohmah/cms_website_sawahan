<?php

namespace App\Filament\Clusters\Infografis\Resources\PopulationDistributionResource\Pages;

use App\Filament\Clusters\Infografis\Resources\PopulationDistributionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPopulationDistribution extends EditRecord
{
    protected static string $resource = PopulationDistributionResource::class;

    protected static ?string $title = 'Edit Data Persebaran Penduduk';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
