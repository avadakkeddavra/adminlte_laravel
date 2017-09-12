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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'HomeController@index',['as'=> 'main-page']);

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/products', 'ProductsController@index')->name('products-page');

    Route::post('/products/get-fields', 'ProductsController@getProductFields')->name('get-fields');

//    Route::post('/products/updateProduct', 'ProductsController@updateProduct');


    Route::resource('/products', 'ProductsController', [
        'only' => [ 'store','destroy','update' ]
    ]);
    Route::resource('/tags','TagsController',[
        'only' => ['store','destroy']
    ]);


    Route::group(['middleware' => 'auth.admin'], function(){
        Route::get('/users','UsersController@index')->name('users-page');

        Route::post('/users/checkEmail', "UsersController@checkEmail")->name('check-email');
        Route::post('/users/{user}/restore', 'UsersController@restore')->name('users-restore');

        Route::resource('/users', 'UsersController', [
            'only' => [ 'store','destroy','update' ]
        ]);
    });

});
