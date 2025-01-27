<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('areas', App\Http\Controllers\API\AreaAPIController::class)
    ->except(['create', 'edit']);

Route::resource('brands', App\Http\Controllers\API\BrandAPIController::class)
    ->except(['create', 'edit']);

Route::resource('certifications', App\Http\Controllers\API\CertificationAPIController::class)
    ->except(['create', 'edit']);

Route::resource('lines-families', App\Http\Controllers\API\LinesFamilyAPIController::class)
    ->except(['create', 'edit']);

Route::resource('positions', App\Http\Controllers\API\PositionAPIController::class)
    ->except(['create', 'edit']);

Route::resource('professionals', App\Http\Controllers\API\ProfessionalAPIController::class)
    ->except(['create', 'edit']);

Route::resource('professional-brands', App\Http\Controllers\API\ProfessionalBrandAPIController::class)
    ->except(['create', 'edit']);

Route::resource('skills', App\Http\Controllers\API\SkillAPIController::class)
    ->except(['create', 'edit']);

Route::resource('states', App\Http\Controllers\API\StateAPIController::class)
    ->except(['create', 'edit']);

Route::resource('professional-areas', App\Http\Controllers\API\ProfessionalAreaAPIController::class)
    ->except(['create', 'edit']);

Route::resource('professional-certifications', App\Http\Controllers\API\ProfessionalCertificationAPIController::class)
    ->except(['create', 'edit']);

Route::resource('professional-line-families', App\Http\Controllers\API\ProfessionalLineFamilyAPIController::class)
    ->except(['create', 'edit']);

Route::resource('professional-skills', App\Http\Controllers\API\ProfessionalSkillAPIController::class)
    ->except(['create', 'edit']);