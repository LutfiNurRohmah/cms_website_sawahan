<?php

namespace App\Filament\Clusters\Infografis\Resources;

use App\Filament\Clusters\Infografis;
use App\Filament\Clusters\Infografis\Resources\TotalPopulationResource\Pages;
use App\Filament\Clusters\Infografis\Resources\TotalPopulationResource\RelationManagers;
use App\Models\TotalPopulation;
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

class TotalPopulationResource extends Resource
{
    protected static ?string $model = TotalPopulation::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-pie';

    protected static ?int $navigationSort = 3;

    protected static ?string $pluralModelLabel = 'Total Populasi';

    // protected static ?string $cluster = Infografis::class;

    protected static ?string $navigationGroup = 'Infografis';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Total Populasi Penduduk')
                ->description('Isikan data populasi penduduk padukuhan')
                ->schema([
                    TextInput::make('rt_name')->label('RT')->required(),
                    TextInput::make('total_population')->label('Total Penduduk')->numeric()->default(0),
                    TextInput::make('total_kk')->label('Jumlah Kepala Keluarga')->numeric()->default(0),
                    TextInput::make('total_male')->label('Jumlah Laki-Laki')->numeric()->default(0),
                    TextInput::make('total_female')->label('Jumlah Perempuan')->numeric()->default(0),
                ])->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('rt_name')->label('RT'),
                TextColumn::make('total_population')->label('Total Penduduk'),
                TextColumn::make('total_kk')->label('Total Kartu Keluarga'),
                TextColumn::make('total_male')->label('Total Laki-Laki'),
                TextColumn::make('total_female')->label('Total Perempuan'),
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
            'index' => Pages\ListTotalPopulations::route('/'),
            'create' => Pages\CreateTotalPopulation::route('/create'),
            'edit' => Pages\EditTotalPopulation::route('/{record}/edit'),
        ];
    }
}
