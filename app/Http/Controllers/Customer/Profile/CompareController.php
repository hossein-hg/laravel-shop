<?php

namespace App\Http\Controllers\Customer\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompareController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $compare = $user->compare;
        $products = $compare->products;
        return view('customer.profile.my-compares',compact('products'));

    }
}
