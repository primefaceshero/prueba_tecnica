<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
//        Log::debug('---------------------------------------------------------------');
//        DB::listen(function ($query) {
//            Log::debug('DB::listen ', [
//                $query->sql,
//                $query->bindings,
//                $query->time
//            ]);
//        });
//        Log::debug('////////////////////////////////////////////////////////////////');

//        Log::info('sessions',[session()->all()]);
    }
}
