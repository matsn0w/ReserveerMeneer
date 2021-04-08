<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use App\Models\Movie;
use App\Models\FilmEvent;
use Illuminate\Http\Request;

class FilmEventController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $halls = Hall::all();
        $movies = Movie::all();

        return view('filmevents.create', [
            'halls' => $halls,
            'movies' => $movies
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'hall_id' => ['required'],
            'movie_id' => ['required'],
            'start' => ['required'],
        ]);

        $filmevent = FilmEvent::create($validated);

        // TODO: missing parameter??
        return redirect()->route('filmevents.show')->with([
            'filmevent' => $filmevent
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FilmEvent  $filmEvent
     * @return \Illuminate\Http\Response
     */
    public function show(FilmEvent $filmevent)
    {
        return view('filmevents.show', [
            'filmevent' => $filmevent
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  FilmEvent  $filmevent
     * @return \Illuminate\Http\Response
     */
    public function edit(FilmEvent $filmevent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  FilmEvent  $filmevent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FilmEvent $filmevent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  FilmEvent  $filmevent
     * @return \Illuminate\Http\Response
     */
    public function destroy(FilmEvent $filmevent)
    {
        //
    }

    /**
     * Reserve the specified resource.
     *
     * @param  FilmEvent  $filmevent
     * @return \Illuminate\Http\Response
     */
    public function reserve(FilmEvent $filmevent)
    {
        //
    }
}
