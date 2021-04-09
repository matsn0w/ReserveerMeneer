<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\FilmEvent;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // get both events and film events
        $events = Event::take(5)->get();
        $filmevents = FilmEvent::take(5)->get();

        $collection = $this->combineEvents($events, $filmevents);

        return view('home', [
            'events' => $collection
        ]);
    }

    public function events($sort = null)
    {
        switch (request()->sort) {
            default:
            case 'date-asc':
                $events = Event::all()->sortBy('startdate');
                $filmevents = FilmEvent::all()->sortBy('start');
                break;

            case 'date-desc':
                $events = Event::all()->sortByDesc('startdate');
                $filmevents = FilmEvent::all()->sortBy('start');
                break;

            case 'name-asc':
                $events = Event::all()->sortBy('name');
                $filmevents = FilmEvent::all()->sortBy('name');
                break;

            case 'name-desc':
                $events = Event::all()->sortByDesc('name');
                $filmevents = FilmEvent::all()->sortByDesc('name');
                break;
        }

        $collection = $this->combineEvents($events, $filmevents);

        return view('events', [
            'events' => $events
        ]);
    }

    private function combineEvents($collectionA, $collectionB)
    {
        // merge the two collections
        $collection = $collectionA->concat($collectionB);

        // sort by date (not by time)
        $collection = $collection->sortBy(function($item) {
            return $item->unified_date();
        });

        return $collection;
    }
}
