<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CinemaRequest extends FormRequest
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
            'name' => ['required', 'min:2'],
        ];
    }

    public function messages()
    {
        return [
            'required' => '::attribute is verplicht.',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Naam',
        ];
    }
}
