<?php

namespace App\Http\Requests;

use DateTime;
use DateInterval;
use App\Models\Movie;
use Illuminate\Validation\Rule;
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
            'start' => [
                'required',
                new MaxMoviesPerHallPerDay($this->get('hall_id')),
                Rule::unique('filmevents')->where(function ($query) {
                    return $query->where('hall_id', $this->hall_id)
                       ->where('movie_id', $this->movie_id)
                       ->where('start', $this->start);
                 }),
            ],
        ];
    }

    public function messages()
    {
        return [
            'required' => '::attribute is verplicht.',
            'unique' => ':attribute is al bezet!'
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
