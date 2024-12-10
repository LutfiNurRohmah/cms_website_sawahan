<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BeritaResource\Pages;
use App\Filament\Resources\BeritaResource\RelationManagers;
use App\Models\Berita;
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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BeritaResource extends Resource
{
    protected static ?string $model = Berita::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $pluralModelLabel = 'Berita Padukuhan';

    protected static ?int $navigationSort = 7;

    protected static ?string $navigationGroup = 'Aktivitas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Tambah Berita')
                ->description('Tambahkan berita terbaru seputar padukuhan')
                ->schema([
                    TextInput::make('title')->label('Judul')->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(function(string $operation, string $state, Forms\Set $set) {
                            if ($operation === 'edit') {
                                return;
                            }
                            $slug = Str::slug($state);
                            $slug = 'berita-' . $slug;
                            $originalSlug = $slug;

                            // Ensure slug is unique
                            $i = 1;
                            while (Berita::where('slug', $slug)->exists()) {
                                $slug = $originalSlug . '-' . $i++;
                            }
                            $set('slug', $slug);
                        }),
                    TextInput::make('slug')->unique(ignoreRecord: true)->required(),
                    TextInput::make('author')->required()->default(auth()->user()->name),
                    MarkdownEditor::make('body')->label('Deskripsi')->required()->columnSpanFull(),
                ])->columnSpan(2)->columns(2),

                Group::make()->schema([
                    Section::make('Gambar')
                    ->collapsible()
                    ->schema([
                        FileUpload::make('thumbnail')
                        ->hiddenLabel()
                        ->image()->multiple()->disk('public')->directory('berita'),
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
                TextColumn::make('title')->label('Judul')->searchable()->sortable(),
                // TextColumn::make('slug'),
                TextColumn::make('author')->searchable()->sortable(),
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
                GroupingGroup::make('published')->label('Terpublikasi'),
                GroupingGroup::make('author')
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
            'index' => Pages\ListBeritas::route('/'),
            'create' => Pages\CreateBerita::route('/create'),
            'edit' => Pages\EditBerita::route('/{record}/edit'),
        ];
    }
}
