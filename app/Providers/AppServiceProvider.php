<?php

namespace App\Providers;

use App\Models\ContactInformation;
use App\Models\SocialMedia;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::share('contact_information', ContactInformation::first());
        View::composer('*', function ($view) {
            $contact = ContactInformation::first();
            $view->with('social_media', $contact ? SocialMedia::where("contact_information_id", $contact->id)->get() : collect());
        });
    }
}
