<?php

namespace App\Providers;

use App\Interfaces\ImageStorage;
use App\Utils\ImageGcsStorage;
use App\Utils\ImageLocalStorage;
use Illuminate\Support\ServiceProvider;

class ImageServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ImageStorage::class, function ($app, array $params) {
            $storage = $params['storage'];

            if ($storage == 'local') {
                return new ImageLocalStorage;
            } elseif ($storage == 'gcs') {
                return new ImageGcsStorage;
            }

            return new ImageLocalStorage;
        });
    }
}
