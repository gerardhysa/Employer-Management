<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Route::get('profile', 'UserController@profile')->name('profile');

Route::post('profile', 'UserController@update_avatar');

Route::post('profileupdate', 'UserController@update_info');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/datatable','UserController@getIndex');

Route::get('/anyData','UserController@anyData')->name('datatables.data');

Route::get('/delete/{id}','UserController@destroy');

Route::get('/profileEdit/{id}','UserController@getUserProfile');

Route::post('/profileEdit/{id}','UserController@getUserProfileInfoUpdated');

Route::post('/profileEditPhoto/{id}','UserController@getUserProfilePhotoUpdated');

Route::get('/addUser','UserController@createUser');

Route::post('/storeNewUser','UserController@storeUser');

Route::post('/login/custom', 'UserController@login')->name('login.custom');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/home', function(){
        return view('home');
    })->name('home');
    Route::get('/userHome', function(){
        return view('userHome');
    })->name('userHome');
});

Route::get('/departments', 'TreeController@treeview')->name('departments');

Route::post('/depusers', 'UserController@getUsersTable')->name('depusers.data');

Route::get('/editDep','UserController@editDep')->name('editDep');

Route::post('/storeNewDep', 'UserController@storeDep');

Route::get('/deleteDep/{id}','UserController@deleteDep');



