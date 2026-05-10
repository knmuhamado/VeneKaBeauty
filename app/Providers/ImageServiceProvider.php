<?php

// David Alejandro Gutiérrez Leal

namespace App\Providers;

use App\Interfaces\ImageStorage;
use App\Utils\ImageLocalStorage;
use App\Utils\ImageStorageService;
use Illuminate\Support\ServiceProvider;

class ImageServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ImageLocalStorage::class);
        $this->app->singleton(ImageStorageService::class);
        $this->app->bind(ImageStorage::class, ImageStorageService::class);
    }
}
