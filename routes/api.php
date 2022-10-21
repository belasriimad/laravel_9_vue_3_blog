<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('add/comment',[CommentController::class, 'store']);
Route::get('comments/{post_id}', [CommentController::class, 'getPostComments']);
Route::post('search', [HomeController::class, 'searchByTerm']);
