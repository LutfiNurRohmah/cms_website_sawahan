<?php

namespace App\Filament\Clusters\Infografis\Resources\AgeGenderResource\Pages;

use App\Filament\Clusters\Infografis\Resources\AgeGenderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAgeGender extends EditRecord
{
    protected static string $resource = AgeGenderResource::class;

    protected static ?string $title = 'Edit Data Data Umur dan Jenis Kelamin';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
