<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Auth;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Pengumuman;
use App\Models\Activity;

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
        view()->composer('*', function($view){
            if( Auth::user() ){
                $uid = Auth::user()->id;

                $me = User::where('id', $uid)->with('user_detail')->first();
                $view->with('me', $me);

                $jp = 0; $jk = 0;

                foreach (Pengumuman::get() as $key => $item) {
                   $exp = explode(',',$item->dilihat);
                   if(!in_array($uid, $exp)){
                       $jp += 1;
                   }
                }

                foreach (Activity::get() as $key => $item) {
                    $exp = explode(',',$item->dilihat);
                    if(!in_array($uid, $exp)){
                        $jk += 1;
                    }
                 }


                $view->with('notifPengumuman', $jp);
                $view->with('notifKegiatan', $jk);

            }
        });
    }
}
