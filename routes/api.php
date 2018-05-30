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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::group(['middleware' => 'auth'], function () {


//Route::group(['middleware' => ['jwt.auth']], function () {

Route::get('player', 'PlayerController@show');
Route::post('player', 'PlayerController@store');
//    Route::post('player', 'PlayerController@update');
Route::delete('player', 'PlayerController@delete');


Route::get('{slot}', 'SlotsController@show')->where('slot', 'equipment|inventory|after-craft-items|player-chest-items');
Route::post('{slot}', 'SlotsController@updateOrCreate')->where('slot', 'equipment|inventory|after-craft-items|player-chest-items');

Route::get('time', 'TimeController@index');

Route::get('timer/{type}', 'TimerController@show')->where('type', '^(tech|craft|walking|last-save|quest)$');
Route::post('timer/{type}', 'TimerController@updateOrCreate')->where('type', '^(tech|craft|walking|last-save|quest)$');

Route::get('item', 'ItemController@index');
Route::post('item', 'ItemController@store');
//Route::put('item', 'ItemController@update');
//Route::delete('item', 'ItemController@delete');

Route::get('technology', 'TechnologyController@index');
Route::post('technology', 'TechnologyController@store');

Route::get('recipe', 'RecipeController@index');
Route::post('recipe', 'RecipeController@store');

Route::get('tech-list', 'PlayerTechListController@show');
Route::post('tech-list', 'PlayerTechListController@store');

Route::get('raft', 'PlayerTechListController@getRaftState');

Route::get('items-in-craft', 'ItemsInCraftController@show');
Route::post('items-in-craft', 'ItemsInCraftController@store');

Route::get('descriptions/{language}', 'DescriptionController@show');
Route::post('descriptions', 'DescriptionController@addEnglishDescriptions');

Route::get('online', 'OnlineController');

Route::get('shop', 'ShopArticleController@index');
Route::post('shop', 'ShopArticleController@store');

//});

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::post('recover', 'AuthController@recover');

Route::get('unique-id', 'UniqueIdController');

Route::post('cloud-items', 'CloudItemController@postItems');
Route::get('cloud-items', 'CloudItemController@getItems');

Route::post('quests', 'QuestController@store');
Route::get('quests', 'QuestController@index');

Route::post('player-quests', 'PlayerQuestController@store');
Route::get('player-quests', 'PlayerQuestController@index');

Route::post('rewards', 'RewardController@store');
Route::get('rewards', 'RewardController@index');

Route::get('version', 'VersionController');

Route::get('player-rewards', 'PlayerRewardController@index');
Route::post('player-rewards', 'PlayerRewardController@store');

//});