<?php

namespace App\Filament\Clusters\Infografis\Resources;

use App\Filament\Clusters\Infografis;
use App\Filament\Clusters\Infografis\Resources\AgeGenderResource\Pages;
use App\Filament\Clusters\Infografis\Resources\AgeGenderResource\RelationManagers;
use App\Models\AgeGender;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AgeGenderResource extends Resource
{
    protected static ?string $model = AgeGender::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $pluralModelLabel = 'Usia dan Jenis Kelamin';

    protected static ?int $navigationSort = 4;

    // protected static ?string $cluster = Infografis::class;

    protected static ?string $navigationGroup = 'Infografis';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Persebaran Penduduk Berdasarkan Umur dan Gender')
                ->description('Isikan data persebaran penduduk padukuhan')
                ->schema([
                    TextInput::make('age_group')->label('Kelompok Umur')->unique(ignoreRecord: true)->required(),
                    TextInput::make('total_male')->label('Jumlah Laki-Laki')->numeric()->default(0),
                    TextInput::make('total_female')->label('Jumlah Perempuan')->numeric()->default(0),
                ])->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('age_group')->label('Kelompok Umur')->sortable()->searchable(),
                TextColumn::make('total_male')->label('Jumlah Laki-Laki')->sortable(),
                TextColumn::make('total_female')->label('Jumlah Perempuan')->sortable(),
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
            'index' => Pages\ListAgeGenders::route('/'),
            'create' => Pages\CreateAgeGender::route('/create'),
            'edit' => Pages\EditAgeGender::route('/{record}/edit'),
        ];
    }
}
