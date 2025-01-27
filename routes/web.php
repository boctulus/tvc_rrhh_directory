<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstructorController;

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


Route::get('/personal/example', function () {
    return view('personal.example-v4');
});

Route::get('/personal', [InstructorController::class, 'index'])->name('instructor.index');

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::resource('brands', App\Http\Controllers\BrandController::class);
Route::resource('areas', App\Http\Controllers\AreaController::class);
Route::resource('certifications', App\Http\Controllers\CertificationController::class);
Route::resource('lines-families', App\Http\Controllers\LinesFamilyController::class);
Route::resource('positions', App\Http\Controllers\PositionController::class);
Route::resource('professionals', App\Http\Controllers\ProfessionalController::class);
Route::resource('professional-areas', App\Http\Controllers\ProfessionalAreaController::class);
Route::resource('professional-brands', App\Http\Controllers\ProfessionalBrandController::class);
Route::resource('professional-certifications', App\Http\Controllers\ProfessionalCertificationController::class);
Route::resource('professional-line-families', App\Http\Controllers\ProfessionalLineFamilyController::class);
Route::resource('professional-skills', App\Http\Controllers\ProfessionalSkillController::class);
Route::resource('states', App\Http\Controllers\StateController::class);