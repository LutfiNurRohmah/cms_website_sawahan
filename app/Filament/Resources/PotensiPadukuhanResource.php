<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PotensiPadukuhanResource\Pages;
use App\Filament\Resources\PotensiPadukuhanResource\RelationManagers;
use App\Models\PotensiPadukuhan;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Grouping\Group as GroupingGroup;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PotensiPadukuhanResource extends Resource
{
    protected static ?string $model = PotensiPadukuhan::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    protected static ?string $pluralModelLabel = 'Potensi Padukuhan';

    protected static ?int $navigationSort = 6;

    protected static ?string $navigationGroup = 'Aktivitas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Tambah Potensi')
                ->description('Tambahkan potensi yang dimiliki padukuhan!')
                ->schema([
                    TextInput::make('category')->label('Bidang')->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(function(string $operation, string $state, Forms\Set $set) {
                            if ($operation === 'edit') {
                                return;
                            }
                            $slug = Str::slug($state);
                            $slug = 'potensi-' . $slug;
                            $originalSlug = $slug;

                            // Ensure slug is unique
                            $i = 1;
                            while (PotensiPadukuhan::where('slug', $slug)->exists()) {
                                $slug = $originalSlug . '-' . $i++;
                            }
                            $set('slug', $slug);
                        }),
                    TextInput::make('slug')->unique(ignoreRecord: true)->required(),
                    MarkdownEditor::make('description')->label('Deskripsi')->required()->columnSpanFull(),
                ])->columnSpan(2)->columns(2),

                Group::make()->schema([
                    Section::make('Gambar')
                    ->collapsible()
                    ->schema([
                        FileUpload::make('thumbnail')
                        ->hiddenLabel()
                        ->image()
                        ->maxSize(5120)
                    ->helperText("Max size: 5MB")
                        ->multiple()->disk('public')->directory('potensi'),
                    ]),
                    Section::make('Meta')->schema([
                    TagsInput::make('tags'),

                    ]),
                    Checkbox::make('published')->label('Tampilkan'),
                ])->columnSpan(1)
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                CheckboxColumn::make('published')->label('Tampilkan')->sortable(),
                TextColumn::make('category')->label('Bidang')->searchable()->sortable(),
                TextColumn::make('slug'),
                ImageColumn::make('thumbnail'),
                TextColumn::make('tags')->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->groups([
                GroupingGroup::make('published')->label('Terpublikasi')
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
            'index' => Pages\ListPotensiPadukuhans::route('/'),
            'create' => Pages\CreatePotensiPadukuhan::route('/create'),
            'edit' => Pages\EditPotensiPadukuhan::route('/{record}/edit'),
        ];
    }
}
