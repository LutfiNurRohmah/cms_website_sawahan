<?php

namespace App\Filament\Clusters\Infografis\Resources\PopulationDistributionResource\Widgets;

use App\Models\PopulationDistribution;
use Filament\Widgets\ChartWidget;

class ReligionChart extends ChartWidget
{
    protected static ?string $heading = 'Persebaran Penduduk Berdasarkan Agama';

    // protected int | string | array $columnSpan = 'full';

    protected static ?string $maxHeight = '200px';

    protected function getData(): array
    {
        $religionData = PopulationDistribution::where('category', 'Agama') // Filter by category
            ->get();

        $labels = $religionData->pluck('sub_category')->toArray(); // Sub-categories as labels
        $counts = $religionData->pluck('total')->toArray();
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
