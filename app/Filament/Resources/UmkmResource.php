<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UmkmResource\Pages;
use App\Filament\Resources\UmkmResource\RelationManagers;
use App\Models\Account;
use App\Models\Umkm;
use App\Models\UmkmCategory;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Icetalker\FilamentTableRepeater\Forms\Components\TableRepeater;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class UmkmResource extends Resource
{
    protected static ?string $model = Umkm::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'UMKM';

    protected static ?string $pluralModelLabel = 'UMKM';

    protected static ?string $navigationLabel = 'UMKM';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Informasi UMKM')
                    ->schema([

                        Group::make()->schema([
                            TextInput::make('umkm_name')->required()->label('Nama UMKM')
                            ->live(onBlur: true)
                            ->afterStateUpdated(function(string $operation, string $state, Forms\Set $set) {
                                if ($operation === 'edit') {
                                    return;
                                }
                                $slug = Str::slug($state);
                                $slug = 'umkm-' . $slug;
                                $originalSlug = $slug;

                                // Ensure slug is unique
                                $i = 1;
                                while (Umkm::where('slug', $slug)->exists()) {
                                    $slug = $originalSlug . '-' . $i++;
                                }

                                $set('slug', $slug);
                            }),
                            TextInput::make('slug')
                            ->unique(ignoreRecord: true)
                                ->required(),
                            Select::make('umkm_category_id')
                            ->label('Kategori')
                            ->options(UmkmCategory::all()->pluck('name', 'id'))->required()
                            ->createOptionForm([
                                TextInput::make('name')->label('Kategori')->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function(string $operation, string $state, Forms\Set $set) {
                                        if ($operation === 'edit') {
                                            return;
                                        }
                                        $slug = Str::slug($state);
                                        $originalSlug = $slug;
                                        $i = 1;
                                        while (UmkmCategory::where('slug', $slug)->exists()) {
                                            $slug = $originalSlug . '-' . $i++;
                                        }
                                        $set('slug', $slug);
                                    }),
                                TextInput::make('slug')->required()->unique(ignoreRecord: true)
                            ])
                            ->createOptionUsing(function (array $data) {
                                $category = UmkmCategory::create($data);
                                return $category->id;
                            }),

                        ])->columnSpanFull()->columns(3),

                        TextInput::make('owner')
                            ->label('Pemilik')
                            ->required(),
                        TextInput::make('contact')
                            ->label('Nomor Telepon'),

                        TextInput::make('address')
                            ->label('Alamat'),
                        TextInput::make('maps')
                            ->label('Link Google Maps'),
                        MarkdownEditor::make('description')->label('Deskripsi')->columnSpanFull(),

                    ])->columns(2)->columnSpan(7),

                    Group::make()->schema([
                        Section::make('Gambar')
                        ->collapsible()
                        ->schema([
                            FileUpload::make('thumbnail')->image()->disk('public')->directory('umkm'),
                        ]),
                        Section::make('Meta')->schema([
                        TagsInput::make('tags'),

                        ]),
                        Checkbox::make('published'),
                    ])->columnSpan(3),
                ])->columns(10),

                Section::make('Akun Sosial Media dan E-Commerce UMKM')
                ->schema([
                    TableRepeater::make('umkmAccount')
                    ->hiddenLabel()
                    ->createItemButtonLabel('Tambah Akun')
                    ->schema([
                        Select::make('account_id')
                            ->label('Platform')
                            ->options(Account::all()->pluck('name', 'id'))->required()
                            ->createOptionForm([
                                TextInput::make('name')
                                ->label('Jenis Platform')->required(),
                                FileUpload::make('logo')->image()->disk('public')->directory('logo')->label('Logo Platform'),
                            ])
                            ->createOptionUsing(function (array $data) {
                                $account = Account::create($data);
                                return $account->id;
                            }),
                        TextInput::make('link')
                            ->label('Link Sosial Media')
                            ->url()
                            ->required(),
                    ]),
                ])->collapsible(),

                Section::make('Produk UMKM')
                ->schema([
                    TableRepeater::make('umkmProduct')
                    ->label('Produk UMKM')
                    ->hiddenLabel()
                    ->createItemButtonLabel('Tambah Produk')
                    ->schema([
                        TextInput::make('name')->label('Nama Produk')->required(),
                        TextInput::make('price')->label('Harga'),
                        TextInput::make('description')->label('Deskripsi'),
                        FileUpload::make('thumbnail')->label('Gambar Produk')
                            ->image()
                            ->disk('public')->directory('product'),
                    ]),
                ])->collapsible()

            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')->label('Gambar'),
                TextColumn::make('umkm_name')->label('Nama UMKM'),
                TextColumn::make('umkmCategory.name')->label('Kategori'),
                TextColumn::make('owner')->label('Pemilik'),
                TextColumn::make('contact')->label('No. Telepon'),
                CheckboxColumn::make('published'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUmkms::route('/'),
            'create' => Pages\CreateUmkm::route('/create'),
            'edit' => Pages\EditUmkm::route('/{record}/edit'),
        ];
    }
}
