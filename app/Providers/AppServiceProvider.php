<?php

namespace App\Providers;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\MenuController;
use Illuminate\Support\ServiceProvider;
use App\Models\Acceso;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        //Metodo para paginar
        /*Paginator::useBootstrap();
        $menuItems = Menu::where('estatus',True)->get();
        view()->share('options', $menuItems);*/
        Paginator::useBootstrap();
        view()->composer('*', function ($view) 
        {
            if (Auth::check()) {
                $menuItems = Acceso::where('rol',Auth::user()->rol_id)->where('estatus',True)->get();
                view()->share('options', $menuItems);
            }   
        });  
            //$userid =  Auth::user()->id;
        
        
    }
}
