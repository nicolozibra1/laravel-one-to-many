<?php

use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\TagController;


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

Route::get('/', function () {
    return view('home');
});
Route::get('about', function () {
    return view('about');
})->name('about');

Route::middleware(['auth', 'verified'])->name('admin.')->prefix('admin')->group(function(){
    Route::get('/', [DashboardController::class,'index'])->name('dashboard');
    Route::resource('posts', PostController::class)->parameters(['posts' => 'post:slug']);
    Route::resource('projects', ProjectController::class)->parameters(['projects' => 'project:slug']);
    Route::resource('types', TypeController::class)->parameters(['types' => 'type:slug']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('tags', TagController::class)->parameters(['tags' => 'tag:slug']);
});

require __DIR__.'/auth.php';
