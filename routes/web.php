<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudController;

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

Route::get('/', [CrudController::class, 'showData']);
Route::get('/add-Data', [CrudController::class, 'addData']);

Route::post('/send', [CrudController::class, 'storeData']);
Route::get('/edit/{id}', [CrudController::class, 'editData']);
Route::post('/update/{id}', [CrudController::class, 'updateData']);
Route::get('/delete/{id}', [CrudController::class, 'deleteData']);
Route::get('/get-upazilas/{district}', [CrudController::class, 'getUpazilas']);

/*Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});*/

require __DIR__.'/auth.php';
