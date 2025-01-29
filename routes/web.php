<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\DashboardController;

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

Route::get('/personal', [PersonalController::class, 'index'])->name('personal.index');

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('professionals', ProfessionalController::class);    
    Route::resource('brands', App\Http\Controllers\BrandController::class);
    Route::resource('areas', App\Http\Controllers\AreaController::class);
    Route::resource('certifications', App\Http\Controllers\CertificationController::class);
    Route::resource('lines-families', App\Http\Controllers\LinesFamilyController::class);
    Route::resource('positions', App\Http\Controllers\PositionController::class);
    Route::resource('professional-areas', App\Http\Controllers\ProfessionalAreaController::class);
    Route::resource('professional-brands', App\Http\Controllers\ProfessionalBrandController::class);
    Route::resource('professional-certifications', App\Http\Controllers\ProfessionalCertificationController::class);
    Route::resource('professional-line-families', App\Http\Controllers\ProfessionalLineFamilyController::class);
    Route::resource('professional-skills', App\Http\Controllers\ProfessionalSkillController::class);
    Route::resource('states', App\Http\Controllers\StateController::class);
});

/*
    Rutas Admin 
    
    Ejecutar migraciones en /admin/tasks/db/migrate
    Ejecutar seeders en /admin/tasks/db/seed
    Ejecutar rollback en /admin/tasks/db/rollback
    etc.
  
    TODO: deben ser protegidas

    Route::prefix('admin/tasks/db')->middleware(['auth', 'admin'])->group(function () {
        // ... rutas anteriores
    });
*/

Route::prefix('admin/tasks/db')->group(function () {
    Route::get('/migrate', function () {
        try {
            Artisan::call('migrate');
            return "Migraciones ejecutadas exitosamente";
        } catch (\Exception $e) {
            return "Error al ejecutar migraciones: " . $e->getMessage();
        }
    });

    Route::get('/seed', function () {
        try {
            $output = new \Symfony\Component\Console\Output\BufferedOutput;
            Artisan::call('db:seed', [], $output);
            return nl2br($output->fetch());
        } catch (\Exception $e) {
            return nl2br($output->fetch() . "\n" . $e->getMessage() . "\n" . $e->getTraceAsString());
        }
    });

    Route::get('/rollback', function () {
        try {
            Artisan::call('migrate:rollback');
            return "Rollback ejecutado exitosamente";
        } catch (\Exception $e) {
            return "Error al ejecutar rollback: " . $e->getMessage();
        }
    });

    Route::get('/reset', function () {
        try {
            Artisan::call('migrate:reset');
            return "Reset ejecutado exitosamente";
        } catch (\Exception $e) {
            return "Error al ejecutar reset: " . $e->getMessage();
        }
    });
 
    Route::get('/fresh', function () {
        try {
            Artisan::call('migrate:fresh');
            return "Fresh ejecutado exitosamente";
        } catch (\Exception $e) {
            return "Error al ejecutar fresh: " . $e->getMessage();
        }
    });    
});

Route::prefix('admin/tasks')->group(function () {
     // Ruta para limpiar la caché
     Route::get('/cache/clear', function () {
        try {
            Artisan::call('config:clear');
            Artisan::call('view:clear');
            Artisan::call('cache:clear');
            return "Caché limpiada exitosamente";
        } catch (\Exception $e) {
            return "Error al limpiar la caché: " . $e->getMessage();
        }
    });
});

Route::redirect('/admin', '/professionals');