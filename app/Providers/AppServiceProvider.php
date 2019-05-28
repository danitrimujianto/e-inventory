<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Core\Readers\NotifLabelReader;


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



          view()->composer('*', function ($view)
          {
            if(Auth::user()){
              $handover = 0;
              $reader = new NotifLabelReader();
              $warehouse = $reader->getPendingWarehouse();
              $submission = $reader->getPendingSubmission();
              $acceptance = $reader->getPendingAcceptance();
              $retur = $reader->getPendingRetur();
              $requestTools = $reader->getPendingRequestTools();
              $maintenance = $reader->getPendingMaintenance();

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
              $view->with('requestTools', $requestTools );
              $view->with('maintenance', $maintenance );
            }
          });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
      // view()->composer('*', function ($view)
      // {
      //     $handover = 0;
      //     $reader = new NotifLabelReader();
      //     $warehouse = $reader->getPendingWarehouse();
      //     $submission = $reader->getPendingSubmission();
      //     $acceptance = $reader->getPendingAcceptance();
      //     $retur = $reader->getPendingRetur();
      //
      //     if(Auth::user()->usertype_id == 1){
      //       $handover = $warehouse;
      //     }else if(Auth::user()->usertype_id == 2){
      //       $handover = $warehouse+$acceptance+$retur;
      //     }else if(Auth::user()->usertype_id == 4){
      //       $handover = $submission+$acceptance+$retur;
      //     }
      //       // $handover = $warehouse+$submission+$acceptance+$retur;
      //
      //     //...with this variable
      //     $view->with('handover', $handover );
      //     $view->with('warehouse', $warehouse );
      //     $view->with('submission', $submission );
      //     $view->with('acceptance', $acceptance );
      //     $view->with('retur', $retur );
      // });
    }
}
