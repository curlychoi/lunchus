<?php

namespace App\Http\Controllers;

use App\Category;
use App\Exceptions\AlreadyRegisterTodayRestaurantException;
use App\Http\Requests\StoreRestaurantRequest;
use App\Lunch;
use App\Restaurant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class RestaurantController extends Controller
{
    public function index(Request $request)
    {
        return view('restaurants.list', [
            'categories' => Category::all(),
            'restaurants' => Restaurant::search($request->get('query'))->get(),
        ]);
    }

    public function create()
    {
        return view('restaurants.register', [
            'categories' => Category::all(),
            'restaurant' => new Restaurant(),
        ]);
    }

    public function store(StoreRestaurantRequest $request)
    {
        Restaurant::create([
            'category_id' => $request->post('category_id'),
            'name' => $request->post('name'),
            'url' => $request->post('url') ?? '',
            'walk_time' => $request->post('walk_time') ?? '',
            'memo' => $request->post('memo') ?? '',
        ]);

        return redirect(route('restaurants'));
    }

    public function show(Restaurant $restaurant)
    {
        return view ('restaurants.show', [
            'restaurant' => $restaurant,
        ]);
    }

    public function edit(Restaurant $restaurant)
    {
        return view ('restaurants.register', [
            'categories' => Category::all(),
            'restaurant' => $restaurant,
        ]);
    }

    public function update(Request $request, Restaurant $restaurant)
    {
        Restaurant::where('id', $restaurant->id)->update([
            'category_id' => $request->post('category_id'),
            'name' => $request->post('name'),
            'url' => $request->post('url'),
            'walk_time' => $request->post('walk_time'),
            'memo' => $request->post('memo'),
        ]);

        return redirect(route('restaurant_show', $restaurant->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        //
    }

    /**
     * @param Restaurant $restaurant
     * @return RedirectResponse|Redirector
     * @throws AlreadyRegisterTodayRestaurantException
     */
    public function toLunch(Restaurant $restaurant)
    {
        if (Lunch::todayRestaurant($restaurant->id)->exists()) {
            throw new AlreadyRegisterTodayRestaurantException();
        }

        $lunch = Lunch::create([
            'lunch_day' => now()->format('Y-m-d'),
            'restaurant_id' => $restaurant->id,
            'user_id' => auth()->id(),
        ]);

        return redirect(route('lunch_home'));
    }
}


