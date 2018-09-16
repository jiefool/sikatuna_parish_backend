<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Hashing\BcryptHasher as Hash;

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

    public function update(Request $request){
        $user = User::find($request->id);


        $fields = array();

        if ($user->name != $request->name){
            $fields['name'] = 'required|string|max:255';
        }

        if ($user->username != $request->username){
            $fields['username'] = 'required|string|max:255|unique:users';
        }

        if ($user->email != $request->email){
            $fields['email'] = 'required|string|email|max:255|unique:users';
        }   


        $currentPassword = $user->password;
        $currentPasswordApp = $request->current_password;

        $hasher = app('hash');
        $hasherCheck = $hasher->check($currentPasswordApp, $user->password);
        if ($hasherCheck) {
            $fields['password'] ='required|string|min:6|confirmed';
        }else{
            return response()->json(array('error'=>'Inputted current password does not match to saved password.'));
        }
        

        $validator = Validator::make($request->all(), $fields); 


        if (count($validator->errors()) > 0){
            return response()->json($validator->errors());
        }else{
            
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;

            if(!$hasher->check($request->password, $user->password)){
                $user->password = bcrypt($request->password);
            } 

            $user->save();

            return response()->json($user);
        }

       

        

       

       
        

        // $user->save();

        // return response()->json($user);

        
    }
}
