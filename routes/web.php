<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\BeheerderController;
use App\Http\Controllers\BeheerderLoginController;
use App\Http\Controllers\admin\AdminSchoolController;
use App\Http\Controllers\ArchiveController;



Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', function (Request $request) {
    $data = $request->only('name', 'email', 'message');
    Message::create($data);

    return redirect()->route('contact')->with('success', 'Bericht verstuurd!');
})->name('contact.send');

Route::get('/archief', [ArchiveController::class, 'index'])->name('archief.index');

Route::post('/inschrijven', [RegistrationController::class, 'store'])
    ->name('registrations.store');

Route::prefix('beheer')->name('admin.scholen.')->group(function () {
    Route::get('/', [AdminSchoolController::class, 'index'])->name('index');
    Route::patch('/{school}/approve', [AdminSchoolController::class, 'approve'])->name('approve');
    Route::get('/{school}/edit', [AdminSchoolController::class, 'edit'])->name('edit');
    Route::put('/{school}', [AdminSchoolController::class, 'update'])->name('update');
    Route::delete('/{school}', [AdminSchoolController::class, 'destroy'])->name('destroy');
    Route::patch('/{school}/archive', [AdminSchoolController::class, 'archive'])->name('archive');
});
// Beheerder routes
Route::prefix('beheerder')->group(function () {
    Route::get('login', [BeheerderLoginController::class, 'showLoginForm'])->name('beheerder.login');
    Route::post('login', [BeheerderLoginController::class, 'login'])->name('beheerder.login.submit');
    Route::post('logout', [BeheerderLoginController::class, 'logout'])->name('beheerder.logout');

    Route::middleware('auth:beheerder')->group(function () {
        Route::get('profile', [BeheerderController::class, 'editProfile'])
        ->name('beheerders.profile.edit');
        Route::patch('profile', [BeheerderController::class, 'updateProfile'])
        ->name('beheerders.profile.update');
        Route::get('dashboard', [BeheerderController::class, 'index'])->name('beheerders.index');
        Route::post('/', [BeheerderController::class, 'store'])->name('beheerders.store');
        Route::post('{beheerder}/approve', [BeheerderController::class, 'approve'])->name('beheerders.approve');
        Route::delete('{beheerder}', [BeheerderController::class, 'destroy'])->name('beheerders.destroy');
    });
});

// Gebruiker routes
Route::middleware('auth')->group(function () {
    // Profiel
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Inschrijven
    Route::get('/inschrijven', [RegistrationController::class, 'create'])->name('registrations.create');
    Route::post('/inschrijven', [RegistrationController::class, 'store'])->name('registrations.store');
    Route::delete('/inschrijven/{id}', [RegistrationController::class, 'uitschrijven'])->name('inschrijven.delete');
});

require __DIR__.'/auth.php';

Route::get('/beheerder/register', [BeheerderController::class, 'showRegistrationForm'])
    ->name('beheerder.register');

Route::post('/beheerder/register', [BeheerderController::class, 'store'])
    ->name('beheerder.register.submit');


Route::get('beheerder/forgot-password', [BeheerderLoginController::class, 'showForgotPasswordForm'])
    ->name('beheerder.password.request');

Route::post('beheerder/forgot-password', [BeheerderLoginController::class, 'sendTemporaryPassword'])
    ->name('beheerder.password.email');

Route::get('/manage', [AdminSchoolController::class, 'manage'])
    ->name('beheerders.manage');


        