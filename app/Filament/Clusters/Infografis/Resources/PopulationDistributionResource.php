<?php

namespace App\Filament\Clusters\Infografis\Resources;

use App\Filament\Clusters\Infografis;
use App\Filament\Clusters\Infografis\Resources\PopulationDistributionResource\Pages;
use App\Filament\Clusters\Infografis\Resources\PopulationDistributionResource\RelationManagers;
use App\Models\PopulationDistribution;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PopulationDistributionResource extends Resource
{
    protected static ?string $model = PopulationDistribution::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $pluralModelLabel = 'Persebaran Penduduk';

    // protected static ?string $cluster = Infografis::class;

    protected static ?string $navigationGroup = 'Infografis';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Persebaran Penduduk')
                ->description('Isikan data persebaran penduduk padukuhan')
                ->schema([
                    TextInput::make('category')->label('Kategori')->required(),
                    TextInput::make('sub_category')->label('Sub Kategori')->unique()->required(),
                    TextInput::make('total')->label('Jumlah')->numeric()->default(0),
                ])->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('category')->label('Kategori')->sortable()->searchable(),
                TextColumn::make('sub_category')->label('Sub Kategori')->searchable(),
                TextColumn::make('total')->label('Jumlah')->sortable(),
            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultGroup('category')
            ->groups([
                Group::make('category')->label('Kategori')
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
            'index' => Pages\ListPopulationDistributions::route('/'),
            'create' => Pages\CreatePopulationDistribution::route('/create'),
            'edit' => Pages\EditPopulationDistribution::route('/{record}/edit'),
        ];
    }
}
