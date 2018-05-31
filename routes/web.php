<?php

Route::group(['middleware' => 'admin'], function(){
    Route::resource('courses', 'CourseController');
    Route::resource('groups', 'GroupController');
    Route::resource('lectures', 'LectureController');
    Route::resource('messages', 'MessageController');
    Route::resource('users', 'UserController');
    Route::post('filterSelectList/{id}', 'GroupController@getStudentsByGroup');
    Route::get('removeFile/{id}', 'FileController@removeFile')->name('removeFile');
});

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('showMessages', 'MessageController@showMessages')->name('showMessages');
Route::get('showLectures/{id}', 'LectureController@showLectures')->name('showLectures')->middleware('lecturesFilter');
Route::get('showMessage/{id}', 'MessageController@showMessage')->name('showMessage')->middleware('messagesFilter');
