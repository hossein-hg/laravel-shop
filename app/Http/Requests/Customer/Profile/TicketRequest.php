<?php

namespace App\Http\Requests\Customer\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;

class TicketRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rout = Request::route();

        if ($rout->getName() == "customer.profile.my-tickets.answer"){
            return [
                'description' => 'required|max:600|min:5',
            ];
        }
        return [
            'description' => 'required|max:600|min:5',
            'subject' => 'required|max:600|min:5',
            'priority_id' => 'required|exists:ticket_priorities,id',
            'category_id' => 'required|exists:ticket_categories,id',
            'file' => 'nullable|mimes:png,jpg,jpeg,gif,zip,rar,pdf,doc,docs',
        ];
    }
}
