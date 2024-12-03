<?php

namespace App\Filament\Clusters\Infografis\Resources\AgeGenderResource\Pages;

use App\Filament\Clusters\Infografis\Resources\AgeGenderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAgeGender extends CreateRecord
{
    protected static string $resource = AgeGenderResource::class;

    protected static ?string $title = 'Tambah Data Umur dan Jenis Kelamin';
}
