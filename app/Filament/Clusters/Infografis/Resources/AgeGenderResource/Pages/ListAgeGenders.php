<?php

namespace App\Filament\Clusters\Infografis\Resources\AgeGenderResource\Pages;

use App\Filament\Clusters\Infografis\Resources\AgeGenderResource;
use App\Filament\Clusters\Infografis\Resources\AgeGenderResource\Widgets\AgeGenderChart;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAgeGenders extends ListRecords
{
    protected static string $resource = AgeGenderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Data'),
        ];
    }

    protected function getFooterWidgets():array
    {
        return [
            AgeGenderChart::class,
        ];
    }

}
