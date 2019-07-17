<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/des', function () {
    return view('dashboard.dashboard');
});
Route::get('/', 'LoginController@login')->name('login');
Route::get('/recovery-password', 'UsersController@recoveryPassword')->name('recovery-password');
Route::get('/register', 'UsersController@register')->name('register');
Route::post('login-action', 'LoginController@loginAction')->name('loginAction');
