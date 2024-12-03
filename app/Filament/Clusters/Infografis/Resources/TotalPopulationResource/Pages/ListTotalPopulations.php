<?php

namespace App\Filament\Clusters\Infografis\Resources\TotalPopulationResource\Pages;

use App\Filament\Clusters\Infografis\Resources\TotalPopulationResource;
use App\Filament\Clusters\Infografis\Resources\TotalPopulationResource\Widgets\TotalPopulationChart;
use App\Filament\Clusters\Infografis\Resources\TotalPopulationResource\Widgets\TotalPopulationStat;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTotalPopulations extends ListRecords
{
    protected static string $resource = TotalPopulationResource::class;

    protected function getHeaderActions(): array
    {
        // return auth()->user()->role === 'admin'
        //     ? [ Actions\CreateAction::make()->label('Tambah Data RT') ]
        //     : [ ];

        return [Actions\CreateAction::make()->label('Tambah Data Populasi')];
    }

    protected function getHeaderWidgets():array
    {
        return [
            TotalPopulationStat::class,
        ];
    }

    protected function getFooterWidgets():array
    {
        return [
            TotalPopulationChart::class,
        ];
    }
}
