<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CategoriaController;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;


// Route::resource('produtos', ProdutoController::class);
// Route::resource('categorias', CategoriaController::class);
// Route::resource('users', UserController::class);

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('users/pdf', [UserController::class, 'exportarPdf'])->name('users.pdf');
    Route::get('produtos/pdf', [ProdutoController::class, 'exportarPdf'])->name('produtos.pdf');

    Route::resource('produtos', ProdutoController::class);
    Route::resource('categorias', CategoriaController::class);

    Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});



require __DIR__ . '/auth.php';
