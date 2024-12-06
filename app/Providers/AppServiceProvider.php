<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\RoomRepositoryInterface;
use App\Repositories\RoomRepository;
use App\Repositories\BookingRepository;
use App\Repositories\BookingRepositoryInterface;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(RoomRepositoryInterface::class, RoomRepository::class);
        $this->app->bind(BookingRepositoryInterface::class, BookingRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
