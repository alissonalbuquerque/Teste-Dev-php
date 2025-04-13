<?php

namespace App\Providers;

use App\Http\Resources\ClientResource;
use App\Repositories\Contracts\ClientRepositoryInterface;
use App\Repositories\Eloquent\ClientRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {       
        /** @var array */
        $bindings = [
            ClientRepositoryInterface::class => ClientRepository::class
        ];

        foreach($bindings as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ClientResource::withoutWrapping();
    }
}
