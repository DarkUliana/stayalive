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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/tests', function () {
        return view('welcome');
    });

    Route::get('/', function(){
       return view('admin.dashboard');
    });

    Route::resource('technologies', 'Admin\TechnologiesController');

    Route::resource('items', 'Admin\ItemsController');
    Route::get('properties', 'Admin\ItemsController@properties');

    Route::resource('recipes', 'Admin\RecipesController');
    Route::get('recipe-component', 'Admin\RecipesController@component');

    Route::resource('descriptions', 'Admin\DescriptionsController');
    Route::get('localization', 'Admin\DescriptionsController@localization');
    Route::get('description-export', 'DescriptionController@export');
    Route::post('description-import', 'DescriptionController@import');

    Route::get('symbols', 'Admin\DescriptionsController@symbols');
    
    Route::resource('languages', 'Admin\LanguagesController');
    Route::get('language-item', 'Admin\LanguagesController@languageItem');

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('shop-articles', 'Admin\ShopArticlesController');
    Route::get('shop-item', 'Admin\ShopArticlesController@item');

    Route::resource('players', 'Admin\PlayersController');

    Route::delete('players', 'Admin\PlayersController@destroy');
    Route::get('players-online', 'Admin\PlayersController@index');
    Route::post('player-items', 'Admin\PlayersController@saveItems');
    Route::get('player/get-item/{id}', 'Admin\PlayersController@getItem');

    Route::resource('quests', 'Admin\QuestsController');
    Route::get('quest-items', 'Admin\QuestsController@items');

    Route::resource('versions', 'Admin\VersionsController');

    Route::resource('dialogs', 'Admin\DialogsController');
    Route::get('dialog-description', 'Admin\DialogsController@description');

});


Auth::routes();