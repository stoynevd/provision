<?php

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'guest'], function () {

    Route::get('/register', 'Guest\PageController@showRegister');
    Route::get('/login', 'Guest\PageController@showLogin');

    Route::post('/user/login', 'Guest\ActionController@login');
    Route::post('/user/register', 'Guest\ActionController@register');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', 'User\ActionController@logout');
    Route::get('/user/dashboard', 'User\PageController@showDashboard');

    Route::get('/user/tasks/{id}', 'User\PageController@showTask');

    Route::post('/user/addNewTask', 'User\ActionController@addNewTask');
    Route::post('/user/updateTask', 'User\ActionController@updateTask');
    Route::post('/user/deleteTask', 'User\ActionController@deleteTask');
});
