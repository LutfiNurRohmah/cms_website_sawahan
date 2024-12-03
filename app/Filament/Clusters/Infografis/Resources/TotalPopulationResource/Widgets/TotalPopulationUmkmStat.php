<?php

namespace App\Filament\Clusters\Infografis\Resources\TotalPopulationResource\Widgets;

use App\Models\TotalPopulation;
use App\Models\Umkm;
use App\Models\UmkmProduct;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalPopulationUmkmStat extends BaseWidget
{
    protected function getStats(): array
    {
        $totumkm = Umkm::all()->count();
        $totproduct = UmkmProduct::all()->count();
        $tot_population = TotalPopulation::sum('total_population');
        $tot_kk = TotalPopulation::sum('total_kk');
        return [
            Stat::make("Total UMKM", $totumkm),
            Stat::make("Total Produk UMKM", $totproduct),
            Stat::make("Jumlah Penduduk", $tot_population),
            Stat::make("Jumlah Kepala Keluarga", $tot_kk),
        ];
    }
}
