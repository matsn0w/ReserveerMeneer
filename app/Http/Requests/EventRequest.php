<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'name' => ['required', 'min:3', 'max:100'],
            'description' => ['required', 'min:1', 'max:1000'],
            'startdate' => ['required'],
            'endate' => ['required', 'after:startdate'],
            'personMax' => ['required', 'numeric', 'min:1'],
        ];
    }
}
