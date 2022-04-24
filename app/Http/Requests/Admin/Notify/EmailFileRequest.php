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

        if (request()->method == 'POST')
        {

            return [
                'file'=>'required|mimes:png,jpeg,jpg,pdf,zip,docx,doc',
            ];
        }
        else{
            return [
                'file'=>'mimes:png,jpeg,jpg,pdf,zip,docx,doc',
            ];
        }

    }
}
