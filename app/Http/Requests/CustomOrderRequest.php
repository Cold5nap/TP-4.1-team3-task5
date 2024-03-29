<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomOrderRequest extends FormRequest
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
            'selected_materials' => 'required',
            'address' => 'required|min:5|max:100',
            'name_surname' => 'required|min:5|max:50',
            'email' => 'required|min:5|max:50',
            'date' => 'required',
            'description'=>'nullable|min:15|max:500',
            'phone_number'=>'required',
            'token'=>'required',
        ];
    }
}
