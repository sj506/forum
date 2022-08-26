<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\boardController;

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
Route::get('/view/{id}', [boardController::class, 'show']);

Route::post('/store', [boardController::class, 'store'])->name('store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
require __DIR__.'/auth.php';

Route::group(['middleware' => ['auth']], function () {

Route::get('/write', [boardController::class, 'index'])->name('write')->middleware(['auth']);
Route::get('/delboard/{id}', [boardController::class, 'destroy'])->name('delboard');
Route::get('/updboard/{id}', [boardController::class, 'edit'])->name('updboard');
Route::post('/update/{id}', [boardController::class, 'update'])->name('update');
Route::post('/inscomment/{id}', [boardController::class, 'inscomment'])->name('inscomment');

});