<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\boardController;
use App\Http\Controllers\commentController;
use App\Http\Controllers\likeController;
use App\Http\Controllers\uploadController;
// use Illuminate\Support\Facades\Auth;

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
Route::get('/', [ForumController::class, 'index'])->name('forum');
Route::get('/view/{id}', [boardController::class, 'show'])->name('view');
Route::post('/', [ForumController::class, 'index'])->name('search');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
require __DIR__.'/auth.php';

// Route::post('/search', [boardController::class, 'search'])->name('search');
// Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    Route::get('/write', [boardController::class, 'index'])->name('write');
    // Route::get('/write', [boardController::class, 'index'])->name('write')->middleware(['auth']);
    Route::get('/delboard/{id}', [boardController::class, 'destroy'])->name('delboard');
    Route::get('/updboard/{id}', [boardController::class, 'edit'])->name('updboard');
    Route::post('/update/{id}', [boardController::class, 'update'])->name('update');
    Route::post('/inscomment/{id}', [commentController::class, 'store'])->name('inscomment');
    Route::post('/store', [boardController::class, 'store'])->name('store');
    Route::get('/delcomment/{i_com}/{i_board}', [commentController::class, 'destroy'])->name('delcomment');
    Route::get('/insheart/{i_board}/{i_user}', [likeController::class, 'store'])->name('insheart');
    Route::get('/delheart/{i_board}/{i_user}', [likeController::class, 'destroy'])->name('delheart');
    Route::get('/page', [uploadController::class, 'index'])->name('page');
    Route::post('/upload', [uploadController::class, 'store'])->name('upload');

    Route::post('/insheart', [likeController::class, 'test'])->name('test');

});