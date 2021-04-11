<?php

namespace App\Http\Requests;

use App\Rules\MaxMoviesPerHallPerDay;
use Illuminate\Foundation\Http\FormRequest;

class FilmEventRequest extends FormRequest
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
            'hall_id' => ['required'],
            'movie_id' => ['required'],
            'start' => ['required', new MaxMoviesPerHallPerDay($this->get('hall_id'))],
            // TODO: check for uniqeness
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
            'hall_id' => 'Zaal',
            'movie_id' => 'Film',
            'start' => 'Starttijd',
        ];
    }
}
