<?php

namespace App\Filament\Resources\UmkmResource\Pages;

use App\Filament\Resources\UmkmResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateUmkm extends CreateRecord
{
    protected static string $resource = UmkmResource::class;

    protected static ?string $title = 'Tambah Data UMKM';

    protected function handleRecordCreation(array $data): Model
    {
        $umkm = parent::handleRecordCreation($data);

        // Save related accounts
        if (isset($data['umkmAccount'])) {
            foreach ($data['umkmAccount'] as $account) {
                $umkm->umkmAccount()->create($account);
            }
        }

        // Save related products
        if (isset($data['umkmProduct'])) {
            foreach ($data['umkmProduct'] as $product) {
                $umkm->umkmProduct()->create($product);
            }
        }

        return $umkm;
    }
}
