<?php

namespace App\Http\Requests\Admin\Notify;

use Illuminate\Foundation\Http\FormRequest;

class EmailFileRequest extends FormRequest
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
        if($this->isMethod('post')){
            return [
                'file' => 'required|mimes:png,jpg,jpeg,gif,zip,rar,pdf,doc,docs',
            ];
        }
        else{
            return [
                'file' => 'required|mimes:png,jpg,jpeg,gif,zip,rar,pdf,doc,docs',
            ];
        }

    }
}
