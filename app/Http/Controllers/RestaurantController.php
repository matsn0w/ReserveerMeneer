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
        $availableCategories = RestaurantCategory::all('name');

        $values = $this->applyCategoryFilter($request);

        return view('restaurants.index', ['restaurants' => $values['restaurants'], 'availableCategories' => $availableCategories, 'filter' => $values['filter']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $availableCategories = RestaurantCategory::all('name');
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
        $validatedAttributes = $this->validateRestaurant($request);
        $restaurant = Restaurant::create($validatedAttributes);   
        $this->openinghoursController->store($request, $restaurant);

        return redirect(Route('restaurants.show', $restaurant));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        if($restaurant == null) abort(404, "Page not found"); 

        $openingtimes = RestaurantOpeninghours::where('restaurant_id' , '=' , $restaurant->id)->get();

        return view('restaurants.show', ['restaurant' => $restaurant, 'openingtimes' => $openingtimes]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        $availableCategories = RestaurantCategory::all('name');
        $openingtimes = RestaurantOpeninghours::where('restaurant_id' , '=' , $restaurant->id)->get();

        return view('restaurants.edit', ['restaurant' => $restaurant, 'availableCategories' => $availableCategories, 'openingtimes' => $openingtimes]);
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
        $validatedAttributes = $this->validateRestaurant($request);
        $restaurant->update($validatedAttributes);
        $this->openinghoursController->update($request, $restaurant);

        return redirect(Route('restaurants.show', $restaurant));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        Restaurant::destroy($restaurant);
        return redirect('restaurants')->with('flash_message', 'Post deleted!');
    }

    public function validateRestaurant(Request $request) {
        return $request->validate([
            'name' => ['required', 'min:3', 'max:100'],
            'description' => ['required', 'min:1', 'max:1000'],
            'category' => ['required', new ContainsCategory()],
            'seats' => ['required', 'numeric', 'min:1']
        ]);
    }

    
    public function applyCategoryFilter($request) {
        $filter = $request->get('filter');
        $values = array('restaurants'=>"", 'filter'=>"");

        if(!empty($filter)) {
            request()->validate(['filter' => new ContainsCategory]);
            $values['restaurants'] = Restaurant::where('category', $filter)->paginate(8);
        } else {
            $values['restaurants'] = Restaurant::paginate(8);
        } 

        $values['filter'] = $filter;
        return $values; 
    }

    
}
