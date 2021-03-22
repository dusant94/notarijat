<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
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
        view()->composer('*', function ($view)
        {
        $logged=Auth::user();
        $notifications = new Notification();
        $total_notifications = 0;
        $unreadNotificationsCount = 0;
         // Notifications
         if($logged){

         $notifications = $logged->notifications->toArray();
         $total_notifications = count($notifications);
         $unreadNotificationsCount = count($logged->unreadNotifications);
         }
        $view->with([
            'logged'=> $logged, 'notifications' => $notifications,'total_notifications' => $total_notifications,'unreadNotificationsCount'=>$unreadNotificationsCount]);
    });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
