<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\LinesFamilyController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProfessionalAreaController;
use App\Http\Controllers\ProfessionalBrandController;
use App\Http\Controllers\ProfessionalCertificationController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\ProfessionalLineFamilyController;
use App\Http\Controllers\ProfessionalSkillController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
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

Route::get('/test-upload', [ImageUploadController::class, 'index'])->name('image.index');
Route::post('/upload', [ImageUploadController::class, 'store'])->name('image.store');

// Sirve imagenes en localstorage
Route::get('/img-uploads/{filename?}', [ImageController::class, 'show_uploads'])->name('image.show_uploads');

// Pruebas
Route::get('/test/get_image', [ TestController::class, 'get_image']);

// Ruta personal desprotegida (fuera del grupo auth)
Route::get('/personal', [PersonalController::class, 'index'])->name('personal.index');


Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    // Admin-only routes
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/dashboard', [ProfessionalController::class, 'index'])->name('dashboard');
        Route::resource('professionals', ProfessionalController::class);    
        Route::resource('brands', BrandController::class);
        Route::resource('areas', AreaController::class);
        Route::resource('certifications', CertificationController::class);
        Route::resource('lines-families', LinesFamilyController::class);
        Route::resource('positions', PositionController::class);
        Route::resource('professional-areas', ProfessionalAreaController::class);
        Route::resource('professional-brands', ProfessionalBrandController::class);
        Route::resource('professional-certifications', ProfessionalCertificationController::class);
        Route::resource('professional-line-families', ProfessionalLineFamilyController::class);
        Route::resource('professional-skills', ProfessionalSkillController::class);
        Route::resource('states', StateController::class);
    });

    // Personal route accessible by both admin and agent
    // Route::get('/personal', [PersonalController::class, 'index'])
    //     ->middleware('role:admin,agent')
    //     ->name('personal.index');

    // Admin dashboard route
    Route::get('/admin', [ProfessionalController::class, 'index'])
        ->middleware('role:admin')
        ->name('admin');
});

// Admin tasks routes (protected by auth and admin role)
Route::prefix('admin/tasks/db')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {
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
                $output = new \Symfony\Component\Console\Output\BufferedOutput;
                return nl2br($e->getMessage() . "\n" . $e->getTraceAsString());
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

Route::prefix('admin/tasks')
->middleware(['auth', 'role:admin'])
->group(function () {
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

    Route::get('/copy-public', function () {
        try {
            $command = '';
            
            // Detecta el sistema operativo y asigna el comando adecuado
            if (PHP_OS_FAMILY === 'Windows') {
                $command = 'xcopy public\ .\ /E /I /H /Y 2>&1';
            } else {
                $command = 'cp -R public/ ./ 2>&1';
            }

            // Ejecuta el comando del sistema
            $output = shell_exec($command);

            return $output ?: "La carpeta 'public/' fue copiada exitosamente a la raíz del proyecto.";
        } catch (\Exception $e) {
            return "Error al copiar la carpeta: " . $e->getMessage();
        }
    });
});


Route::redirect('/dashboard', '/professionals');
Route::redirect('/admin', '/professionals');