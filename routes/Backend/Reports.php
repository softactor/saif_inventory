<?php
/*
 * Plant Equipment Management
 */
Route::group(['namespace'   =>   'Reports'], function () {
    Route::get('report/index', 'ReportsController@index')->name('reports.index');
});
