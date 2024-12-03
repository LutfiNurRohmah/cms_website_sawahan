<?php

namespace App\Filament\Resources\UmkmResource\Widgets;

use App\Models\Umkm;
use App\Models\UmkmCategory;
use Filament\Widgets\ChartWidget;

class UmkmChart extends ChartWidget
{
    protected static ?string $heading = 'Persebaran Kategori UMKM';

    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $data = Umkm::selectRaw('umkm_category_id, COUNT(*) as count')
            ->groupBy('umkm_category_id')
            ->with('umkmCategory')
            ->get();

        $labels = $data->map(fn($item) => $item->umkmCategory->name ?? 'Unknown')->toArray();
        $values = $data->pluck('count')->toArray();

        return [
            'labels' => $labels, // Label untuk chart
            'datasets' => [
                [
                    'label' => 'Persebaran Kategori UMKM',
                    'data' => $values, // Nilai populasi
                    'backgroundColor' => [
                        '#9966FF', '#FF9F40', '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'
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
