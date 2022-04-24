<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class CustomerUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (request()->method == "POST")
        {
            return [
                'email'=>'required|email|unique:users',
                'first_name'=>'required|max:120|min:1',
                'last_name'=>'required|max:120|min:1',
                'mobile'=>['required','digits:11','unique:users'],
                'password'=>['required',Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised(),'confirmed'],
                'image'=>['nullable','image','mimes:png,jpeg,jpg,gif'],
                'activation'=>'required|numeric|in:0,1'
            ];
        }
        else{
            return [
                'first_name'=>'required|max:120|min:1',
                'last_name'=>'required|max:120|min:1',
                'image'=>['nullable','image','mimes:png,jpeg,jpg,gif'],
                'activation'=>'required|numeric|in:0,1'
            ];
        }
    }
}
