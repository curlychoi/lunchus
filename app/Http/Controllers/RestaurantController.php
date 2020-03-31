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
            'restaurants' => Restaurant::query()
                ->search($request->get('query'))
                ->latest('id')
                ->get(),
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
            'user_id' => auth()->id(),
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

    public function update(StoreRestaurantRequest $request, Restaurant $restaurant)
    {
        $restaurant->update([
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
     * @param \App\Restaurant $restaurant
     * @return RedirectResponse|Redirector
     * @throws \Exception
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();

        return redirect(route('restaurants'));
    }

    /**
     * @param Restaurant $restaurant
     * @return RedirectResponse|Redirector
     * @throws AlreadyRegisterTodayRestaurantException
     */
    public function toLunch(Restaurant $restaurant)
    {
        $lunch = Lunch::firstOrcreate([
            'lunch_day' => now()->format('Y-m-d'),
            'restaurant_id' => $restaurant->id,
        ], [
            'user_id' => auth()->id(),
        ]);

        Lunch::dropTodayLunch(auth()->id());

        $lunch->users()->attach(auth()->id(), [
            'lunch_day' => now()->format('Y-m-d'),
            'created_at' => now(),
        ]);

        return redirect(route('lunch_home'));
    }
}


