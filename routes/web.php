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
Route::post('register-action', 'UsersController@registerAction')->name('registerAction');
Route::post('recovery-password-action', 'UsersController@recoveryPasswordAction')->name('recoveryPasswordAction');
Route::get('/recovery-password', 'UsersController@recoveryPassword')->name('recovery-password');
Route::get('/register/{ref_id}', 'UsersController@register')->name('register');

Route::middleware('guest')->group(function () {
    Route::get('/logout', 'LoginController@logout')->name('logout');
    Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');

    Route::post('add_fees_details', 'UsersController@add_fees_details')->name('add_fees_details');

    /*Member Route Start*/
    Route::get('/member', 'UsersController@memberList')->name('memberList');
    Route::get('/member-create', 'UsersController@memberCreate')->name('memberCreate');
    Route::get('user-view/{id}', ['as' => 'user_view', 'uses' => 'UsersController@user_view']);
    Route::get('user-edit/{id}', [ 'as' => 'user_edit', 'uses' => 'UsersController@user_edit']);

    /*Get Help Route Start*/
    Route::get('/site-setting', 'SiteSettingController@site_setting')->name('siteSetting');
    Route::get('user-view/{id}', ['as' => 'user_view', 'uses' => 'UsersController@user_view']);
    Route::get('user_create_success/{u_id}/{mobile}', ['as' => 'user_create_success', 'uses' => 'UsersController@user_create_success']);

    Route::post('site_setting_update', ['as' => 'site_setting_update', 'uses' => 'SiteSettingController@site_setting_update']);
});