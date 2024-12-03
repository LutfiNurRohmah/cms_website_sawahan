<?php

namespace App\Filament\Clusters\Infografis\Resources\TotalPopulationResource\Widgets;

use App\Models\TotalPopulation;
use Filament\Widgets\ChartWidget;

class TotalPopulation1Chart extends ChartWidget
{
    protected static ?string $heading = 'Persebaran Penduduk Padukuhan Berdasarkan RT';

    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $data = TotalPopulation::select('rt_name', 'total_population')->get();
        $labels = $data->pluck('rt_name')->toArray();
        $values = $data->pluck('total_population')->toArray();

        return [
            'labels' => $labels, // Label untuk chart
            'datasets' => [
                [
                    'label' => 'Populasi Penduduk',
                    'data' => $values, // Nilai populasi
                    'backgroundColor' => [
                        '#FFCE56', '#4BC0C0', '#FF6384', '#36A2EB', '#9966FF', '#FF9F40'
                    ], // Warna untuk masing-masing slice
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
