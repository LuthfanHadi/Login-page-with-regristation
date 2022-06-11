<?php

namespace App\Http\Controllers;

use App\Models\User;
use database\seeders\UserTablesSeeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Validator;
use Auth;

class MainController extends Controller
{

    //Log In

    function index()
    {
     return view('login');
    }

    function checklogin(Request $request)
    {
     $this->validate($request, [
      'email'   => 'required|email',
      'password'  => 'required|alphaNum|min:3'
     ]);

     $user_data = array(
      'email'  => $request->get('email'),
      'password' => $request->get('password')
     );

     if(Auth::attempt($user_data))
     {
      return redirect('main/successlogin');
     }
     else
     {
      return back()->with('error', 'Wrong Login Details');
     }

    }

    function successlogin()
    {
     return view('successlogin');
    }

    function logout()
    {
     Auth::logout();
     return redirect('main');
    }

    //Sign Up 

    function signup()
    {
        return view('signup');
    }
    function checksignup(Request $request)
    {
     $UserData = $this->validate($request, [
      'name' =>'required|min:3',
      'email'   => 'required|email',
      'password'  => 'required|alphaNum|min:3'
     ]);
     $input['email'] = $request->get('email');
     $rules = array('email' => 'unique:users,email');

     $validator = Validator::make($input, $rules);
     
     if ($validator->fails()) {
        return back()->with('error', 'That email address is already registered. You sure you don\'t have an account?');
     }
     else {
        User::create([
            'name'    => $UserData['name'],
            'email'    => $UserData['email'],
            'password'   =>  Hash::make($UserData['password']),
            'remember_token' =>  str::random(10),
        ]);
        return view('login');
     }
    }
    function successsignup()
    {
        return redirect('database\seeders\UserTablesSeeder');
    }

}

?>
