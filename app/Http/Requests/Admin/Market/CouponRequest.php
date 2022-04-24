<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'code'=>'required|max:1200',
            'amount'=>[request()->amount_type == 0 ? 'max:100' : '','required','numeric'],
            'amount_type'=>'required|numeric|in:0,1',
            'discount_ceiling'=>'required|max:99999999999|numeric',
            'type'=>'required|numeric|in:0,1',
            'user_id'=>[request()->type == 1 ? 'required' : '','numeric','exists:users,id'],
            'start_date'=>'required|numeric',
            'end_date'=>'required|numeric',
        ];
    }

    public function attributes()
    {
        return [
            'amount'=>'میزان تخفیف',
            'code'=>'کد تخفیف',
            'user_id'=>'کاربر',
        ];
    }
}
