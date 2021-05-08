<?php

use App\Http\Controllers\CoursesController;
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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/aboutus', function () {
    return view('wip');
})->name('aboutus');

Route::get('/courses', [CoursesController::class, 'index'])->name('courses.index');
Route::post('/courses', [CoursesController::class, 'store'])->middleware('auth')->name('courses.store');
Route::get('/courses/create', [CoursesController::class, 'create'])->middleware('auth')->name('courses.create');
Route::get('/courses/{course}/edit', [CoursesController::class, 'edit'])->middleware('auth')->name('courses.edit');
Route::get('/courses/{course}', [CoursesController::class, 'show'])->name('courses.show');
