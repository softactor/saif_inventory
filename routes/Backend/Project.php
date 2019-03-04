<?php
/*
 * Plant Equipment Management
 */
Route::group(['namespace' => 'Projects'], function () {
    Route::get('projects/index', 'ProjectsController@index')->name('projects.index');
    Route::get('projects/create', 'ProjectsController@create')->name('projects.create');
    Route::get('projects/edit/{edit_id}', 'ProjectsController@edit');
    Route::post('projects/store', 'ProjectsController@store')->name('projects.store');
    Route::post('projects/update', 'ProjectsController@update')->name('projects.update');
    Route::get('projects/delete/{delete_id}', 'ProjectsController@delete');
});