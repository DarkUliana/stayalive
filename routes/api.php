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

//Route::group(['middleware' => 'api-connection'], function () {

Route::group(['middleware' => ['player-ip', 'geo-ip']], function () {


    Route::get('player', 'PlayerController@get');
    Route::post('player', 'PlayerController@post');

    Route::get('base-player', 'BasePlayerController@index');
    Route::post('base-player', 'BasePlayerController@store');


    Route::get('{slot}', 'SlotsController@show')->where('slot', 'equipment|inventory|player-chest-items|player-body');
    Route::post('{slot}', 'SlotsController@updateOrCreate')->where('slot', 'equipment|inventory|player-chest-items|player-body');

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

//Route::post('daily-quests', 'QuestController@storeDaily');
//Route::post('plot-quests', 'QuestController@storePlot');
    Route::get('daily-quests', 'QuestController@getDaily');
    Route::get('plot-quests', 'QuestController@getOldPlot');
    Route::get('plot-quests2', 'QuestController@getPlot');
//    Route::get('quests', 'QuestController@index');

    Route::get('quest-descriptions', 'QuestDescriptionController');

    Route::post('player-quests', 'PlayerQuestController@store');
    Route::get('player-quests', 'PlayerQuestController@index');

    Route::post('rewards', 'RewardController@store');
    Route::get('rewards', 'RewardController@index');

    Route::get('version', 'VersionController');

    Route::get('player-rewards', 'PlayerRewardController@index');
    Route::post('player-rewards', 'PlayerRewardController@store');

    Route::get('dialogs', 'DialogController@index');
    Route::post('dialogs', 'DialogController@store');

    Route::get('restorable-objects', 'PlayerRestorableObjectController@index');
    Route::post('restorable-objects', 'PlayerRestorableObjectController@store');
    Route::get('restorable-store', 'RestorableObjectController@index');
    Route::post('restorable-store', 'RestorableObjectController@store');

    Route::get('notifications', 'NotificationController@index');

    Route::get('mobs', 'MobController@index');

    Route::get('logs', 'UnityLogController@index');
    Route::post('logs', 'UnityLogController@store');

    Route::get('ban', 'BanListController');

    Route::get('event-islands', 'EventIslandController');

    Route::get('quest-timer', 'QuestTimerController');

    Route::get('learned-recipes', 'PlayerLearnedRecipeController@get');
    Route::post('learned-recipes', 'PlayerLearnedRecipeController@post');

    Route::get('diary-storage-notes', 'DiaryStorageNoteController@get');
    Route::post('diary-storage-notes', 'DiaryStorageNoteController@post');

    Route::get('player-diary-notes', 'PlayerDiaryNoteController@get');
    Route::post('player-diary-notes', 'PlayerDiaryNoteController@post');

    Route::get('player-ship-stuff', 'PlayerShipStuffController@get');
    Route::post('player-ship-stuff', 'PlayerShipStuffController@post');

    Route::get('ship-stuff', 'ShipStuffController@get');

    Route::get('player-repair-items', 'PlayerRepairItemController@get');
    Route::post('player-repair-items', 'PlayerRepairItemController@post');

    Route::get('techcoin-settings', 'TechcoinSettingController@get');
//Route::post('techcoin-settings', 'TechcoinSettingController@post');

    Route::get('loot-objects', 'LootObjectController@get');

    Route::get('pref-records', 'PlayerPrefRecordController@get');
    Route::post('pref-records', 'PlayerPrefRecordController@post');

    Route::get('quest-sequences', 'QuestSequenceController@get');

    Route::get('player-sequences', 'PlayerSequenceController@get');
    Route::post('player-sequences', 'PlayerSequenceController@post');

    Route::get('player-ship-chests', 'PlayerShipChestController@get');
    Route::post('player-ship-chests', 'PlayerShipChestController@post');

    Route::post('purchase-stage', 'PurchaseStageController');

    Route::get('tutorial-save-data', 'TutorialSaveDataController@get');
    Route::post('tutorial-save-data', 'TutorialSaveDataController@post');

    Route::get('scene-chests', 'SceneChestController@get');
    Route::post('scene-chests', 'SceneChestController@post');

    Route::get('player-scene-chests', 'PlayerSceneChestController@get');
    Route::post('player-scene-chests', 'PlayerSceneChestController@post');

    Route::get('move-old-player/{googleID}', 'MovingOneOldPlayer@moveOne');
    Route::get('move-all-old-players', 'MovingOneOldPlayer@moveAll');

    Route::get('player-enemy-saves', 'PlayerEnemySaveController@get');
    Route::post('player-enemy-saves', 'PlayerEnemySaveController@post');

    Route::get('scene-enemy-storage', 'SceneEnemyController@get');
    Route::post('scene-enemy-storage', 'SceneEnemyController@post');

    Route::get('event-locations-storage', 'EventLocationController@get');
//Route::post('event-locations-storage', 'EventLocationController@post');

    Route::get('player-event-locations', 'PlayerEventLocationController@get');
    Route::post('player-event-locations', 'PlayerEventLocationController@post');
});
//});