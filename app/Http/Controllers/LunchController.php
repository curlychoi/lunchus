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
            'lunches' => Lunch::today()->get()/*->sortByDesc(function ($lunch) {
                return $lunch->users->count();
            })*/
        ]);
    }

    public function join(Lunch $lunch)
    {
        Lunch::dropTodayLunch(auth()->id());

        $lunch->users()->attach(auth()->id(), [
            'lunch_day' => now()->format('Y-m-d'),
            'created_at' => now(),
        ]);

        return redirect(route('lunch_home'));
    }

    public function userDelete()
    {
        Lunch::dropTodayLunch(auth()->id());

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
     * @param \App\Lunch $lunch
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Lunch $lunch)
    {
        if ($lunch->users->count()) {
            abort(403, '참여자가 있어 삭제가 안되지롱ㅋㅋ');
        }
        $lunch->delete();

        return redirect(route('lunch_home'));
    }


}
