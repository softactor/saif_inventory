<?php
/*
 * Product Receive Management
 */
Route::group(['namespace' => 'ProductReturn'], function () {
    Route::get('product_return/index', 'ProductReturnController@index')->name('product_return.index');
    Route::get('product_return/create', 'ProductReturnController@create')->name('product_return.create');
    Route::get('product_return/edit/{edit_id}', 'ProductReturnController@edit');
    Route::post('product_return/store', 'ProductReturnController@store')->name('product_return.store');
    Route::post('product_return/update', 'ProductReturnController@update')->name('product_return.update');
    Route::get('product_return/delete/{delete_id}', 'ProductReturnController@delete');
    Route::post('process_product_return_url', 'ProductReturnController@process_product_return_url')->name('product_return.process_product_return_url');
    Route::get('product_return_list', 'ProductReturnController@product_return_list')->name('product_return.product_return_list');
    Route::get('product_return_view', 'ProductReturnController@product_return_view')->name('product_return.view');
    Route::post('process_product_return_delete_url', 'ProductReturnController@process_product_return_delete_url')->name('product_return.process_product_return_delete_url');
});