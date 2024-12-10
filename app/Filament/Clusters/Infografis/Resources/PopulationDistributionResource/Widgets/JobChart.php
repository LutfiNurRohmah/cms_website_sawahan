<?php

namespace App\Filament\Clusters\Infografis\Resources\PopulationDistributionResource\Widgets;

use App\Models\PopulationDistribution;
use Filament\Widgets\ChartWidget;

class JobChart extends ChartWidget
{
    protected static ?string $heading = 'Persebaran Penduduk Berdasarkan Pekerjaan';

    protected int | string | array $columnSpan = 'full';

    protected static ?string $maxHeight = '200px';

    protected function getData(): array
    {
        $jobData = PopulationDistribution::where('category', 'Pekerjaan') // Filter by category
            ->get();

        $labels = $jobData->pluck('sub_category')->toArray(); // Sub-categories as labels
        $counts = $jobData->pluck('total')->toArray();
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
