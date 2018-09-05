<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GroupService;
use Carbon\Carbon;

class GroupServicesController extends Controller
{
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
        $groupService = new GroupService();

        $groupService->time_start =  Carbon::parse($request->time_start);
        $groupService->time_end = Carbon::parse($request->time_end);
        $groupService->group_id = $request->group_id;
        $groupService->save();

        return response()->json([
            'status' => 'ok',
            'message' => 'Service saved.'
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
        $groupService = GroupService::find($id);

        if($groupService){
            $groupService->delete();
        }

        return response()->json([
            'status' => 'ok',
            'message' => 'Service deleted.'
        ]);
    }
}
