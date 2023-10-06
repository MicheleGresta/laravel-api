<?php

use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\ProfileController;
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
    return view('admin.projects.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/admin/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/admin/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(["auth", "verified"])
    ->prefix("admin")
    ->name("admin.")
    ->group(function () {
        // CREATE
        
        Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
        Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
        
        // READ

        Route::get('/', [ProjectController::class, 'index'])->name('projects.index');
        Route::get('/projects/{projects}', [ProjectController::class, 'show'])->name('projects.show');
        
        // UPDATE
        
        Route::get('/projects/{projects}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
        // edit manda le modifiche a put / patch
        Route::put('/projects/{projects}', [ProjectController::class, 'update'])->name('projects.update');
        
        //DESTROY
        
        Route::delete('/projects/{projects}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    });

require __DIR__.'/auth.php';
