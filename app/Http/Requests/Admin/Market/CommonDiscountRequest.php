<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class CommonDiscountRequest extends FormRequest
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
        return [
            'title'=>'required|max:120',
            'percentage'=>'required|numeric|max:100',
            'discount_ceiling'=>'required|max:99999999999|numeric',
            'minimal_order_amount'=>'required|max:99999999999|numeric',
            'start_date'=>'required|numeric',
            'end_date'=>'required|numeric',
        ];
    }
}
