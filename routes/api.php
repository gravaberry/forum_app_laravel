<?php

use App\Http\Controllers\FeedController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/test', function(){
    return response(
        ['message'=>'api working'],200
    );
});


Route::post('/register',[LoginController::class, 'register']);
Route::post('/login',[LoginController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function() {

    Route::get('/feeds',[FeedController::class, 'index']);
    Route::post('/feeds/store',[FeedController::class, 'store']);
    Route::post('/feeds/like/{feed_id}',[FeedController::class, 'likepost']);
    Route::post('/feeds/comment/{feed_id}',[FeedController::class, 'comment']);
    Route::get('/feeds/comments/{feed_id}',[FeedController::class, 'getComment']);
   });
