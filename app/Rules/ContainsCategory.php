<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\RestaurantCategory;

class ContainsCategory implements Rule
{
    
    protected $categories;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->categories = RestaurantCategory::all()->unique('id');
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return ($this->categories->where('name', $value)->count() > 0);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Category must be selected out of given options';
    }
}
