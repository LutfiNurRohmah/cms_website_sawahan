<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityResource\Pages;
use App\Filament\Resources\ActivityResource\RelationManagers;
use App\Models\Activity;
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
use Filament\Tables\Table;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Grouping\Group as GroupingGroup;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ActivityResource extends Resource
{
    protected static ?string $model = Activity::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $pluralModelLabel = 'Kegiatan Rutin';

    protected static ?int $navigationSort = 8;

    protected static ?string $navigationGroup = 'Aktivitas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Tambah Kegiatan')
                ->description('Tambahkan kegiatan rutin yang ada di padukuhan')
                ->schema([
                    TextInput::make('name')->label('Nama Kegiatan')->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(function(string $operation, string $state, Forms\Set $set) {
                            if ($operation === 'edit') {
                                return;
                            }
                            $slug = Str::slug($state);
                            $slug = 'kegiatan-' . $slug;
                            $originalSlug = $slug;

                            // Ensure slug is unique
                            $i = 1;
                            while (Activity::where('slug', $slug)->exists()) {
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
                        ->maxSize(5120)
                        ->helperText("Max size: 5MB")
                        ->image()->multiple()->disk('public')->directory('kegiatan'),
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
                TextColumn::make('name')->label('Nama Kegiatan')->sortable()->searchable(),
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
            'index' => Pages\ListActivities::route('/'),
            'create' => Pages\CreateActivity::route('/create'),
            'edit' => Pages\EditActivity::route('/{record}/edit'),
        ];
    }
}
