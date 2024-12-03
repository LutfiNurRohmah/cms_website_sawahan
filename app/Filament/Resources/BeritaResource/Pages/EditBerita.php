<?php

namespace App\Filament\Resources\BeritaResource\Pages;

use App\Filament\Resources\BeritaResource;
use App\Models\Berita;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditBerita extends EditRecord
{
    protected static string $resource = BeritaResource::class;

    protected static ?string $title = 'Edit Berita';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->after(function (Berita $record) {
                if ($record->thumbnail) {
                    // Storage::disk('public')->delete($record->thumbnail);
                    foreach ($record->thumbnail as $ph) Storage::disk('public')->delete($ph);
                }
            }),
        ];
    }
}
