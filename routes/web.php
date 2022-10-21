<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('category/{category}/posts', [HomeController::class, 'postsByCategory'])
->name('category.posts');
Route::get('tag/{tag}/posts', [HomeController::class, 'postsByTag'])
->name('tag.posts');
Route::get('change/lang/{lang}', [HomeController::class, 'changeLang'])
->name('change.lang');

Route::resource('posts', PostController::class);
Route::get('premium/{post}', [PostController::class, 'togglePremium'])
->name('toggle.premium');
Route::get('published/{post}', [PostController::class, 'togglePublished'])
->name('toggle.published');

Route::prefix('admin')->group(function(){
    Route::middleware('admin')->group(function(){
        Route::get('dashboard',[AdminController::class, 'index'])->name('admin.index');
        Route::post('logout',[AdminController::class, 'logout'])->name('admin.logout');
    });
    Route::post('login',[AdminController::class, 'login'])->name('admin.login');
    Route::get('login',[AdminController::class, 'loginForm'])->name('admin.loginForm');
});
