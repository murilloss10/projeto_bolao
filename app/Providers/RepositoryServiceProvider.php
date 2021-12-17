<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\UsuarioRepository::class, \App\Repositories\UsuarioRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ClubeRepository::class, \App\Repositories\ClubeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PartidaRepository::class, \App\Repositories\PartidaRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ApostaRepository::class, \App\Repositories\ApostaRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\UserRepository::class, \App\Repositories\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\RelatorioRepository::class, \App\Repositories\RelatorioRepositoryEloquent::class);
        //:end-bindings:
    }
}
