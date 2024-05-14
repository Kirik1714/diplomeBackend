<?php

use App\Http\Controllers\Main\IndexController;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class)->name('main.index');

Route::group(['prefix' => 'pharmacy'], function () {
    Route::get('/', App\Http\Controllers\Main\Pharmacy\IndexController::class)->name('pharmacy.index');
    Route::get('/search', [App\Http\Controllers\Main\Pharmacy\IndexController::class, 'search'])->name('pharmacy.search');
    Route::get('/create', App\Http\Controllers\Main\Pharmacy\CreateController::class)->name('pharmacy.create');
    Route::post('/',App\Http\Controllers\Main\Pharmacy\StoreController::class)->name('pharmacy.store');
    Route::get('/{pharmacy}', App\Http\Controllers\Main\Pharmacy\ShowController::class)->name('pharmacy.show');
    Route::get('/{pharmacy}/edit', App\Http\Controllers\Main\Pharmacy\EditController::class)->name('pharmacy.edit');
    Route::patch('/{pharmacy}', App\Http\Controllers\Main\Pharmacy\UpdateController::class)->name('pharmacy.update');
    Route::delete('/{pharmacy}', App\Http\Controllers\Main\Pharmacy\DeleteController::class)->name('pharmacy.destroy');
   

    Route::group(['prefix' => '{pharmacy}/assortment'], function () {
        Route::get('/', App\Http\Controllers\Main\Pharmacy\Assortment\IndexController::class)->name('pharmacy.assortment.index');
        Route::get('/create', App\Http\Controllers\Main\Pharmacy\Assortment\CreateController::class)->name('pharmacy.assortment.create');
        Route::post('/', App\Http\Controllers\Main\Pharmacy\Assortment\StoreController::class)->name('pharmacy.assortment.store');
        Route::get('/{assortment}/edit', App\Http\Controllers\Main\Pharmacy\Assortment\EditController::class)->name('pharmacy.assortment.edit');
        Route::patch('/{assortment}', App\Http\Controllers\Main\Pharmacy\Assortment\UpdateController::class)->name('pharmacy.assortment.update');
        Route::delete('/{assortment}', App\Http\Controllers\Main\Pharmacy\Assortment\DeleteController::class)->name('pharmacy.assortment.destroy');
        Route::get('/search', [App\Http\Controllers\Main\Pharmacy\Assortment\IndexController::class, 'search'])->name('pharmacy.assortment.search');
    });
   
     

});
Route::group(['prefix' => 'medicine'], function () {
    
    Route::group(['prefix' => 'list'], function () {
      
      Route::get('/', App\Http\Controllers\Main\Medicine\List\IndexController::class)->name('medicine.list.index');
      Route::get('/search', [App\Http\Controllers\Main\Medicine\List\IndexController::class, 'search'])->name('medicine.list.search');

      Route::get('/create', App\Http\Controllers\Main\Medicine\List\CreateController::class)->name('medicine.list.create');
      Route::post('/',App\Http\Controllers\Main\Medicine\List\StoreController::class)->name('medicine.list.store');
      Route::get('/{medicine}', App\Http\Controllers\Main\Medicine\List\ShowController::class)->name('medicine.list.show');
      Route::get('/{medicine}/edit', App\Http\Controllers\Main\Medicine\List\EditController::class)->name('medicine.list.edit');
      Route::patch('/{medicine}', App\Http\Controllers\Main\Medicine\List\UpdateController::class)->name('medicine.list.update');
      Route::delete('/{medicine}', App\Http\Controllers\Main\Medicine\List\DeleteController::class)->name('medicine.list.destroy');


    });
    Route::group(['prefix' => 'form'], function () {
        Route::get('/', App\Http\Controllers\Main\Medicine\Form\IndexController::class)->name('medicine.form.index');
        Route::get('/create', App\Http\Controllers\Main\Medicine\Form\CreateController::class)->name('medicine.form.create');
        Route::post('/',App\Http\Controllers\Main\Medicine\Form\StoreController::class)->name('medicine.form.store');
        Route::get('/{form}', App\Http\Controllers\Main\Medicine\Form\ShowController::class)->name('medicine.form.show');
        Route::get('/{form}/edit', App\Http\Controllers\Main\Medicine\Form\EditController::class)->name('medicine.form.edit');
        Route::patch('/{form}', App\Http\Controllers\Main\Medicine\Form\UpdateController::class)->name('medicine.form.update');
        Route::delete('/{form}', App\Http\Controllers\Main\Medicine\Form\DeleteController::class)->name('medicine.form.destroy');
    });

    Route::group(['prefix'=>'classification'],function(){
        Route::get('/', App\Http\Controllers\Main\Medicine\Classification\IndexController::class)->name('medicine.classification.index');
        Route::get('/create', App\Http\Controllers\Main\Medicine\Classification\CreateController::class)->name('medicine.classification.create');
        Route::post('/',App\Http\Controllers\Main\Medicine\Classification\StoreController::class)->name('medicine.classification.store');
        Route::get('/{classification}', App\Http\Controllers\Main\Medicine\Classification\ShowController::class)->name('medicine.classification.show');
        Route::get('/{classification}/edit', App\Http\Controllers\Main\Medicine\Classification\EditController::class)->name('medicine.classification.edit');
        Route::patch('/{classification}', App\Http\Controllers\Main\Medicine\Classification\UpdateController::class)->name('medicine.classification.update');
        Route::delete('/{classification}', App\Http\Controllers\Main\Medicine\Classification\DeleteController::class)->name('medicine.classification.destroy');

    });

    Route::group(['prefix'=>'supplier'],function(){
        Route::get('/', App\Http\Controllers\Main\Medicine\Supplier\IndexController::class)->name('medicine.supplier.index');
        Route::get('/create', App\Http\Controllers\Main\Medicine\Supplier\CreateController::class)->name('medicine.supplier.create');
        Route::post('/',App\Http\Controllers\Main\Medicine\Supplier\StoreController::class)->name('medicine.supplier.store');
        Route::get('/{supplier}', App\Http\Controllers\Main\Medicine\Supplier\ShowController::class)->name('medicine.supplier.show');
        Route::get('/{supplier}/edit', App\Http\Controllers\Main\Medicine\Supplier\EditController::class)->name('medicine.supplier.edit');
        Route::patch('/{supplier}', App\Http\Controllers\Main\Medicine\Supplier\UpdateController::class)->name('medicine.supplier.update');
        Route::delete('/{supplier}', App\Http\Controllers\Main\Medicine\Supplier\DeleteController::class)->name('medicine.supplier.destroy');
    });
    Route::group(['prefix'=>'status'],function(){
        Route::get('/', App\Http\Controllers\Main\Medicine\Status\IndexController::class)->name('medicine.status.index');
        Route::get('/create', App\Http\Controllers\Main\Medicine\Status\CreateController::class)->name('medicine.status.create');
        Route::post('/',App\Http\Controllers\Main\Medicine\Status\StoreController::class)->name('medicine.status.store');
        Route::get('/{status}', App\Http\Controllers\Main\Medicine\Status\ShowController::class)->name('medicine.status.show');
        Route::get('/{status}/edit', App\Http\Controllers\Main\Medicine\Status\EditController::class)->name('medicine.status.edit');
        Route::patch('/{status}', App\Http\Controllers\Main\Medicine\Status\UpdateController::class)->name('medicine.status.update');
        Route::delete('/{status}', App\Http\Controllers\Main\Medicine\Status\DeleteController::class)->name('medicine.status.destroy');
    });

});
Route::group(['prefix' => 'user'], function () {
    Route::get('/', App\Http\Controllers\Main\User\IndexController::class)->name('user.index');
    Route::get('/create', App\Http\Controllers\Main\User\CreateController::class)->name('user.create');
    Route::get('/search', [App\Http\Controllers\Main\User\IndexController::class, 'search'])->name('user.search');
    Route::post('/',App\Http\Controllers\Main\User\StoreController::class)->name('user.store');
    Route::get('/{user}', App\Http\Controllers\Main\User\ShowController::class)->name('user.show');
    Route::get('/{user}/edit', App\Http\Controllers\Main\User\EditController::class)->name('user.edit');
    Route::patch('/{user}', App\Http\Controllers\Main\User\UpdateController::class)->name('user.update');
    Route::delete('/{user}', App\Http\Controllers\Main\User\DeleteController::class)->name('user.destroy');
});