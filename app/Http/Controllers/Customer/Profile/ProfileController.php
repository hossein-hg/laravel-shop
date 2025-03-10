<?php

namespace App\Http\Controllers\Customer\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Profile\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('customer.profile.my-profile',compact('user'));
    }

    public function update(UpdateRequest $request)
    {

        $user = Auth::user();
        $user->update([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'national_code'=>$request->national_code,
        ]);
        return redirect()->back();
    }
}
