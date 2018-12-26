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

Route::group(['middleware' => ['auth', 'sidebar']], function () {
    Route::get('/tests', function () {
        return view('welcome');
    });

    Route::get('/', function () {
        return view('admin.dashboard');
    });

    Route::resource('technologies', 'Admin\TechnologiesController');

    Route::resource('items', 'Admin\ItemsController');
    Route::get('items-export', 'Admin\ItemsController@export');
    Route::get('properties', 'Admin\ItemsController@properties');

    Route::resource('recipes', 'Admin\RecipesController');
    Route::get('recipe-component', 'Admin\RecipesController@component');
    Route::get('get-recipe-items-for-select/{type}', 'Admin\RecipesController@getItemsForSelect');

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
    Route::get('player-cloud-item', 'Admin\PlayersController@getCloudItem');
    Route::get('delete-all-players', 'Admin\PlayersController@deleteAll');

    Route::resource('quests', 'Admin\QuestsController');
    Route::get('quest-items', 'Admin\QuestsController@items');
    Route::get('new-quest-description', 'Admin\QuestsController@getNewQuestDescription');

    Route::resource('versions', 'Admin\VersionsController');

    Route::resource('dialogs', 'Admin\DialogsController');
    Route::get('dialog-description', 'Admin\DialogsController@description');

    Route::resource('rewards', 'Admin\RewardsController');
    Route::get('reward-item', 'Admin\RewardsController@item');

    Route::get('reconnect', 'Admin\ReconnectController');

    Route::get('test-to-production', 'Admin\MergingController@testToProduction');
    Route::get('production-to-test', 'Admin\MergingController@productionToTest');

    Route::resource('restorable-objects', 'Admin\RestorableObjectsController');
    Route::get('restorable-item', 'Admin\RestorableObjectsController@getItem');

    Route::get('base-player', 'Admin\BasePlayerController@show');
    Route::post('base-player', 'Admin\BasePlayerController@update');

    Route::resource('mobs', 'Admin\MobsController');
    Route::post('mob-fields', 'Admin\MobsController@getFields');

    Route::resource('notifications', 'Admin\NotificationsController');

    Route::resource('ban-list', 'Admin\BanListController', ['only' => [
        'index', 'store', 'update', 'destroy'
    ]]);

    Route::resource('event-islands', 'Admin\EventIslandsController');

    Route::resource('quest-replacement-times', 'Admin\QuestReplacementTimesController', ['only' => [
        'index', 'store', 'destroy'
    ]]);

    Route::resource('diary-storage-notes', 'Admin\DiaryStorageNotesController');

    Route::get('techcoin-settings', 'Admin\TechcoinSettingsController@index');
    Route::post('techcoin-settings', 'Admin\TechcoinSettingsController@update');

    Route::resource('loot-objects', 'Admin\LootObjectsController');

    Route::resource('loot-collections', 'Admin\LootCollectionsController');
    Route::get('loot-collections-item', 'Admin\LootCollectionsController@getItem');
    Route::get('loot-collection-object/{id}', 'Admin\LootCollectionsController@getLootCollectionObject');
    Route::get('get-collection-for-loot-object/{id}', 'Admin\LootObjectsController@getCollectionForLootObject');

    Route::resource('ship-stuff', 'Admin\ShipStuffsController');
    Route::post('ship-stuff-clear-all/{stuffID}', 'Admin\ShipStuffsController@clearAll');

    Route::get('get-ship-cell-modal/{id}', 'Admin\ShipStuffsController@getShipCellModal');
    Route::get('get-ship-floor-cell/{id}', 'Admin\ShipStuffsController@getShipFloorCell');
    Route::delete('delete-ship-floor-cell/{id}', 'Admin\ShipStuffsController@deleteShipFloorCell');
    Route::post('update-ship-floor-cell', 'Admin\ShipStuffsController@updateShipFloorCell');

    Route::resource('unity-logs', 'Admin\UnityLogsController', ['only' => [
        'index', 'show'
    ]]);

    Route::resource('laravel-logs', 'Admin\LaravelLogsController', ['only' => [
        'index', 'show', 'destroy'
    ]]);

    Route::resource('purchase-stages', 'Admin\PurchaseStagesController', ['only' => [
        'index'
    ]]);

    Route::resource('scene-chests', 'Admin\SceneChestsController', ['except' => [
        'show'
    ]]);

    Route::resource('scene-enemies', 'Admin\SceneEnemiesController');

    Route::resource('event-locations', 'Admin\EventLocationsController');
    Route::get('event-location-setting', 'Admin\EventLocationsController@getSetting');
    Route::post('timer-to-new-attempt', 'Admin\EventLocationsController@updateTimer');

});


Auth::routes();