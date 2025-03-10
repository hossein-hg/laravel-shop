<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        if (request()->isMethod('post')){
            return [
                'name' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
                'introduction' => 'required|max:3000|min:5',
                'category_id' => 'required|min:1|max:100000000|regex:/^[0-9]+$/u|exists:product_categories,id',
                'brand_id' => 'required|min:1|max:100000000|regex:/^[0-9]+$/u|exists:brands,id',
                'image' => 'required|image|mimes:png,jpg,jpeg,gif',
                'tags' => 'required|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
                'height' => 'required|numeric',
                'weight' => 'required|numeric',
                'price' => 'required|numeric',
                'width' => 'required|numeric',
                'length' => 'required|numeric',
                'published_at' => 'required|numeric',
                'meat_key.*' => 'nullable',
                'meat_value.*' => 'nullable',
            ];
        }
        else{
            return [
                'name' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
                'introduction' => 'required|max:3000|min:5',
                'category_id' => 'required|min:1|max:100000000|regex:/^[0-9]+$/u|exists:product_categories,id',
                'brand_id' => 'required|min:1|max:100000000|regex:/^[0-9]+$/u|exists:brands,id',
                'image' => 'nullable|image|mimes:png,jpg,jpeg,gif',
                'tags' => 'required|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
                'height' => 'required|numeric',
                'weight' => 'required|numeric',
                'price' => 'required|numeric',
                'width' => 'required|numeric',
                'length' => 'required|numeric',
                'published_at' => 'required|numeric',
                'meat_key.*' => 'nullable',
                'meat_value.*' => 'nullable',
            ];
        }

    }
}
