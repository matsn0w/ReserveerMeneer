<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\FilmEvent;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::paginate(8);
        $films = FilmEvent::paginate(8);

        return view('events.index', [
            'events' => $events,
            'films' => $films
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedAttributes = $this->validateEvent($request);
        $event = Event::create($validatedAttributes);

        return redirect(Route('event.show', $event));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('events.show', ['event' => $event]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('events.edit', ['event' => $event]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $validatedAttributes = $this->validateEvent($request);
        $event->update($validatedAttributes);

        return redirect(Route('events.show', $event));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        Event::destroy($event);
        return redirect('events')->with('flash_message', 'Event deleted!');
    }

    public function validateEvent(Request $request) {
        return $request->validate([
            'name' => ['required', 'min:3', 'max:100'],
            'description' => ['required', 'min:1', 'max:1000'],
            'startdate' => ['required'],
            'endate' => ['required', 'after:'.$request->get('startdate')],
            'personMax' => ['required', 'numeric', 'min:1'],
        ]);
    }
}
