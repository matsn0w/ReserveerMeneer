<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Rules\ContainsCategory;
use App\Models\RestaurantCategory;
use Illuminate\Support\Facades\DB;
use App\Models\RestaurantOpeninghours;
use App\Http\Requests\RestaurantRequest;
use Symfony\Component\Console\Input\Input;

class RestaurantController extends Controller
{
    protected $openinghoursController;

    public function __construct(RestaurantOpeninghoursController $controller)
    {
        $this->openinghoursController = $controller;
        $this->authorizeResource(Restaurant::class, 'restaurant');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $availableCategories = RestaurantCategory::all();

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
        foreach ($weekdays as $weekday) {
            $array[$weekday] = ["openinghour" => "00:00", "closinghour" => "00:00"];
        }

        return view('restaurants.create', ['availableCategories' => $availableCategories, 'openinghours' => $array]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RestaurantRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RestaurantRequest $request)
    {
        // validate the request
        $validatedAttributes = $request->validated();

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
     * @param  RestaurantRequest  $request
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(RestaurantRequest $request, Restaurant $restaurant)
    {
        // validate the request
        $validatedAttributes = $request->validated();

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

        session()->flash('success', 'Restaurant is verwijderd!');

        return redirect('restaurants');
    }

    public function applyCategoryFilter($request) {
        $validated = $request->validate([
            'filter' => ['nullable', 'exists:restaurant_categories,id']
        ]);

        $filter = null;
        if(request()->filled('filter')) {
            $filter = $validated['filter'];
        }

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
