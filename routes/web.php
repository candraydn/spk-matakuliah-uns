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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/bobot/kriteria', 'KriteriaController@bobot')->name('bobot.kriteria');
Route::post('/bobot/kriteria/post', 'KriteriaController@postbobot')->name('bobot.kriteria.post');
Route::any('/alternatif/bobot', 'AlternatifController@bobot')->name('bobot.alternatif');
Route::post('/alternatif/bobot/post', 'AlternatifController@postbobot')->name('bobot.alternatif.post');
Route::any('/report', 'ReportController@index')->name('report.index');


Route::get('/kriteria', 'KriteriaController@index')->name('kriteria');
Route::get('/kriteria/edit/{id}', 'KriteriaController@edit')->name('kriteria.edit');
Route::patch('/kriteria/update/{kriteria:id}', 'KriteriaController@update')->name('kriteria.update');

Route::get('/alternatif', 'AlternatifController@index')->name('alternatif');
Route::get('/alternatif/edit/{id}', 'AlternatifController@edit')->name('alternatif.edit');
Route::patch('/alternatif/update/{id}', 'AlternatifController@update')->name('alternatif.update');
