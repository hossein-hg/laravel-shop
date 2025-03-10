<?php

namespace App\Http\Middleware;

use App\Models\Market\CartItem;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileCompletion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()){
            return redirect()->route('auth.customer.login-register-form');
        }
        $user = Auth::user();
        if (empty($user->mobile) and  !empty($user->email) and empty($user->email_verified_at)){
            return redirect()->route('customer.sales-process.profile-completion');
        }
        if (empty($user->first_name) or empty($user->last_name) or empty($user->national_code)){
            return redirect()->route('customer.sales-process.profile-completion');
        }
        if (!empty($user->mobile) and  empty($user->email) and empty($user->mobile_verified_at)){
            return redirect()->route('customer.sales-process.profile-completion');
        }

        return $next($request);
    }
}
