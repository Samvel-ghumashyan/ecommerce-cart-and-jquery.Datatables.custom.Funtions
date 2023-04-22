<?php

namespace App\Providers;

use Exception;
use GeoIp2\Database\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class GeoIPServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('geoip', function () {
            $databasePath = base_path('database/geoip/GeoLite2-City.mmdb');

            if (!file_exists($databasePath)) {
                throw new Exception('GeoIP database not found at path: ' . $databasePath);
            }

            return new Reader($databasePath);
        });

        $this->app->bind('geoip.location', function ($app) {
           // $ip = $app['request']->getClientIp();
            $ipAddress = '93.185.32.21';

            return $app['geoip']->city($ipAddress)->location;
        });
    }
}
