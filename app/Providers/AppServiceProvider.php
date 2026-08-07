<?php

namespace App\Providers;

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
        // Auto-cleanup leftover Vite hot-reload file if the dev server is not running
        if ($this->app->environment('local')) {
            $hotPath = public_path('hot');
            if (file_exists($hotPath)) {
                $url = trim(file_get_contents($hotPath));
                $parts = parse_url($url);
                if ($parts && isset($parts['host']) && isset($parts['port'])) {
                    $host = $parts['host'];
                    $port = $parts['port'];
                    
                    // Attempt a quick socket connection to Vite dev server (timeout 20ms)
                    $connection = @fsockopen($host, $port, $errno, $errstr, 0.02);
                    if (is_resource($connection)) {
                        fclose($connection);
                    } else {
                        // Vite dev server is not running, so delete the leftover hot-reload file
                        @unlink($hotPath);
                    }
                }
            }
        }
    }
}
