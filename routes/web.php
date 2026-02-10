<?php

use App\Http\Controllers\Admin\BureauController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\PlayerController;
use App\Http\Controllers\Admin\TeamController as AdminTeamController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\TeamController;
use App\Http\Middleware\DevAutoLogin;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', fn () => Inertia::render('Home'))->name('home');

// Club
Route::get('/club/histoire', fn () => Inertia::render('club/Histoire'))->name('club.histoire');
Route::get('/club/bureau', [ClubController::class, 'bureau'])->name('club.bureau');
Route::get('/club/encadrement', [ClubController::class, 'encadrement'])->name('club.encadrement');

// Équipes
Route::get('/equipes/{section}', [TeamController::class, 'section'])
    ->where('section', 'seniors|jeunes|ecole-de-volley|loisirs|fsgt')
    ->name('equipes.section');
Route::get('/equipe/{slug}', [TeamController::class, 'show'])->name('equipes.show');

// Informations
Route::get('/informations/inscriptions', fn () => Inertia::render('informations/Inscriptions'))->name('informations.inscriptions');
Route::get('/informations/acces-aux-gymnases', fn () => Inertia::render('informations/AccesGymnases'))->name('informations.acces-gymnases');
Route::get('/informations/horaires-entrainements', fn () => Inertia::render('informations/Horaires'))->name('informations.horaires');
Route::get('/informations/contact', fn () => Inertia::render('informations/Contact'))->name('informations.contact');

// Accès statique
Route::get('/rib-bancaire', function () {
    return response()->file(public_path('images/rib_bancaire.jpg'));
})->name('rib');

// Partenariat
Route::get('/partenaires/devenir-notre-partenaire', fn () => Inertia::render('Partenariat'))->name('partenariat');

// Mentions légales & Plan du site
Route::get('/mentions-legales', fn () => Inertia::render('MentionsLegales'))->name('mentions-legales');
Route::get('/plan-du-site', fn () => Inertia::render('PlanDuSite'))->name('plan-du-site');

// Admin Auth
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->middleware(DevAutoLogin::class)->name('login');
    Route::get('/auth/redirect', [GoogleAuthController::class, 'redirect'])->name('auth.redirect');
    Route::get('/auth/callback', [GoogleAuthController::class, 'callback'])->name('auth.callback');
});

// Admin (protected)
Route::prefix('admin')->name('admin.')->middleware([DevAutoLogin::class, 'auth'])->group(function () {
    Route::post('/logout', [GoogleAuthController::class, 'logout'])->name('logout');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('equipes', AdminTeamController::class)->except(['show']);
    Route::delete('equipes/{equipe}/photo', [AdminTeamController::class, 'deletePhoto'])->name('equipes.deletePhoto');
    Route::resource('joueurs', PlayerController::class)->except(['show']);
    Route::delete('joueurs/{joueur}/photo', [PlayerController::class, 'deletePhoto'])->name('joueurs.deletePhoto');
    Route::resource('partenaires', PartnerController::class)->except(['show']);
    Route::resource('bureau', BureauController::class)->except(['show']);
});
