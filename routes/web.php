<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PostController;
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

Route::get('/name/{namepar}', [App\Http\Controllers\NameFinder::class, 'findDetails'])->name('findDetails');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/typicode', [App\Http\Controllers\TypiCode::class, 'index'])->name('TypiCodeHome');




//  Route::resource('images', ImageController::class);


Route::group(['middleware' => 'auth'], function()
{
     Route::resource('images', ImageController::class);
});



/*Route::group(['middleware' => 'auth'], function()
{
	Route::resource('post', PostController::class);
    //Route::get('post/', [PostController::class, 'index']);
	//Route::get('post/{id}', [PostController::class, 'show']);
	//Route::post('post/', [PostController::class, 'store']);
	//Route::put('post/{id}', [PostController::class, 'update']);
	//Route::delete('post/{id}', [PostController::class, 'destroy']);
});*/
