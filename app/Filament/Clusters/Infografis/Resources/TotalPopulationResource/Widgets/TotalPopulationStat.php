<?php

namespace App\Filament\Clusters\Infografis\Resources\TotalPopulationResource\Widgets;

use App\Models\TotalPopulation;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalPopulationStat extends BaseWidget
{
    protected function getStats(): array
    {
        $tot_population = TotalPopulation::sum('total_population');
        $tot_kk = TotalPopulation::sum('total_kk');
        $tot_male = TotalPopulation::sum('total_male');
        $tot_female = TotalPopulation::sum('total_female');
        return [
            Stat::make("Jumlah Penduduk", $tot_population),
            Stat::make("Jumlah Kepala Keluarga", $tot_kk),
            Stat::make("Jumlah Laki-Laki", $tot_male),
            Stat::make("Jumlah Perempuan", $tot_female),
        ];
    }
}
