<?php

namespace App\Filament\Clusters\Infografis\Resources\PopulationDistributionResource\Widgets;

use App\Models\PopulationDistribution;
use Filament\Widgets\ChartWidget;

class EducationChart extends ChartWidget
{
    protected static ?string $heading = 'Persebaran Penduduk Berdasarkan Pendidikan';

    // protected int | string | array $columnSpan = 'full';

    protected static ?string $maxHeight = '200px';

    protected function getData(): array
    {
        $educationData = PopulationDistribution::where('category', 'Pendidikan') // Filter by category
            ->get();

        $labels = $educationData->pluck('sub_category')->toArray(); // Sub-categories as labels
        $counts = $educationData->pluck('total')->toArray();
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
