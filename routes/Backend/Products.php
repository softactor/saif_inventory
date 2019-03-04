<?php
/*
 * Plant Equipment Management
 */
Route::group(['namespace' => 'Products'], function () {
    Route::get('products/index', 'ProductsController@index')->name('products.index');
    Route::get('products/create', 'ProductsController@create')->name('products.create');
    Route::get('products/edit/{edit_id}', 'ProductsController@edit');
    Route::post('products/store', 'ProductsController@store')->name('products.store');
    Route::post('products/update', 'ProductsController@update')->name('products.update');
    Route::get('products/delete/{delete_id}', 'ProductsController@delete');
    Route::get('get_product_by_item_id', 'ProductsController@get_product_by_item_id')->name('products.get_product_by_item_id');
});