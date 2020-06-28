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
//Route::get('/forgot/password', "SecurityController@viewForgotPassword");
Route::get('/register', "SecurityController@viewRegister");

Route::middleware('auth.web')->group(function () {
    Route::get('/home', "TodoController@viewHome");

    // This group is used for internal API provided by session
    Route::prefix('/web')->group(function () {
        // Todo
        Route::get('/todo', "TodoController@todoList");
        Route::post('/todo', "TodoController@todoCreate");
        Route::put('/todo', "TodoController@todoEdit");
        Route::get('/todo/{id}', "TodoController@todoView");
        Route::delete('/todo/{id}', "TodoController@todoDelete");

        // Todo Item
        Route::get('/todo/item/mark/{id}', "TodoController@todoItemMarkComplete");
        Route::get('/todo/item/unmark/{id}', "TodoController@todoItemMarkNotComplete");

        Route::get('/todo/item/{todo_id}', "TodoController@todoItemList");
        Route::post('/todo/item', "TodoController@todoItemCreate");
        Route::put('/todo/item', "TodoController@todoItemEdit");
        Route::get('/todo/item/{id}', "TodoController@todoItemView");
        Route::delete('/todo/item/{id}', "TodoController@todoItemDelete");
    });
});

Route::post('/web/login', "SecurityController@formLogin");
Route::post('/web/register', "SecurityController@formRegister");
Route::get('/web/logout', "SecurityController@formLogout");
