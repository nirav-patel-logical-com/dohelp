<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//User Login API Route
Route::post('login', 'APILoginController@login');
Route::post('generateNewToken', 'APILoginController@generateNewToken');

//User Create
Route::post('user_create',['uses'=>'UsersController@userCreate']);

//After Login check middleware' =>'jwt.auth'
//Route::post('user_list',['middleware'=>['jwt.auth'],'uses'=>'UsersController@userList']);
Route::post('user_edit',['middleware'=>'jwt.auth','uses'=>'UsersController@userEdit']);
Route::post('user_details',['middleware'=>'jwt.auth','uses'=>'UsersController@userDetails']);
Route::post('changePassword',['middleware'=>'jwt.auth','uses'=>'UsersController@changePassword']);
Route::post('logout',['middleware'=>'jwt.auth','uses'=>'APILoginController@logout']);
Route::post('user_view_api', 'UsersController@user_view_api')->name('user_view_api');
Route::post('dashboard','DashboardController@dashboardAPI')->name('dashboard');
Route::post('GetHelpList','HelpController@GetHelpList')->name('GetHelpList');
Route::post('PaidHelpList','HelpController@PaidHelpList')->name('PaidHelpList');

/*Web Route for API call*/
Route::post('user_list_post','UsersController@user_list_post')->name('user_list_post');
Route::post('user_details_save','UsersController@user_details_save')->name('user_details_save');
Route::post('user_details_update','UsersController@user_details_update')->name('user_details_update');
Route::post('change_user_status','UsersController@change_user_status')->name('change_user_status');
Route::post('userEditAction','UsersController@userEdit')->name('userEditAction');
Route::post('userCreateAction','UsersController@userCreate')->name('userCreateAction');
Route::post('get_paid_user_list','UsersController@get_paid_user_list')->name('get_paid_user_list');
Route::post('GetPaidAssignAction','HelpController@GetPaidAssignAction')->name('GetPaidAssignAction');

