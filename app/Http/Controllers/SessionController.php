<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Session;

class SessionController extends Controller
{
    function index()
    {
        return view("sesi/index");
    }
    function login(Request $request)
    {
        Session::flash('email',$request->email);
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ],[
            'email.required'=>'Enter your email!',
            'password.required'=>'Enter your password!',
        ]);

        $infologin = [
            'email'=>$request->email,
            'password'=>$request->password
        ];

        if(Auth::attempt($infologin)){
            return redirect('player')->with('success',Auth::user()->name.' succesfully logged in!');
        }else{
            return redirect('sesi')->withErrors('Username or password is not correct!');
        }
    }

    function logout(){
        Auth::logout();
        return redirect('sesi')->with('success','Logout successfull!');
    }

    function register()
    {
        return view('sesi/register');
    }
    function create(Request $request)
    {
        Session::flash('name',$request->name);
        Session::flash('email',$request->email);
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6'
        ],[
            'name.required'=>'Enter your name!',
            'email.required'=>'Enter your email!',
            'email.email'=>'Please enter a valid email!',
            'email.unique'=>'Email is already used!',
            'password.required'=>'Enter your password!',
            'password.min'=>'Minimum length of password is 6 characters!'
        ]);
        $data = [
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ];
        User::create($data);

        $infologin = [
            'email'=>$request->email,
            'password'=>$request->password
        ];


        if(Auth::attempt($infologin)){
            return redirect('player')->with('success',Auth::user()->name.' successfully created!');
        }else{
            return redirect('sesi')->withErrors('Username or password is not correct!');
        }
    }

}
