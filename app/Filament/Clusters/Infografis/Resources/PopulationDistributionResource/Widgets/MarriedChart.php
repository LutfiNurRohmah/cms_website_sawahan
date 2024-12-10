<?php

namespace App\Filament\Clusters\Infografis\Resources\PopulationDistributionResource\Widgets;

use App\Models\PopulationDistribution;
use Filament\Widgets\ChartWidget;

class MarriedChart extends ChartWidget
{
    protected static ?string $heading = 'Persebaran Penduduk Berdasarkan Status Perkawinan';

    protected int | string | array $columnSpan = 'full';

    protected static ?string $maxHeight = '200px';

    protected function getData(): array
    {
        $marriedData = PopulationDistribution::where('category', 'Status Perkawinan') // Filter by category
            ->get();

        $labels = $marriedData->pluck('sub_category')->toArray(); // Sub-categories as labels
        $counts = $marriedData->pluck('total')->toArray();
        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Jumlah Penduduk',
                    'data' => $counts,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
