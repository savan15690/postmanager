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

// To home page (load login view)
Route::get('/', 'UserController@loadLoginView');

// To load login view
Route::get('/login', 'UserController@loadLoginView');

// To validate user
Route::post('/login', [
    'as' => 'usercontroller.login',
    'uses' => 'UserController@validateUser'
]);

// To logout user
Route::get('/logout', 'UserController@logoutUser')->name('LogoutUser');

// To register user
Route::get('/register', 'UserController@loadRegisterView');

// To store user details
Route::post('/register', [
    'as' => 'usercontroller.register',
    'uses' => 'UserController@store'
]);

// To post list
Route::get('/posts', [
    'as' => 'postcontroller.index',
    'uses' => 'PostController@index'
]);

// To post details
Route::get('/posts/show/{id}', [
    'as' => 'postcontroller.postdetails',
    'uses' => 'PostController@show'
]);

// Middleware to check user login
Route::group(['middleware' => ['checklogin']], function () {
    Route::get('/posts/create', [
        'as' => 'postcontroller.create',
        'uses' => 'PostController@create'
    ]);

    // To store post data
    Route::post('/posts/store', [
        'as' => 'postcontroller.store',
        'uses' => 'Postcontroller@store'
    ]);

    // To edit post
    Route::get('/posts/edit/{id}', [
        'as' => 'postcontroller.edit',
        'uses' => 'PostController@edit'
    ]);

    // To update post edited values in database 
    Route::post('/posts/update', [
        'as' => 'postcontroller.update',
        'uses' => 'PostController@update'
    ]);

    // To delete post
    Route::get('/posts/delete/{id}' ,[
        'as' => 'postcontroller.delete',
        'uses' => 'PostController@destroy'
    ]);
});

// To list user posts
Route::get('/posts/{id}', [
    'as' => 'postcontroller.userpost',
    'uses' => 'PostController@listUserPosts'
]);
