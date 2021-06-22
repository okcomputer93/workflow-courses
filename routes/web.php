<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\WatchCoursesController;
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


Route::get('/user/{any?}', [UserProfileController::class, 'index'])
    ->where('any', '(dashboard|profile)')
    ->middleware('auth')
    ->name('profile.show');

Route::resource('courses', CoursesController::class)
    ->parameters(['courses' => 'course:slug'])
    ->except('index', 'show', 'destroy')
    ->middleware('auth');

Route::resource('courses', CoursesController::class)
    ->parameters(['courses' => 'course:slug'])
    ->only('index', 'show');


Route::post('/courses/{course:slug}/watch', [WatchCoursesController::class, 'save'])
    ->middleware('auth')
    ->name('courses.save');

Route::get('/courses/{course:slug}/watch', [WatchCoursesController::class, 'watch'])
    ->middleware('auth')
    ->name('courses.watch');



Route::patch('/user/role-information', [RolesController::class, 'update'])
    ->name('user-role-information.update');

Route::get('/user/register-professor', [RolesController::class, 'create'])
    ->middleware('auth')
    ->name('user-role-information.create');


Route::middleware('only.ajax')->prefix('/api')->group(function () {
    Route::get('/user/information', [ApiController::class, 'userInformation'])
        ->middleware('auth');

    Route::get('/courses/last', [ApiController::class, 'lastCourses']);

    Route::get('/courses/{course}/comments', [CommentsController::class, 'index']);

    Route::post('/courses/{course}/comments', [CommentsController::class, 'store'])
        ->middleware('auth');
});
