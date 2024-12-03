<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $toteditor = User::where("role", "editor")->count();
        $totadmin = User::where("role", "admin")->count();
        return [
            Stat::make("Username", auth()->user()->name),
            Stat::make("Total Admin", $totadmin),
            Stat::make("Total Editor", $toteditor),
        ];
    }
}
