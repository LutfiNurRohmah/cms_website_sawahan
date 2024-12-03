<?php

namespace App\Filament\Resources\UmkmProductResource\Pages;

use App\Filament\Resources\UmkmProductResource;
use App\Models\UmkmProduct;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditUmkmProduct extends EditRecord
{
    protected static string $resource = UmkmProductResource::class;

    protected static ?string $title = 'Edit Produk UMKM';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->after(function (UmkmProduct $record) {
                if ($record->thumbnail) {
                    Storage::disk('public')->delete($record->thumbnail);
                }
            }),
        ];
    }
}
