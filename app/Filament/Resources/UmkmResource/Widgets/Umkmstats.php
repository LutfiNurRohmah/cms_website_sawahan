<?php

namespace App\Filament\Resources\UmkmResource\Widgets;

use App\Models\Umkm;
use App\Models\UmkmProduct;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Umkmstats extends BaseWidget
{
    protected function getStats(): array
    {
        $totumkm = Umkm::all()->count();
        $totumkmpublished = Umkm::where("published", true)->count();
        $totumkmunpublished = Umkm::where("published", false)->count();
        $totproduct = UmkmProduct::all()->count();
        return [
            Stat::make("Total UMKM", $totumkm),
            Stat::make("Sudah dipublikasi", $totumkmpublished)->extraAttributes([
                'class' => 'cursor-pointer',
                'wire:click' => "\$dispatch('setStatusFilter', { filter: 'processed' })",
            ]),
            Stat::make("Belum dipublikasi", $totumkmunpublished),
            Stat::make("Total Produk UMKM", $totproduct),
        ];
    }
}
