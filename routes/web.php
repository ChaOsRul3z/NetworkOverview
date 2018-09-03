<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::group(['middleware' => 'auth'], function () {
    Route::post('/units/sort', '\Rutorika\Sortable\SortableController@sort'); // only allow sort when user is logged in
});

Route::get('', ['uses' => 'BuildingController@index', 'as' => 'home']);

Route::resource('buildings', 'BuildingController');
Route::resource('buildings.floors', 'FloorController');
Route::resource('floors.rooms', 'RoomController');
Route::resource('rooms.racks', 'RackController');
Route::resource('rooms.devices', 'RoomDeviceController', ['only' => ['index']]);
Route::resource('racks.units', 'UnitController');

Route::resource('sorts', 'SortController');
Route::resource('sorts.types', 'TypeController', ['except' => ['index', 'show']]);
Route::resource('properties', 'PropertyController', ['except' => 'show']);
Route::resource('vlans', 'VlanController');

Route::resource('units.ports', 'PortController', ['except' => ['show', 'create', 'store']]);
Route::get('units/{unit}/ports/ajax', ['uses' => 'PortController@ajax']);

Route::get('inventory', ['uses' => 'InventoryController@index', 'as' => 'inventory']);
Route::post('inventory', ['uses' => 'InventoryController@search', 'as' => 'inventory-search']);

Route::resource('patchcables', 'PatchCableController');

Route::resource('devices', 'DeviceController', ['except' => ['show']]);
//Route::resource('devices.properties', 'DevicePropertyController');
//Route::post('devices/{device}/properties/add', ['uses' => 'DevicePropertyController@add', 'as' => 'device.property.add']);
//Route::post('devices/{device}/properties/remove', ['uses' => 'DevicePropertyController@remove', 'as' => 'device.property.remove']);

Auth::routes();

Route::delete('patchcables/{patchcable}/ajax', 'PatchCableController@destroyById');
