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

// Routes pour les universités
Route::prefix('admin/universites')->name('universities.')->group(function () {
    // Créer une nouvelle université

    Route::get('/create', [UniversityController::class, 'create'])->name('create');
    Route::post('/store', [UniversityController::class, 'store'])->name('store');

    // Afficher la liste des universités
    Route::get('/', [UniversityController::class, 'index'])->name('index');
    
 
    // Modifier une université
    Route::get('/edit/{university}', [UniversityController::class, 'edit'])->name('edit');
    Route::post('/update/{university}', [UniversityController::class, 'update'])->name('update');
    
    // Lister les universités
    Route::get('/list', [UniversityController::class, 'list'])->name('list');
    
    // Gérer une université spécifique
    Route::get('/manage/{university}', [UniversityController::class, 'manage'])->name('manage');
    
    // Supprimer une université
    Route::delete('/delete/{university}', [UniversityController::class, 'destroy'])->name('delete');
    //details d'universites
    Route::get('/show/{university}', [UniversityController::class, 'show'])->name('show');
    //research d'universite
    Route::get('/search', [UniversityController::class, 'search'])->name('search');
    //confirmation de suppression
    Route::get('/confirm-delete/{university}', [UniversityController::class, 'confirmDelete'])->name('confirmDelete');

});


// Routes pour les filières
Route::prefix('admin/programs')->name('admin.filieres.')->group(function () { 
    Route::get('/create', [ProgramController::class, 'create'])->name('create');
    Route::post('/store', [ProgramController::class, 'store'])->name('store');
    Route::get('/manage/{program}', [ProgramController::class, 'manage'])->name('manage'); // Modifié pour accepter un programme spécifique
    Route::get('/list', [ProgramController::class, 'list'])->name('list');
    Route::get('/edit/{program}', [ProgramController::class, 'edit'])->name('edit');
    Route::put('/update/{program}', [ProgramController::class, 'update'])->name('update');
    Route::delete('/destroy/{program}', [ProgramController::class, 'destroy'])->name('destroy');
    Route::get('/show/{program}', [ProgramController::class, 'show'])->name('show'); // Ajouté pour afficher les détails
});



// Routes pour les utilisateurs
Route::prefix('admin/utilisateurs')->name('admin.utilisateurs.')->group(function () {
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/manage', [UserController::class, 'manage'])->name('manage');
    Route::get('/list', [UserController::class, 'list'])->name('list');
    Route::get('/abonnement', [UserController::class, 'abonnement'])->name('abonnement');
});

// Route d'accueil
Route::get('/', function () {
    return view('welcome');
});

// Route du tableau de bord général
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes pour les utilisateurs authentifiés
Route::middleware('auth')->group(function () {
    // Gestion du profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Redirections basées sur le rôle et l'approbation de l'admin
    Route::middleware([CheckRole::class . ':admin'])->group(function () {
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
Route::middleware(['auth', CheckRole::class . ':admin', EnsureAdminIsApproved::class])->prefix('admin')->group(function () {
    // Tableau de bord administrateur
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('admin/users', [AdminController::class, 'users'])->name('admin.users');


    // Gestion des utilisateurs (CRUD)
    Route::prefix('users')->name('admin.users.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index'); // Liste des utilisateurs
        Route::get('/create', [AdminController::class, 'create'])->name('create'); // Formulaire de création
        Route::post('/store', [AdminController::class, 'store'])->name('store'); // Enregistrer un nouvel utilisateur
        Route::get('/{user}/edit', [AdminController::class, 'edit'])->name('edit'); // Formulaire de modification
        Route::put('/{user}', [AdminController::class, 'update'])->name('update'); // Mettre à jour un utilisateur
        Route::delete('/{user}', [AdminController::class, 'destroy'])->name('destroy'); // Supprimer un utilisateur
    });

    // Approuver un administrateur
    Route::post('approve/{user}', [AdminController::class, 'approve'])->name('admin.approve');

    // Tableau de bord pour les administrateurs non approuvés
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


//documents
Route::get('/documents/create/{programId?}', [DocumentController::class, 'create'])->name('documents.create');
Route::get('/documents/{program}', [DocumentController::class, 'index'])->name('documents.index');


// Déconnexion
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

require __DIR__ . '/auth.php';