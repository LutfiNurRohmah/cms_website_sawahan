<?php

namespace App\Filament\Pages;

use App\Models\ProfilePadukuhan;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Exceptions\Halt;

class ProfilPadukuhan extends Page implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.profil-padukuhan';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'Informasi';

    public function mount():void {
        $profile = ProfilePadukuhan::firstOrNew();
        $this->form->fill($profile->attributesToArray());
    }

    public function form(Form $form): Form {
        return $form
        ->schema([
            MarkdownEditor::make('sejarah'),
            FileUpload::make('thumbnail_sejarah')->image()->disk('public')->directory('profile'),
            MarkdownEditor::make('deskripsi'),
            FileUpload::make('thumbnail_deskripsi')->image()->disk('public')->directory('profile'),
            MarkdownEditor::make('visi'),
            MarkdownEditor::make('misi'),
            FileUpload::make('struktur pemerintahan')->image()->disk('public')->directory('profile'),
            // FileUpload::make('peta_lokasi')->disk('public')->directory('profile'),
            TextInput::make('peta_lokasi')->label('Link Google Maps')
        ])->statePath('data')->columns(2);
    }

    protected function getFormActions(): array {
        return [
            Action::make('save')
            // ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
            ->label(__('Simpan '))
            ->submit('save'),
        ];
    }

    public function save(): void {
        try {
            $data = $this->form->getState();
            $profile = ProfilePadukuhan::firstOrNew();
            $profile->fill($data);
            $profile->save();
            // $profile->update($data);

            Notification::make()
            ->success()
            ->title(__('Data berhasil disimpan.'))
            ->send();
        } catch (Halt $exception) {
            return;
        } catch (\Exception $exception) {
            Notification::make()
                ->danger()
                ->title(__('Terjadi kesalahan.'))
                ->body($exception->getMessage())
                ->send();
        }
    }
}
