<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Requests\MovieRequest;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::paginate(10);

        return view('movies.index', [
            'movies' => $movies
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('movies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MovieRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MovieRequest $request)
    {
        $validated = $request->validated();

        $movie = Movie::create($validated);

        return view('movies.show', [
            'movie' => $movie
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        return view('movies.show', [
            'movie' => $movie
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        return view('movies.edit', [
            'movie' => $movie
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  MovieRequest  $request
     * @param  Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(MovieRequest $request, Movie $movie)
    {
        $validated = $request->validated();

        $movie->update($validated);

        return view('movies.show', [
            'movie' => $movie
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();

        session()->flash('success', 'Film is verwijderd!');

        return redirect()->route('movies.index');
    }
}
