<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'subject'=>'required|min:5|max:50',
            'message'=>'required|min:5|max:500',
            'name'=>'required|min:5|max:50',
            'email'=>'required|min:5|max:50'
        ];
    }

    public function messages()
    {
        return [
            'subject.required'=>'Поле тема является обязательным.',
            'name.required'=>'Поле имя является обязательным.',
            'email.required'=>'Поле email является обязательным.',
            'message.required'=>'Поле сообщение является обязательным.',
        ];
    }
}
