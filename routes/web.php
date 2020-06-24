<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', "SecurityController@initSystem");
Route::get('/login', "SecurityController@viewLogin")->name('login');

Route::middleware('auth.web')->group(function () {
    Route::get('/home', "TodoController@viewHome");

    // This group is used for internal API provided by session
    Route::prefix('/web')->group(function () {
        Route::get('/todo', "TodoController@todoList");
        Route::post('/todo', "TodoController@todoCreate");
        Route::put('/todo', "TodoController@todoEdit");
        Route::get('/todo/{id}', "TodoController@todoView");
        Route::delete('/todo/{id}', "TodoController@todoDelete");
    });
});

Route::post('/web/login', "SecurityController@formLogin");
Route::get('/web/logout', "SecurityController@formLogout");
