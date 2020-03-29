<?php

namespace App\Http\Controllers;

use App\Lunch;
use Illuminate\Http\Request;

class LunchController extends Controller
{
    public function index()
    {
        return view('lunches.home', [
            'week' => [
                '일', '월', '화', '수', '목', '금', '토'
            ],
            'lunches' => Lunch::today()->get()
        ]);
    }

    public function join(Lunch $lunch)
    {
        $lunch->users()->attach(auth()->id());

        return redirect(route('lunch_home'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lunch  $lunch
     * @return \Illuminate\Http\Response
     */
    public function show(Lunch $lunch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lunch  $lunch
     * @return \Illuminate\Http\Response
     */
    public function edit(Lunch $lunch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lunch  $lunch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lunch $lunch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lunch  $lunch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lunch $lunch)
    {
        //
    }
}
