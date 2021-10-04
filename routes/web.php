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

Route::get('/home', function () {
    return view('welcome');
});



Route::group(

    ['middleware' => ['auth:sanctum']],
    function () {
        Route::get('/items/{id}', 'App\Http\Controllers\Web\ItemController@index');
        Route::get('/create', 'App\Http\Controllers\Web\ItemController@create');
        Route::get('/save_new_item/{id}', 'App\Http\Controllers\Web\ItemController@store');
        Route::get('/delete/{user_id}/{item_id}', 'App\Http\Controllers\Web\ItemController@destroy');
        Route::get('/update/{user_id}/{item_id}', 'App\Http\Controllers\Web\ItemController@update');
        Route::get('/edit/{user_id}/{item_id}', 'App\Http\Controllers\Web\ItemController@edit');
        Route::get('/show/{user_id}/{item_id}', 'App\Http\Controllers\Web\ItemController@show');
        Route::get('/autocompleteSearch', [ItemController::class, 'autocompleteSearch']);
    }
);
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
