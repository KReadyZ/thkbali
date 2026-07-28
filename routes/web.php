<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

// 1. Landing Page Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Public Auth & Upload Routes
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/forgot-password', [AuthController::class, 'resetPassword'])->name('password.reset.post');
Route::any('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/proposal/upload', [AuthController::class, 'uploadProposal'])->name('proposal.upload');

// 2. Admin Back Office Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.post');
    Route::any('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    
    // Protected admin routes
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/stats', [AdminController::class, 'updateStats'])->name('admin.stats.update');
        
        // CRUD News
        Route::post('/news/save/{id?}', [AdminController::class, 'saveNews'])->name('admin.news.save');
        Route::any('/news/delete/{id}', [AdminController::class, 'deleteNews'])->name('admin.news.delete');
        
        // CRUD Assessors
        Route::post('/assessor/save/{id?}', [AdminController::class, 'saveAssessor'])->name('admin.assessor.save');
        Route::any('/assessor/delete/{id}', [AdminController::class, 'deleteAssessor'])->name('admin.assessor.delete');
        
        // CRUD Agendas
        Route::post('/agenda/save/{id?}', [AdminController::class, 'saveAgenda'])->name('admin.agenda.save');
        Route::any('/agenda/delete/{id}', [AdminController::class, 'deleteAgenda'])->name('admin.agenda.delete');
        
        // CRUD Gallery
        Route::post('/gallery/save/{id?}', [AdminController::class, 'saveGallery'])->name('admin.gallery.save');
        Route::any('/gallery/delete/{id}', [AdminController::class, 'deleteGallery'])->name('admin.gallery.delete');
        
        // CRUD Award Categories
        Route::post('/category/save/{id}', [AdminController::class, 'saveCategory'])->name('admin.category.save');
        
        // CRUD Awardees
        Route::post('/awardee/save/{id?}', [AdminController::class, 'saveAwardee'])->name('admin.awardee.save');
        Route::any('/awardee/delete/{id}', [AdminController::class, 'deleteAwardee'])->name('admin.awardee.delete');

        // CRUD Proposals / Pendaftaran
        Route::post('/proposal/status/{id}', [AdminController::class, 'updateProposalStatus'])->name('admin.proposal.status');
        Route::any('/proposal/delete/{id}', [AdminController::class, 'deleteProposal'])->name('admin.proposal.delete');
    });
});

// 3. Assessor Panel Routes
Route::prefix('assessor')->middleware(['role:asesor'])->group(function () {
    Route::get('/', [\App\Http\Controllers\AssessorDashboardController::class, 'index'])->name('assessor.dashboard');
    Route::post('/proposal/status/{id}', [\App\Http\Controllers\AssessorDashboardController::class, 'updateStatus'])->name('assessor.proposal.status');
});

// 4. View Increment Routes
Route::post('/news/view/{id}', [\App\Http\Controllers\HomeController::class, 'incrementNewsView'])->name('news.view.increment');
Route::post('/agenda/view/{id}', [\App\Http\Controllers\HomeController::class, 'incrementAgendaView'])->name('agenda.view.increment');
