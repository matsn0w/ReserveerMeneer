<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use App\Models\Seat;
use App\Models\Cinema;
use Illuminate\Http\Request;

class HallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $halls = Hall::paginate(10);

        return view('halls.index', [
            'halls' => $halls
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cinemas = Cinema::all();

        return view('halls.create', [
            'cinemas' => $cinemas
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
        // validate input
        $validated = $request->validate([
            'cinema_id' => ['required'],
            'name' => ['required', 'min:2'],
            'rows' => ['required', 'integer', 'min:1'],
            'seatsPerRow' => ['required', 'integer', 'min:1']
        ]);

        // create the hall
        $hall = Hall::create($validated);

        // generate seats
        $seats = [];

        // build seats for each row
        for ($row = 1; $row <= $hall->rows; $row++) {
            for ($number = 1; $number <= $hall->seatsPerRow; $number++) {
                $seat = Seat::factory()
                    ->state([
                        'hall_id' => $hall->id,
                        'row' => $row,
                        'number' => $number
                    ])
                    ->create();

                array_push($seats, $seat);
            }
        }

        // assign the seats to the hall
        $hall->seats = $seats;

        return view('halls.show', [
            'hall' => $hall
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function show(Hall $hall)
    {
        return view('halls.show', [
            'hall' => $hall
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function edit(Hall $hall)
    {
        // get all cinemas
        $cinemas = Cinema::all();

        return view('halls.edit', [
            'hall' => $hall,
            'cinemas' => $cinemas
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hall $hall)
    {
        // validate the request
        $validated = $request->validate([
            'cinema_id' => ['required'],
            'name' => ['required', 'min:2']
        ]);

        // update the hall
        $hall->update($validated);

        return view('halls.show', [
            'hall' => $hall
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hall $hall)
    {
        // delete the hall
        $hall->delete();

        // redirect to index
        return redirect()->route('halls.index');
    }
}
