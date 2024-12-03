<?php

namespace App\Filament\Clusters\Infografis\Resources\AgeGenderResource\Widgets;

use App\Models\AgeGender;
use Filament\Widgets\ChartWidget;

class AgeGenderChart extends ChartWidget
{
    protected static ?string $heading = 'Persebaran Penduduk Berdasarkan Usia dan Jenis Kelamin';

    protected int | string | array $columnSpan = 'full';

    protected static ?string $maxHeight = '600px';

    protected function getData(): array
    {
        $data = AgeGender::select('age_group', 'total_male', 'total_female')->get();
        $labels = $data->pluck('age_group')->toArray();
        $maleData = $data->pluck('total_male')->map(fn($value) => -$value)->toArray();
        $femaleData = $data->pluck('total_female')->toArray();
        return [
            'labels' => $labels, // Age groups for x-axis
            'datasets' => [
                [
                    'label' => 'Laki-Laki',
                    'data' => $maleData, // Male population in each age group
                    'backgroundColor' => '#36A2EB', // Blue for males
                ],
                [
                    'label' => 'Perempuan',
                    'data' => $femaleData, // Female population in each age group
                    'backgroundColor' => '#FF6384', // Pink for females
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        $maxPopulation = AgeGender::selectRaw('MAX(total_male + total_female) as max_total')->value('max_total');

        return [
            'indexAxis' => 'y', // Horizontal bar chart
            'scales' => [
                'x' => [
                    'beginAtZero' => true,
                    'stacked' => true,
                    'min' => -$maxPopulation / 2, // Shift to the left
                    'max' => $maxPopulation / 2,  // Shift to the right
                ],
                'y' => [
                    'stacked' => true,
                ],
            ],
        ];
    }
}
