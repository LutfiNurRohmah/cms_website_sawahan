<?php

namespace App\Filament\Resources\UmkmResource\Pages;

use App\Filament\Resources\UmkmResource;
use App\Models\Umkm;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class EditUmkm extends EditRecord
{
    protected static string $resource = UmkmResource::class;

    protected static ?string $title = 'Edit Data UMKM';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->after(function (Umkm $record) {
                if ($record->thumbnail) {
                    Storage::disk('public')->delete($record->thumbnail);
                }
            }),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $umkm = parent::handleRecordUpdate($record, $data);

        // Save related accounts
        if (isset($data['umkmAccount'])) {
            $umkm->umkmAccount()->delete();
            foreach ($data['umkmAccount'] as $account) {
                $umkm->umkmAccount()->create($account);
            }
        }

        // Save related products
        if (isset($data['umkmProduct'])) {
            $umkm->umkmProduct()->delete();
            foreach ($data['umkmProduct'] as $product) {
                $umkm->umkmProduct()->create($product);
            }
        }

        return $umkm;
    }

    protected function fillForm(): void
    {
        parent::fillForm();

        if ($this->record) {
            $this->form->fill([
                'umkm_name' => $this->record->umkm_name,
                'slug' => $this->record->slug,
                'umkm_category_id' => $this->record->umkm_category_id,
                'owner' => $this->record->owner,
                'contact' => $this->record->contact,
                'address' => $this->record->address,
                'description' => $this->record->description,
                'maps' => $this->record->maps,
                'thumbnail' => $this->record->thumbnail,
                'tags' => $this->record->tags,
                'published' => $this->record->published,
                'umkmAccount' => $this->record->umkmAccount ? $this->record->umkmAccount->map(fn($account) => [
                    'account_id' => $account->account_id,
                    'link' => $account->link,
                ])->toArray() : [],
                'umkmProduct' => $this->record->umkmProduct ? $this->record->umkmProduct->map(fn($product) => [
                    'name' => $product->name,
                    'price' => $product->price,
                    'description' => $product->description,
                    'thumbnail' => $product->thumbnail,
                ])->toArray() : [],
            ]);
        }
    }
}
