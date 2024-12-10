<?php

namespace App\Filament\Pages;

use App\Models\ContactInformation as ModelsContactInformation;
use App\Models\SocialMedia;
use Filament\Actions\Action;
use Filament\Actions\StaticAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Exceptions\Halt;
use Icetalker\FilamentTableRepeater\Forms\Components\TableRepeater;
use Illuminate\Support\Facades\Storage;

class ContactInformation extends Page implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    protected static string $view = 'filament.pages.contact-information';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Informasi';

    protected static ?string $title = 'Informasi Kontak';
    protected static ?string $navigationLabel = 'Informasi Kontak';

    public function mount() {
        $contact_info = ModelsContactInformation::firstOrNew();
        $socialMedia = SocialMedia::where('contact_information_id', $contact_info->id)->get();

        $data = $contact_info->toArray();
        $data['socialMedia'] = $socialMedia->map(function ($item) {
            return $item->only(['id', 'platform_name', 'link', 'logo']);
        })->toArray();

        $this->form->fill($data);
    }

    public function form(Form $form): Form
    {
        return $form->schema([

            Group::make()->schema([
                Section::make('Informasi Umum')
                ->schema([
                    TextInput::make('name')
                    ->required()
                    ->label('Nama Padukuhan'),
                TextInput::make('address')
                    ->label('Alamat')
                    ->required(),
                TextInput::make('email')
                    ->email()
                    ->label('Email'),
                TextInput::make('phone')
                    ->label('Nomor Telepon'),
                ])->columns(2)->columnSpan(2),

                Section::make('Gambar')
                ->collapsible()
                ->schema([
                    FileUpload::make('thumbnail')
                    ->hiddenLabel()
                    ->multiple()
                    ->image()
                    ->disk('public')->directory('info_image')
                ])->columnSpan(1),
            ])->columns(3),

            Section::make('Social Media')
                ->schema([
                TableRepeater::make('socialMedia')
                    ->hiddenLabel()
                    ->createItemButtonLabel('Tambah Sosial Media')
                    ->schema([
                        FileUpload::make('logo')
                            ->label('Logo Platform')
                            ->disk('public')->directory('logo_sosmed'),
                        TextInput::make('platform_name')
                            ->label('Jenis Platform')
                            ->required(),
                        TextInput::make('link')
                            ->label('Link Sosial Media')
                            ->url(),
                    ]),
                ])->collapsible()
        ])->statePath('data');
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
            $contact_info = ModelsContactInformation::firstOrNew();
            $contact_info->fill($data);
            $contact_info->save();

            SocialMedia::where('contact_information_id', $contact_info->id)->delete();

            if (!empty($data['socialMedia'])) {
                foreach ($data['socialMedia'] as $socialMediaData) {
                    $socialMedia = new SocialMedia();
                    $socialMedia->fill($socialMediaData); // Isi data platform_name, logo, link
                    $socialMedia->contact_information_id = $contact_info->id; // Hubungkan dengan ContactInformation
                    $socialMedia->save();
                }
            }

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
