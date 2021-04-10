<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use App\Models\Movie;
use App\Models\FilmEvent;
use Illuminate\Http\Request;
use App\Http\Requests\FilmEventRequest;

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
     * @param  FilmEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FilmEventRequest $request)
    {
        $validated = $request->validated();

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
     * @param  FilmEventRequest  $request
     * @param  FilmEvent  $filmevent
     * @return \Illuminate\Http\Response
     */
    public function update(FilmEventRequest $request, FilmEvent $filmevent)
    {
        $validated = $request->validated();

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
        $filmevent->delete();

        session()->flash('success', 'Filmavond is verwijderd!');

        return redirect()->route('filmevents.index');
    }
}
