<?php

namespace App\Providers;

use App\Models\Content\Comment;
use App\Models\Market\CartItem;
use App\Models\Notification;
use App\Models\User\Role;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
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
            $view->with('notifications',Notification::query()->where('read_at',null)->get());


        });
        view()->composer('customer.layouts.header',function ($view){
            if (Auth::check()) {
                $view->with('cartItems',CartItem::query()->where('user_id', Auth::user()->id)->get());
            }
        });
    }
}
