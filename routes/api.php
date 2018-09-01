<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
 * |--------------------------------------------------------------------------
 * | API Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register API routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | is assigned the "api" middleware group. Enjoy building your API!
 * |
 */
Route::middleware('auth:api')->group(function () {
	Route::get('account', 'AccoController@show')->name('account.show');
	Route::patch('account', 'AccoController@update')->name('account.update');
});
Auth::routes();