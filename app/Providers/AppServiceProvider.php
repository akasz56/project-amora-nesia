<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
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
        $provinces = DB::table('ref_province')->select('*')->get()->toArray();
        $orderstatuses = DB::table('ref_order_status')->select('*')->get()->toArray();
        view()->share('provinces', $provinces);
        view()->share('orderstatuses', $orderstatuses);
    }
}
