<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Core\Readers\NotifLabelReader;
use Session;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        // if(Session::has('user')){
          view()->composer('*', function ($view)
          {
              $reader = new NotifLabelReader();
              $warehouse = $reader->getPendingWarehouse();
              $submission = $reader->getPendingSubmission();
              $acceptance = $reader->getPendingAcceptance();
              $retur = $reader->getPendingRetur();

              if(Auth::user()->usertype_id == 1){
                $handover = $warehouse;
              }else if(Auth::user()->usertype_id == 2){
                $handover = $warehouse+$acceptance+$retur;
              }else if(Auth::user()->usertype_id == 4){
                $handover = $submission+$acceptance+$retur;
              }
                // $handover = $warehouse+$submission+$acceptance+$retur;

              //...with this variable
              $view->with('handover', $handover );
              $view->with('warehouse', $warehouse );
              $view->with('submission', $submission );
              $view->with('acceptance', $acceptance );
              $view->with('retur', $retur );
          });
        // }

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
