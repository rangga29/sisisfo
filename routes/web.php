<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::prefix('siproblem')->group(function () {
    Route::middleware(\App\Http\Middleware\Siproblem\GuestMiddleware::class)->group(function () {
        Route::get('/login', [\App\Http\Controllers\Siproblem\AuthenticatedSessionController::class, 'login'])->name('siproblem.auth.login');
        Route::post('/login', [\App\Http\Controllers\Siproblem\AuthenticatedSessionController::class, 'authenticate'])->name('siproblem.auth.authenticate');
    });
    Route::middleware(\App\Http\Middleware\Siproblem\AuthMiddleware::class)->group(function () {
        Route::get('/', [\App\Http\Controllers\Siproblem\HomeController::class, 'index'])->name('siproblem.home');
        Route::get('/reports/view-report/{spr}', [\App\Http\Controllers\Siproblem\ReportController::class, 'index'])->name('siproblem.report.view');
        Route::get('/reports/view-spr', [\App\Http\Controllers\Siproblem\ReportController::class, 'viewList'])->name('siproblem.report.view-list');
        Route::get('/reports/create-report', [\App\Http\Controllers\Siproblem\ReportController::class, 'create'])->name('siproblem.reports.create');
        Route::post('/reports/create-report', [\App\Http\Controllers\Siproblem\ReportController::class, 'store'])->name('siproblem.reports.store');
        Route::post('/reports/create-new-message/{spr}', [\App\Http\Controllers\Siproblem\ReportController::class, 'createNewMessage'])->name('siproblem.report.create-new-message');
        Route::post('/reports/change-status/{spr}/diproses', [\App\Http\Controllers\Siproblem\ReportController::class, 'statusDiproses'])->name('siproblem.report.status-diproses');
        Route::post('/reports/change-status/{spr}/dibatalkan', [\App\Http\Controllers\Siproblem\ReportController::class, 'statusDibatalkan'])->name('siproblem.report.status-dibatalkan');
        Route::post('/reports/change-status/{spr}/selesai', [\App\Http\Controllers\Siproblem\ReportController::class, 'statusSelesai'])->name('siproblem.report.status-selesai');
        Route::get('/reports/get-problems/{departmentId}', [\App\Http\Controllers\Siproblem\ReportController::class, 'getProblemsByDepartment'])->name('siproblem.reports.getProblemsByDepartment');

        Route::get('/administrator', [\App\Http\Controllers\Siproblem\AdminController::class, 'index'])->name('siproblem.admin');

        Route::get('/administrator/departments', [\App\Http\Controllers\Siproblem\DepartmentController::class, 'index'])->name('siproblem.admin.department');
        Route::get('/administrator/departments/create', [\App\Http\Controllers\Siproblem\DepartmentController::class, 'create'])->name('siproblem.admin.department.create');
        Route::post('/administrator/departments', [\App\Http\Controllers\Siproblem\DepartmentController::class, 'store'])->name('siproblem.admin.department.store');
        Route::get('/administrator/departments/{department}/edit', [\App\Http\Controllers\Siproblem\DepartmentController::class, 'edit'])->name('siproblem.admin.department.edit');
        Route::put('/administrator/departments/{department}', [\App\Http\Controllers\Siproblem\DepartmentController::class, 'update'])->name('siproblem.admin.department.update');
        Route::delete('/administrator/departments/{department}', [\App\Http\Controllers\Siproblem\DepartmentController::class, 'destroy'])->name('siproblem.admin.department.delete');

        Route::get('/administrator/users', [\App\Http\Controllers\Siproblem\UserController::class, 'index'])->name('siproblem.admin.user');
        Route::get('/administrator/users/import', [\App\Http\Controllers\Siproblem\UserController::class, 'import'])->name('siproblem.admin.user.import');
        Route::post('/administrator/users/update', [\App\Http\Controllers\Siproblem\UserController::class, 'update'])->name('siproblem.admin.user.update');

        Route::get('/administrator/problems', [\App\Http\Controllers\Siproblem\ProblemController::class, 'index'])->name('siproblem.admin.problem');
        Route::get('/administrator/problems/create', [\App\Http\Controllers\Siproblem\ProblemController::class, 'create'])->name('siproblem.admin.problem.create');
        Route::post('/administrator/problems', [\App\Http\Controllers\Siproblem\ProblemController::class, 'store'])->name('siproblem.admin.problem.store');
        Route::get('/administrator/problems/{problem}/edit', [\App\Http\Controllers\Siproblem\ProblemController::class, 'edit'])->name('siproblem.admin.problem.edit');
        Route::put('/administrator/problems/{problem}', [\App\Http\Controllers\Siproblem\ProblemController::class, 'update'])->name('siproblem.admin.problem.update');
        Route::delete('/administrator/problems/{problem}', [\App\Http\Controllers\Siproblem\ProblemController::class, 'destroy'])->name('siproblem.admin.problem.delete');

        Route::post('/logout', [\App\Http\Controllers\Siproblem\AuthenticatedSessionController::class, 'logout'])->name('siproblem.auth.logout');
    });
});
