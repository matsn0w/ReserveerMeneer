<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use App\Models\Movie;
use App\Models\FilmEvent;
use Illuminate\Http\Request;

class FilmEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filmevents = FilmEvent::paginate(8);

        return view('filmevents.index', [
            'filmevents' => $filmevents
        ]);
    }

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
            // TODO: check for uniqeness
        ]);

        $filmevent = FilmEvent::create($validated);

        return redirect()->route('filmevents.show', [
            'filmevent' => $filmevent
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  FilmEvent  $filmevent
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
        $halls = Hall::all();
        $movies = Movie::all();

        return view('filmevents.edit', [
            'filmevent' => $filmevent,
            'halls' => $halls,
            'movies' => $movies
        ]);
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
        $validated = $request->validate([
            'hall_id' => ['required'],
            'movie_id' => ['required'],
            'start' => ['required'],
            // TODO: check for uniqeness
        ]);

        $filmevent->update($validated);

        session()->flash('success', 'Filmavond is opgeslagen!');

        return redirect()->route('filmevents.show', [
            'filmevent' => $filmevent
        ]);
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
