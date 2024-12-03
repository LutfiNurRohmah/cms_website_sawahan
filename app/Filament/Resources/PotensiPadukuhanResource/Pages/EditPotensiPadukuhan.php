<?php

namespace App\Filament\Resources\PotensiPadukuhanResource\Pages;

use App\Filament\Resources\PotensiPadukuhanResource;
use App\Models\PotensiPadukuhan;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditPotensiPadukuhan extends EditRecord
{
    protected static string $resource = PotensiPadukuhanResource::class;

    protected static ?string $title = 'Edit Potensi Padukuhan';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->after(function (PotensiPadukuhan $record) {
                if ($record->thumbnail) {
                    // Storage::disk('public')->delete($record->thumbnail);
                    foreach ($record->thumbnail as $ph) Storage::disk('public')->delete($ph);
                }
            }),
        ];
    }
}
