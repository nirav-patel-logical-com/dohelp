<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Validator;
class LoginController extends Controller
{
    public function login(){
        if (Auth::check()) {
            return redirect()->route('admin');
        }
        return view('auth.login');
    }

    public function loginAction(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }
        $errors = new MessageBag;
        if (Auth::check()) {
            return redirect()->route('admin');
        }

        try{
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                return redirect()->route('admin');
            }else{
                $errors = new MessageBag(['password' => ['Email and/or password invalid.']]);
                return Redirect::back()->withErrors($errors)->withInput(Input::except('password'));
                //return redirect()->route('login');
            }
        }catch (\Exception $e){
            abort(500);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
