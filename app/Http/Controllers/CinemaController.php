<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use Illuminate\Http\Request;
use App\Http\Requests\CinemaRequest;

class CinemaController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Cinema::class, 'cinema');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cinemas = Cinema::all();

        return view('cinemas.index', [
            'cinemas' => $cinemas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cinemas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CinemaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CinemaRequest $request)
    {
        $validated = $request->validated();

        $cinema = Cinema::create($validated);

        return view('cinemas.show', [
            'cinema' => $cinema
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cinema  $cinema
     * @return \Illuminate\Http\Response
     */
    public function show(Cinema $cinema)
    {
        return view('cinemas.show', [
            'cinema' => $cinema
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cinema  $cinema
     * @return \Illuminate\Http\Response
     */
    public function edit(Cinema $cinema)
    {
        return view('cinemas.edit', [
            'cinema' => $cinema
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CinemaRequest  $request
     * @param  \App\Models\Cinema  $cinema
     * @return \Illuminate\Http\Response
     */
    public function update(CinemaRequest $request, Cinema $cinema)
    {
        $validated = $request->validate();

        $cinema->update($validated);

        return view('cinemas.show', [
            'cinema' => $cinema
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cinema  $cinema
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cinema $cinema)
    {
        $cinema->delete();

        session()->flash('success', 'Bioscoop is verwijderd!');

        return redirect()->route('cinemas.index');
    }
}
