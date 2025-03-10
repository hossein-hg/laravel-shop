<?php

namespace App\Http\Controllers\Customer\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\SalesProcess\StoreAddressRequest;
use App\Models\Market\Address;
use App\Models\Market\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index()
    {
        $provinces = Province::all();
        $addresses = Auth::user()->addresses;

        return view('customer.profile.my-addresses',compact('addresses','provinces'));
    }

    public function store(StoreAddressRequest $request)
    {
        $inputs = $request->all();
        $inputs['user_id'] = Auth::user()->id;
        Address::query()->create($inputs);
        return redirect()->back();
    }
}
