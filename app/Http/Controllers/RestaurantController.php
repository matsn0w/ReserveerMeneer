<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Models\RestaurantCategory;
use Illuminate\Support\Facades\DB;
use App\Models\RestaurantOpeninghours;
use App\Rules\ContainsCategory;
use Symfony\Component\Console\Input\Input;

class RestaurantController extends Controller
{
    protected $openinghoursController;
    public function __construct(RestaurantOpeninghoursController $controller)
    {
        $this->openinghoursController = $controller;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $availableCategories = RestaurantCategory::all();

        // we assume there is no filter set
        $request['filter'] = null;

        $values = $this->applyCategoryFilter($request);

        return view('restaurants.index', [
            'restaurants' => $values['restaurants'],
            'availableCategories' => $availableCategories,
            'filter' => $values['filter']]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $availableCategories = RestaurantCategory::all();
        $weekdays = ['Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag', 'Zaterdag', 'Zondag'];

        $array = [];
        foreach($weekdays as $weekday) {
            $array[$weekday] = ["openinghour" => "00:00", "closinghour" => "00:00"];
        }

        return view('restaurants.create', ['availableCategories' => $availableCategories, 'openinghours' => $array]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the request
        $validatedAttributes = $this->validateRestaurant($request);

        // create the restaurant
        $restaurant = Restaurant::create($validatedAttributes);
        $this->openinghoursController->store($request, $restaurant);

        return redirect()->route('restaurants.show', $restaurant);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        $openingtimes = RestaurantOpeninghours::where('restaurant_id' , '=' , $restaurant->id)->get();

        return view('restaurants.show', [
            'restaurant' => $restaurant,
            'openingtimes' => $openingtimes
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        $availableCategories = RestaurantCategory::all();
        $openingtimes = RestaurantOpeninghours::where('restaurant_id' , '=' , $restaurant->id)->get();

        return view('restaurants.edit', [
            'restaurant' => $restaurant,
            'availableCategories' => $availableCategories,
            'openingtimes' => $openingtimes
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        // validate the request
        $validatedAttributes = $this->validateRestaurant($request);

        // update the restaurant
        $restaurant->update($validatedAttributes);
        $this->openinghoursController->update($request, $restaurant);

        return redirect()->route('restaurants.show', $restaurant);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        // delete the restaurant
        $restaurant->delete();

        return redirect('restaurants')->with('flash_message', 'Restaurant verwijderd!');
    }

    public function validateRestaurant(Request $request) {
        return $request->validate([
            'name' => ['required', 'min:3', 'max:100'],
            'description' => ['required', 'min:1', 'max:1000'],
            'category_id' => ['required', 'exists:restaurant_categories,id'],
            'seats' => ['required', 'integer', 'min:1', 'max:1000']
        ]);
    }

    public function applyCategoryFilter($request) {
        $validated = $request->validate([
            'filter' => ['nullable', 'exists:restaurant_categories,id']
        ]);

        $filter = $validated['filter'];

        $values = array('restaurants' => "", 'filter' => "");

        if (empty($filter)) {
            // when no filter is set
            $values['restaurants'] = Restaurant::paginate(8);
        } else {
            // find the category
            $category = RestaurantCategory::where('id', $filter)->firstOrFail();

            // get the restaurants
            $values['restaurants'] = Restaurant::where('category_id', $category->id)->paginate(8);
            $values['filter'] = $filter;
        }

        return $values;
    }
}
