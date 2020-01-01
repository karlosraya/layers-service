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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('auth/login', 'API\UserController@login');
Route::post('auth/register', 'API\UserController@register');

Route::group(['middleware' => 'auth:api'], function(){
	Route::post('auth', 'API\UserController@auth');
	Route::post('auth/logout', 'API\UserController@logout');
	Route::get('user', 'API\UserController@getUsers');

	Route::get('house', 'HouseController@getHouses');
	Route::post('house', 'HouseController@createUpdateHouse');

	Route::get('batch/active/{id}', 'BatchController@getActiveByHouseId');
	Route::put('batch/{id}', 'BatchController@editBatch');
	Route::post('batch/start', 'BatchController@startBatch');
	Route::put('batch/end/{id}', 'BatchController@endBatch');
	Route::get('batch/archive/{houseId}', 'BatchController@getBatchesByHouseId');

	Route::get('production', 'ProductionController@getProductionReportsOfActiveBatches');
	Route::get('production/upto/{date}', 'ProductionController@getProductionReportsOfActiveBatchesUptoDate');
	Route::get('production/{houseId}', 'ProductionController@getProductionReportsByHouseId');
	Route::post('production/', 'ProductionController@createUpdateProductionReport');

	Route::get('feeds-delivery/{date}', 'FeedsDeliveryController@getFeedsDeliveryByDate');
	Route::get('feeds-delivery', 'FeedsDeliveryController@getFeedsDelivered');
	Route::post('feeds-delivery', 'FeedsDeliveryController@createUpdateFeedsDelivery');

	Route::get('graded-eggs/{date}', 'GradedEggsController@getGradedEggsByDate');
	Route::get('graded-eggs/available/{date}', 'GradedEggsController@getAvailableByDate');
	Route::post('graded-eggs', 'GradedEggsController@createUpdateGradedEggs');

	Route::get('prices', 'PricesController@getPrices');
	Route::post('prices', 'PricesController@updatePrices');

	Route::get('customer', 'CustomerController@getCustomers');
	Route::post('customer', 'CustomerController@createUpdateCustomer');

	Route::get('invoices/{date}', 'InvoiceController@getInvoicesByDate');
	Route::get('invoice/{id}', 'InvoiceController@getInvoicesById');
	Route::get('invoice/customer/{id}', 'InvoiceController@getInvoicesByCustomerId');
	Route::post('invoice', 'InvoiceController@createUpdateInvoice');
});
