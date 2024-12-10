<?php

namespace App\Providers\Filament;

use App\Filament\Clusters\Infografis\Resources\AgeGenderResource\Widgets\AgeGenderChart;
use App\Filament\Clusters\Infografis\Resources\PopulationDistributionResource\Widgets\EducationChart;
use App\Filament\Clusters\Infografis\Resources\PopulationDistributionResource\Widgets\JobChart;
use App\Filament\Clusters\Infografis\Resources\PopulationDistributionResource\Widgets\MarriedChart;
use App\Filament\Clusters\Infografis\Resources\PopulationDistributionResource\Widgets\ReligionChart;
use App\Filament\Clusters\Infografis\Resources\TotalPopulationResource\Widgets\TotalPopulation1Chart;
use App\Filament\Clusters\Infografis\Resources\TotalPopulationResource\Widgets\TotalPopulationChart;
use App\Filament\Clusters\Infografis\Resources\TotalPopulationResource\Widgets\TotalPopulationUmkmStat;
use App\Filament\Resources\UmkmResource\Widgets\UmkmChart;
use App\Filament\Resources\UmkmResource\Widgets\Umkmstats;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class EditorPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('editor')
            ->path('editor')
            ->login()
            ->colors([
                'primary' => Color::Blue,
            ])
            ->brandName('CMS Website Sawahan')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverClusters(in: app_path('Filament/Clusters'), for: 'App\\Filament\\Clusters')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                // Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
                TotalPopulationUmkmStat::class,
                UmkmChart::class,
                TotalPopulation1Chart::class,
                AgeGenderChart::class,
                EducationChart::class,
                JobChart::class,
                // MarriedChart::class,
                ReligionChart::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
