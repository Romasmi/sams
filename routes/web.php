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

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/site/add', 'SiteController@addSite')->name('addSite');
Route::post('/site/add', 'SiteController@create')->name('createSite');

Route::get('/site/edit/{id}', 'SiteController@editSite')->name('editSite');
Route::post('/site/edit/{id}', 'SiteController@update')->name('updateSite');
Route::get('/site/{id}', 'SiteController@index')->name('editSite');

Route::post('/site/page/add/{id}', 'PageController@addPages')->name('addPages');
Route::post('/site/pages/delete/{id}', 'PageController@deletePage')->name('deletePage');
