<?php

namespace App\Filament\Resources\ActivityResource\Pages;

use App\Filament\Resources\ActivityResource;
use App\Models\Activity;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditActivity extends EditRecord
{
    protected static string $resource = ActivityResource::class;

    protected static ?string $title = 'Edit Kegiatan Rutin';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->after(function (Activity $record) {
                if ($record->thumbnail) {
                    // Storage::disk('public')->delete($record->thumbnail);
                    foreach ($record->thumbnail as $ph) Storage::disk('public')->delete($ph);
                }
            }),
        ];
    }
}
