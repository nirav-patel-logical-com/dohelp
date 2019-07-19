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

Route::get('/', 'LoginController@login')->name('login');
Route::post('login-action', 'LoginController@loginAction')->name('loginAction');
Route::middleware('guest')->group(function () {
    Route::get('/logout', 'LoginController@logout')->name('logout');
    Route::get('/recovery-password', 'UsersController@recoveryPassword')->name('recovery-password');
    Route::get('/register/{ref_id}', 'UsersController@register')->name('register');
    Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');
    Route::post('register-action', 'UsersController@registerAction')->name('registerAction');
    Route::post('recovery-password-action', 'UsersController@recoveryPasswordAction')->name('recoveryPasswordAction');
    Route::post('add_fees_details', 'UsersController@add_fees_details')->name('add_fees_details');

    /*Member Route Start*/
    Route::get('/member', 'UsersController@memberList')->name('memberList');
    Route::get('/member-create', 'UsersController@memberCreate')->name('memberCreate');
    Route::get('user-view/{id}', ['as' => 'user_view', 'uses' => 'UsersController@user_view']);
    Route::get('user-edit/{id}', [ 'as' => 'user_edit', 'uses' => 'UsersController@user_edit']);

    /*Get Help Route Start*/
    Route::get('/get-help', 'HelpController@getHelp')->name('getHelp');
    Route::get('user-view/{id}', ['as' => 'user_view', 'uses' => 'UsersController@user_view']);
});