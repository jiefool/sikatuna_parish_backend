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
      $user = User::where('username', $request->username)->first();

      return json_encode($user);
    }
}
