<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('cities', 'CityController');

Route::post(
    'cities/{city_id}/delivery-times',
    'CityController@storeDeliveryTimes'
)->name('cities.storeDeliveryTimes');

Route::get(
    'cities/{city_id}/delivery-times',
    'CityController@getExcludedDeliveryTimeDate'
)->name('cities.getExcludedDeliveryTimeDate');

Route::get(
    'cities/{city_id}/delivery-dates-times/{number_of_days}',
    'CityController@getDeliveryDate'
)->name('cities.getDeliveryDate');
Route::post(
    'excluded-delivery-dates',
    'CityController@excludedDeliveryTimeDate'
)->name('cities.excludedDeliveryTimeDate');

Route::resource('partners', 'PartnerController');

Route::resource('delivery-times', 'DeliveryTimeController');

//Route::resource('delivery-date', 'DeliveryDateController');