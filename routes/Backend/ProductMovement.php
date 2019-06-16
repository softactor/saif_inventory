<?php
/*
 * Product Receive Management
 */
Route::group(['namespace' => 'ProductMovement'], function () {
    Route::get('product_movement/index', 'ProductMovementController@index')->name('product_movement.index');
    Route::get('product_movement/create', 'ProductMovementController@create')->name('product_movement.create');
    Route::get('product_movement/edit/{edit_id}', 'ProductMovementController@edit');
    Route::post('product_movement/store', 'ProductMovementController@store')->name('product_movement.store');
    Route::post('product_movement/update', 'ProductMovementController@update')->name('product_movement.update');
    Route::get('product_movement/delete/{delete_id}', 'ProductMovementController@delete');
    Route::post('process_product_movement_url', 'ProductMovementController@process_product_movement_url')->name('product_movement.process_product_movement_url');
    Route::get('product_movement_list', 'ProductMovementController@product_movement_list')->name('product_movement.product_movement_list');
    Route::get('product_movement_view', 'ProductMovementController@product_movement_view')->name('product_movement.view');
    Route::post('process_product_movement_delete_url', 'ProductMovementController@process_product_movement_delete_url')->name('product_movement.process_product_movement_delete_url');
});