<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class EventsController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        // dd($request);

        $time_start = \Carbon\Carbon::parse($request->time_start);
        $time_end = \Carbon\Carbon::parse($request->time_end);
        $alarm = \Carbon\Carbon::parse($request->time_start)->subMinutes((int)$request->alarm);

        $event = new Event();
        $event->name = $request->name;
        $event->time_start = $time_start;
        $event->time_end = $time_end;
        $event->alarm = $alarm;
        $event->details = $request->details;
        $event->user_id = $request->user_id;
        $event->save();

        return response()->json([
            'status' => 'ok',
            'message' => 'Event saved.',
            'event' => $event
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}