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
                'first_name' => 'required|max:120|min:1|regex:/^[ا-یa-zA-Zء-ي ]+$/u',
                'last_name' => 'required|max:120|min:1|regex:/^[ا-یa-zA-Zء-ي ]+$/u',
                'mobile' => ['required','digits:11'],
                'email' => ['required','string','email'],
                'password' => ['required','unique:users', Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised(), 'confirmed'],
                'image' => 'nullable|image|mimes:png,jpg,jpeg,gif',

            ];
        }
        else{

            return [
                'first_name' => 'required|max:120|min:1|regex:/^[ا-یa-zA-Zء-ي ]+$/u',
                'last_name' => 'required|max:120|min:1|regex:/^[ا-یa-zA-Zء-ي ]+$/u',
                'image' => 'nullable|image|mimes:png,jpg,jpeg,gif',

            ];
        }
    }
}
