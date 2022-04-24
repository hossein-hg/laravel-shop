<?php

namespace App\Providers;

use App\Models\Content\Comment;
use App\Models\Notification;
use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrap();
        view()->composer('admin.layouts.header',function ($view){
            $view->with('unseenComments',Comment::query()->where('seen',0)->get());
            $view->with('notifications',Notification::query()->whereNull('read_at')->get());
        });


    }
}
