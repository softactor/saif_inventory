<?php
/*
 * Plant Equipment Management
 */
Route::group(['namespace' => 'Items'], function () {
    Route::get('items/index', 'ItemsController@index')->name('items.index');
    Route::get('items/create', 'ItemsController@create')->name('items.create');
    Route::get('items/edit', 'ItemsController@edit');
    Route::post('items/store', 'ItemsController@store')->name('items.store');
    Route::post('child_items/store', 'ItemsController@child_store')->name('child_items.store');
    Route::post('sub_child_items/store', 'ItemsController@sub_child_store')->name('sub_child_items.store');
    Route::post('inv_material/store', 'ItemsController@inv_material_store')->name('inv_material.store');
    Route::post('items/update', 'ItemsController@update')->name('items.update');
    Route::get('items/delete/{delete_id}', 'ItemsController@delete');
    Route::get('get_child_items_by_parent', 'ItemsController@get_child_items_by_parent');
});