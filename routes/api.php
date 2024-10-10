<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ClassroomController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\TaskController;
use App\Models\Project;
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


// register
// logout
// Route::post('users/{id}',[AuthController::class,'login']);

Route::prefix('projects')->group(function () {
    Route::get('/', [ProjectController::class, 'index'])->name('projects.index');
    Route::post('/', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('{project}', [ProjectController::class, 'show'])->name('projects.show');
    Route::delete('{project}', [ProjectController::class, 'delete'])->name('projects.delete');
    Route::put('{project}', [ProjectController::class, 'update'])->name('projects.update');

    Route::prefix('{project}/tasks')->group(function () {
        Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
        Route::post('/', [TaskController::class, 'store'])->name('tasks.store');
        Route::get('{task}', [TaskController::class, 'show'])->name('tasks.show');
        Route::delete('{task}', [TaskController::class, 'delete'])->name('tasks.delete');
        Route::put('{task}', [TaskController::class, 'update'])->name('tasks.update');
    });
});







Route::apiResource('classrooms',ClassroomController::class);
Route::apiResource('subjects',SubjectController::class);
Route::apiResource('students',StudentController::class);
Route::apiResource('passports',StudentController::class);