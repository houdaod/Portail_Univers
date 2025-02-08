<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\EnsureAdminIsApproved;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckSubscription;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\UniversityController;

Route::prefix('documents')->name('documents.')->group(function () {
    Route::get('/', [DocumentController::class, 'index'])->name('index');
    Route::get('/create', [DocumentController::class, 'create'])->name('create');
    Route::post('/store', [DocumentController::class, 'store'])->name('store');
    Route::get('/download/{document}', [DocumentController::class, 'download'])->name('download');
});

// Routes pour les universités
Route::prefix('admin/universites')->name('admin.universites.')->group(function () {
    Route::get('/create', [UniversityController::class, 'create'])->name('create');
    Route::post('/store', [UniversityController::class, 'store'])->name('store');
    Route::get('/manage', [UniversityController::class, 'manage'])->name('manage');
    Route::get('/list', [UniversityController::class, 'list'])->name('list');
});

// Routes pour les filières
Route::prefix('admin/filieres')->name('admin.filieres.')->group(function () {
    Route::get('/create', [ProgramController::class, 'create'])->name('create');
    Route::post('/store', [ProgramController::class, 'store'])->name('store');
    Route::get('/manage', [ProgramController::class, 'manage'])->name('manage');
    Route::get('/list', [ProgramController::class, 'list'])->name('list');
});

// Routes pour les utilisateurs
Route::prefix('admin/utilisateurs')->name('admin.utilisateurs.')->group(function () {
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/manage', [UserController::class, 'manage'])->name('manage');
    Route::get('/list', [UserController::class, 'list'])->name('list');
    Route::get('/abonnement', [UserController::class, 'abonnement'])->name('abonnement');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Routes accessibles uniquement pour les utilisateurs authentifiés
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Redirections basées sur le rôle et l'approbation de l'admin
    Route::middleware([CheckRole::class.':admin'])->group(function () {
        // Si l'admin est non approuvé, il sera redirigé ici
        Route::get('/admin/noapprovedashboard', [AdminController::class, 'noApprovedDashboard'])->name('admin.noapprovedashboard');
        
        // Routes réservées aux administrateurs approuvés
        Route::middleware(EnsureAdminIsApproved::class)->group(function () {
            Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
            // Ajoute d'autres routes d'administration ici
        });
    });

    // Routes réservées aux étudiants et autres utilisateurs
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
});

// Routes réservées aux administrateurs avec approbation
// Supprime "is_admin" et utilise directement les middlewares CheckRole et EnsureAdminIsApproved
Route::middleware(['auth', CheckRole::class.':admin', EnsureAdminIsApproved::class])->prefix('admin')->group(function() {
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('users', [AdminController::class, 'index'])->name('admin.users');
    Route::post('approve/{user}', [AdminController::class, 'approve'])->name('admin.approve');
    Route::get('no-approved-dashboard', [AdminController::class, 'noApprovedDashboard'])->name('admin.noapprovedash');
});

// Routes réservées à la bibliothèque
Route::middleware([CheckSubscription::class])->group(function () {
    Route::resource('library', LibraryController::class);
});

// Routes du forum
Route::middleware('auth')->group(function () {
    // Affichage de la liste des posts
    Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
    
    // Créer un nouveau post
    Route::get('/forum/create', [ForumController::class, 'create'])->name('forum.create');
    Route::post('/forum', [ForumController::class, 'store'])->name('forum.store');
    
    // Afficher un post et ses réponses
    Route::get('/forum/{id}', [ForumController::class, 'show'])->name('forum.show');
    
    // Répondre à un post
    Route::post('/forum/{postId}/replies', [ForumController::class, 'storeReply'])->name('forum.reply.store');
    
    // Modifier un post
    Route::get('/forum/{id}/edit', [ForumController::class, 'edit'])->name('forum.edit');
    Route::put('/forum/{id}', [ForumController::class, 'update'])->name('forum.update');
    
    // Supprimer un post
    Route::delete('/forum/{id}', [ForumController::class, 'destroy'])->name('forum.destroy');
});

// Déconnexion
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

require __DIR__.'/auth.php';
