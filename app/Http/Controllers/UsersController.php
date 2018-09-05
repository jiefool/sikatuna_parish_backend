<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function __construct(){
      $this->middleware('auth:api');
    }

    public function getUserDetails(Request $request){
      $user = User::where('email', $request->email)->first();

      return response()->json($user);
    }

    public function unconfirmedEvents($id){
        $user = User::find($id);
        $events = array();

        if($user){
            $events = $user->events();
        }

        return response()->json($events);
    }

    public function getPriestUsers(Request $request){
        $users = User::where('type', '=', $request->type)->get();
        return response()->json($users);
    }
}
