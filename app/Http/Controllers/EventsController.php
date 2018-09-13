<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use Carbon\Carbon;
use App\User;

class EventsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        // $this->middleware('auth:api');
    }

    public function index()
    {
        $events = Event::with('user')->get();

        return response()->json([
            'status' => 'ok',
            'message' => 'List of events.',
            'events' =>  $events
        ]);
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

        $time_start = Carbon::parse($request->time_start);
        $time_end = Carbon::parse($request->time_end);
        $alarm = Carbon::parse($request->time_start)->subMinutes((int)$request->alarm);

        $event = new Event();
        $event->name = $request->name;
        $event->time_start = $time_start;
        $event->time_end = $time_end;
        $event->alarm = $alarm;
        $event->details = $request->details;
        $event->user_id = $request->user_id;
        $event->is_confirmed = false;
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
        $event = Event::find($id);

        $time_start = Carbon::parse($request->time_start);
        $time_end = Carbon::parse($request->time_end);
        $alarm = Carbon::parse($request->time_start)->subMinutes((int)$request->alarm);

        $event->name = $request->name;
        $event->time_start =  $time_start ;
        $event->time_end =  $time_end;
        $event->alarm = $alarm;
        $event->details = $request->details;
        $event->user_id = $request->user_id;
        $event->save();

        return response()->json([
            'status' => 'ok',
            'message' => 'Event updated.',
            'event' => $event
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $event = Event::find($id);

        if($event){
            $event->delete();
        }

        return response()->json([
            'status' => 'ok',
            'message' => 'Event deleted.'
        ]);
    }

    public function confirmEvent($id){
        $event = Event::find($id);
        $status = 'ko';
        $message = 'Event can\'t be confirmed';

        if($event){
            $event->is_confirmed = true;
            $status = 'ok';
            $message = 'Event confirmed';
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'event' => $event
        ]);
    }

    public function getEventsFromDate(Request $request){
        $event_date = Carbon::parse($request->event_date);

        $events = Event::with('user')->whereDate('time_start', '=', $event_date)->get();

        return response()->json([
            'status' => 'ok',
            'events' => $events
        ]);
    }

    public function userEvents(Request $request, $user_id){
        $user = User::find($user_id);
        $events = Event::with('user')->get();

        if ($user){
            if ($user->type != 'secretary'){
                $events = Event::with('user')->where('user_id', '=', $user_id)->get();
            }else{
                $events = Event::with('user')->get();
            }
        }

        return response()->json([
            'status' => 'ok',
            'message' => 'List of events.',
            'events' =>  $events
        ]);

    }

    
}
