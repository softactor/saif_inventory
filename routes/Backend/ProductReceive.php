<?php
/*
 * Plant Equipment Management
 */
Route::group(['namespace' => 'ProductReceive'], function () {
    Route::get('product_receive/index', 'ProductReceiveController@index')->name('product_receive.index');
    Route::get('product_receive/create', 'ProductReceiveController@create')->name('product_receive.create');
    Route::get('product_receive/edit/{edit_id}', 'ProductReceiveController@edit');
    Route::post('product_receive/store', 'ProductReceiveController@store')->name('product_receive.store');
    Route::post('product_receive/update', 'ProductReceiveController@update')->name('product_receive.update');
    Route::get('product_receive/delete/{delete_id}', 'ProductReceiveController@delete');
    Route::post('process_product_receive_url', 'ProductReceiveController@process_product_receive_url')->name('product_receive.process_product_receive_url');
});