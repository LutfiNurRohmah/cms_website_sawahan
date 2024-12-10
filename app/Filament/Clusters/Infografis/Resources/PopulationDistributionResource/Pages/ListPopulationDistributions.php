<?php

namespace App\Filament\Clusters\Infografis\Resources\PopulationDistributionResource\Pages;

use App\Filament\Clusters\Infografis\Resources\PopulationDistributionResource;
use App\Filament\Clusters\Infografis\Resources\PopulationDistributionResource\Widgets\EducationChart;
use App\Filament\Clusters\Infografis\Resources\PopulationDistributionResource\Widgets\JobChart;
use App\Filament\Clusters\Infografis\Resources\PopulationDistributionResource\Widgets\MarriedChart;
use App\Filament\Clusters\Infografis\Resources\PopulationDistributionResource\Widgets\ReligionChart;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPopulationDistributions extends ListRecords
{
    protected static string $resource = PopulationDistributionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Kategori'),
        ];
    }

    protected function getFooterWidgets():array
    {
        return [
            EducationChart::class,
            JobChart::class,
            // MarriedChart::class,
            ReligionChart::class,
        ];
    }
}
