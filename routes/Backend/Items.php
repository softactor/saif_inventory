<?php
/*
 * Plant Equipment Management
 */
Route::group(['namespace' => 'Items'], function () {
    /*
     * category related operation:
     */
    Route::get('items/index', 'ItemsController@index')->name('items.index');
    Route::get('items/create', 'ItemsController@create')->name('items.create');
    Route::post('items/store', 'ItemsController@store')->name('items.store');
    Route::get('items/edit', 'ItemsController@edit');
    Route::post('items/update', 'ItemsController@update')->name('items.update');
    Route::get('items/delete/{delete_id}', 'ItemsController@delete');
    
    /*
     * sub material related operation route:
     */
    Route::get('get_child_items_by_parent', 'ItemsController@get_child_items_by_parent');
    Route::post('child_items/store', 'ItemsController@child_store')->name('child_items.store');
    Route::get('sub_material/edit', 'ItemsController@sub_material_edit');
    Route::post('sub_material/sub_material_update', 'ItemsController@sub_material_update')->name('sub_material.update');
    Route::get('sub_material/delete/{delete_id}', 'ItemsController@sub_material_delete');
    
    /*
     * Material related operation route:
     */
    Route::post('sub_child_items/store', 'ItemsController@sub_child_store')->name('sub_child_items.store');
    Route::post('inv_material/store', 'ItemsController@inv_material_store')->name('inv_material.store');
    Route::get('material/edit', 'ItemsController@material_edit');
    Route::post('material/material_update', 'ItemsController@material_update')->name('material.update');
    Route::get('material/delete/{delete_id}', 'ItemsController@material_delete');
});