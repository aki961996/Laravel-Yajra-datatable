<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\LearningController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('categories')->group(function () {
    Route::get('/index', [CategoriesController::class, 'index'])->name('categories.index');
    Route::get('/create', [CategoriesController::class, 'create'])->name('categories.create');
    Route::post('/create', [CategoriesController::class, 'store'])->name('categories.store');
    Route::get('/{id}/edit', [CategoriesController::class, 'edit'])->name('categories.edit');
    Route::post('/{id}/delete', [CategoriesController::class, 'delete'])->name('categories.delete');

    Route::get('/{id}/view', [CategoriesController::class, 'view'])->name('categories.view');

    //learn
    Route::get('/next_page', [CategoriesController::class, 'next_page'])->name('categories.next_page');
});
