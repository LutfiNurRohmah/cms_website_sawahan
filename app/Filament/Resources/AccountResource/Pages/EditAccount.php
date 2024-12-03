<?php

namespace App\Filament\Resources\AccountResource\Pages;

use App\Filament\Resources\AccountResource;
use App\Models\Account;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditAccount extends EditRecord
{
    protected static string $resource = AccountResource::class;

    protected static ?string $title = 'Edit Jenis Akun';


    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->after(function (Account $record) {
                if ($record->logo) {
                    Storage::disk('public')->delete($record->logo);
                }
            }),
        ];
    }
}
