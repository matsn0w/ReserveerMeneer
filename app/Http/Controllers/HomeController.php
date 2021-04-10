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

        $collection = $events->concat($filmevents)
            ->filter(function($event) {
                return $event->unified_date() >= date('Y-m-d');
            })
            ->sortBy(function($event) {
                return $event->unified_date();
            });

        return view('home', [
            'events' => $collection
        ]);
    }

    public function events($sort = null, $dateFrom = null, $dateTill = null)
    {
        // get all events
        $events = Event::all();
        $filmevents = FilmEvent::all();

        // combine
        $collection = $events->concat($filmevents)
            ->filter(function($event) {
                return $event->unified_date() >= date('Y-m-d');
            });

        // handle date ranges
        if (request()->filled('dateFrom')) {
            $collection = $collection->filter(function($event) {
                return $event->unified_date() >= request()->dateFrom;
            });
        }

        if (request()->filled('dateTill')) {
            $collection = $collection->filter(function($event) {
                return $event->start < request()->dateTill && $event->enddate < request()->dateTill;
            });
        }

        // handle sorting
        switch (request()->sort) {
            default:
            case 'date-asc':
                $collection = $collection->sortBy(function($event) {
                    return $event->unified_date();
                });
                break;

            case 'date-desc':
                $collection = $collection->sortByDesc(function($event) {
                    return $event->unified_date();
                });
                break;

            case 'name-asc':
                $collection = $collection->sortBy(function($event) {
                    return $event->name ?? $event->movie->name;
                }, SORT_NATURAL | SORT_FLAG_CASE); // sort case-insensitive
                break;

            case 'name-desc':
                $collection = $collection->sortByDesc(function($event) {
                    return $event->name ?? $event->movie->name;
                }, SORT_NATURAL | SORT_FLAG_CASE); // sort case-insensitive
                break;
        }

        return view('events', [
            'events' => $collection
        ]);
    }
}
