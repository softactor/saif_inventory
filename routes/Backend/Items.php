<?php
/*
 * Plant Equipment Management
 */
Route::group(['namespace' => 'Items'], function () {
    Route::get('items/index', 'ItemsController@index')->name('items.index');
    Route::get('items/create', 'ItemsController@create')->name('items.create');
    Route::get('items/edit/{edit_id}', 'ItemsController@edit');
    Route::post('items/store', 'ItemsController@store')->name('items.store');
    Route::post('items/update', 'ItemsController@update')->name('items.update');
    Route::get('items/delete/{delete_id}', 'ItemsController@delete');
});