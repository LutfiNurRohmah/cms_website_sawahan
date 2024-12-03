<?php

namespace App\Filament\Clusters\Infografis\Resources\TotalPopulationResource\Pages;

use App\Filament\Clusters\Infografis\Resources\TotalPopulationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTotalPopulation extends EditRecord
{
    protected static string $resource = TotalPopulationResource::class;

    protected static ?string $title = 'Edit Data Populasi';

    protected function getHeaderActions(): array
    {
        // return auth()->user()->role === 'admin'
        //     ? [ Actions\DeleteAction::make() ]
        //     : [ ];

        return [ Actions\DeleteAction::make() ];
    }
}
