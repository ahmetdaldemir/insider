<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/weeks', 'HomeController@weeks')->name('weeks');
Route::get('/teams', 'HomeController@teams')->name('teams');
Route::get('/match', 'HomeController@match')->name('match');
Route::get('/fixtures', 'HomeController@fixtures')->name('fixtures');
Route::post('/createfixture', 'HomeController@createfixture')->name('createfixture');
Route::get('/getfixture', 'HomeController@getfixture')->name('getfixture');


Route::post('/crud', 'HomeController@crud')->name('crud');
Route::get('/allweek', 'HomeController@allweek')->name('allweek');
Route::get('/allteam', 'HomeController@allteam')->name('allteam');
Route::get('/allMatches', 'HomeController@allMatches')->name('allMatches');
Route::get('/getWeekMatch', 'HomeController@getWeekMatch')->name('getWeekMatch');
Route::get('/createSimulate', 'HomeController@createSimulate')->name('createSimulate');
