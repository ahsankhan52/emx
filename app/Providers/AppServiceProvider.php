<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function boot()
    {
        view()->composer('*', function ($view) {
            $settings = \App\Models\Setting::pluck('value', 'key')->toArray();
            $footerServices = \App\Models\Service::latest()->take(5)->get();

            // Format some JSON settings if they exist
            foreach ($settings as $key => $value) {
                if (in_array($key, ['phone_numbers', 'business_hours', 'social_links'])) {
                    $settings[$key] = json_decode($value, true) ?: [];
                }
            }

            $view->with([
                'settings' => $settings,
                'footerServices' => $footerServices
            ]);
        });
    }
}
