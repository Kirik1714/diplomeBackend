<?php

use App\Http\Controllers\Api\Form\IndexController as FormIndexController;
use App\Http\Controllers\Api\Medicine\IndexController;
use App\Http\Controllers\Api\Classification\IndexController as ClassificationIndexController;
use App\Http\Controllers\Api\User\OrderController;
use App\Http\Controllers\Api\User\StoreController;
use App\Http\Controllers\AuthController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::group(['prefix' => 'medicines'], function () {
    Route::get('/',[IndexController::class,'getAllMedicines']);
    Route::post('/',[IndexController::class,'filterMedicines']);
    Route::get('/{id}',\App\Http\Controllers\Api\Medicine\ShowController::class);

    Route::group(['prefix'=>'orders'],function(){
        Route::post('/',OrderController::class);
        Route::get('{id}',[OrderController::class,'getOrderByUser']);

    });


});


Route::get('/forms',FormIndexController::class);
Route::get('/classification',ClassificationIndexController::class); 
Route::get('/suppliers',\App\Http\Controllers\Api\Supplier\IndexController::class);


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/me', [AuthController::class, 'me']);
});
Route::group(['prefix' => 'users'], function () {
    Route::post('/', StoreController::class);
});
