<?php

use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\UserController;
use Facade\FlareClient\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//Route::get('/items', [ItemController::class, 'index']);
//Route::post('/item', [ItemController::class, 'store']);




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register', [UserController::class, 'store']);

Route::post('/login', [LoginController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/items', [ItemController::class, 'index']); // show items by user id
    Route::post('/addItem', [ItemController::class, 'store']); // create item by user id
    Route::get('/items/{item_id}', [ItemController::class, 'show']); //  show item details by user id
    Route::get('/search/{title}', [ItemController::class, 'search']); //  search item details by user id
    Route::put('/items/{item_id}', [ItemController::class, 'update']); // update item by user id and item id
    Route::delete('/items/{item_id}', [ItemController::class, 'destroy']); // delete item by user id and item id
    Route::post('/logout', [UserController::class, 'destroy']);
});
