<?php
/*
 * Plant Equipment Management
 */
Route::group(['namespace' => 'ProductChallan'], function () {
    Route::get('product_challan/index', 'ProductChallanController@index')->name('product_challan.index');
    Route::get('product_challan/create', 'ProductChallanController@create')->name('product_challan.create');
    Route::get('product_challan/edit/{edit_id}', 'ProductChallanController@edit');
    Route::post('product_challan/store', 'ProductChallanController@store')->name('product_challan.store');
    Route::post('product_challan/update', 'ProductChallanController@update')->name('product_challan.update');
    Route::get('product_challan/delete/{delete_id}', 'ProductChallanController@delete');
});