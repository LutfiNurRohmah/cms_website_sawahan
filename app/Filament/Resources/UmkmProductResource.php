<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UmkmProductResource\Pages;
use App\Filament\Resources\UmkmProductResource\RelationManagers;
use App\Models\Umkm;
use App\Models\UmkmProduct;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UmkmProductResource extends Resource
{
    protected static ?string $model = UmkmProduct::class;

    protected static ?string $navigationIcon = 'heroicon-o-receipt-percent';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'UMKM';

    protected static ?string $pluralModelLabel = 'Produk UMKM';
    protected static ?string $navigationLabel = 'Produk UMKM';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Produk')
                    ->description('Tambahkan informasi produk UMKM yang tersedia')
                    ->schema([
                        TextInput::make('name')->label('Nama Produk')->required(),
                        TextInput::make('price')->label('Harga Produk'),
                        MarkdownEditor::make('description')->label('Deskripsi Produk')->columnSpanFull(),
                    ])->columnSpan(2)->columns(2),

                Group::make()->schema([
                    Section::make()->schema([
                        Select::make('umkm_id')
                        ->label('UMKM')
                        ->options(Umkm::all()->pluck('umkm_name', 'id'))->required(),
                    ]),
                    Section::make()->schema([
                        FileUpload::make('thumbnail')->label('Gambar Produk')->image()->disk('public')->directory('product'),
                    ]),
                    Checkbox::make('published')
                ])
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')->label('Gambar'),
                TextColumn::make('name')->label('Nama Produk'),
                TextColumn::make('price')->label('Harga'),
                TextColumn::make('umkm.umkm_name')->label('UMKM'),
                CheckboxColumn::make('published')
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
            'index' => Pages\ListUmkmProducts::route('/'),
            'create' => Pages\CreateUmkmProduct::route('/create'),
            'edit' => Pages\EditUmkmProduct::route('/{record}/edit'),
        ];
    }
}