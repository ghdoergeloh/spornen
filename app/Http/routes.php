<?php

/*
 * |--------------------------------------------------------------------------
 * | Application Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register all of the routes for an application.
 * | It's a breeze. Simply tell Laravel the URIs it should respond to
 * | and give it the controller to call when that URI is requested.
 * |
 */
Route::get('/', function () {
	return view('index');
});

Route::auth();
Route::get('register/verify/{confirmation_code?}', 'Auth\AuthController@confirm');

Route::get('/home', 'HomeController@showHomeView');

Route::get('/sponsors/list', 'Sponsor\SponsorController@showListView');
Route::get('/sponsors/edit', 'Sponsor\SponsorController@showEditView');
