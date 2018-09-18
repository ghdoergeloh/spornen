<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | contains the "web" middleware group. Now create something great!
 * |
 */

Route::get('/', function () {
	return redirect('home');
});

Auth::routes();
Route::get('register/verify/{confirmation_code}', 'Auth\RegisterController@confirm')->name(
	'register.verify');

// User
Route::get('home', 'HomeController@showHomeView');

Route::get('account/edit', 'AccoController@edit')->name('account.edit');
Route::patch('account', 'AccoController@update')->name('account.update');

Route::get('runpart/{runpart}/calculate', 'UserRunPartController@calculate')->name(
	'runpart.calculate');
Route::resource('runpart', 'UserRunPartController')->except('create', 'destroy');

Route::resource('runpart.sponsor', 'UserRunPartSponController');

// Sponsor
Route::get('run/{run}',
	function ($run) {
		return redirect()->route('run.sponsor.create', $run->hash);
	});
Route::resource('run.sponsor', 'SponSelfController')->only('index', 'create', 'store');

// Admin
Route::get('sponrun/{sponrun}/evaluation', 'AdmRunController@evaluation')->name(
	'sponrun.evaluation');
Route::post('sponrun/{sponrun}/close', 'AdmRunController@close')->name('sponrun.close');
Route::post('sponrun/{sponrun}/reopen', 'AdmRunController@reopen')->name('sponrun.reopen');
Route::patch('sponrun/{sponrun}/removeProjectlists', 'AdmRunController@removeProjectlists')->name(
	'sponrun.removeProjectlists');
Route::patch('sponrun/{sponrun}/addProjectlists', 'AdmRunController@addProjectlists')->name(
	'sponrun.addProjectlists');
Route::resource('sponrun', 'AdmRunController');

Route::resource('sponrun.runpart', 'AdmRunPartController')->except('create', 'store', 'destroy');

Route::resource('sponrun.runpart.sponsor', 'AdmRunPartSponController');

Route::resource('project', 'AdmProjController');

Route::patch('projectlist/{projectlist}/removeProjects', 'AdmPlstController@removeProjects')->name(
	'projectlist.removeProjects');
Route::patch('projectlist/{projectlist}/addProjects', 'AdmPlstController@addProjects')->name(
	'projectlist.addProjects');
Route::resource('projectlist', 'AdmPlstController');