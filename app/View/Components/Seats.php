<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Seats extends Component
{
    public $hall;

    public $reserved;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($hall, $reserved = [])
    {
        $this->hall = $hall;
        $this->reserved = $reserved;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.seats');
    }
}
