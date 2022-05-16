<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

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
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');


Route::group(['middleware' => 'auth'], function(){

    Route::get('/courses', [DashboardController::class,'courses'])->name('admin.courses');
    Route::get('/get-courses', [DashboardController::class,'getCourses'])->name('admin.getCourses');
    Route::post('/get-search', [DashboardController::class,'searchedCourses'])->name('admin.searchCourses');
    Route::post('/add-course', [DashboardController::class,'addCourse'])->name('admin.addCourses');
    Route::get('/delete-course/{id}', [DashboardController::class,'deleteCourse'])->name('admin.deleteCourses');
    Route::post('/update-course/{id}', [DashboardController::class,'updateCourse'])->name('admin.updateCourses');
    Route::post('/enroll-course/{id}', [DashboardController::class,'enrollCourse'])->name('enrollCourses');

});
