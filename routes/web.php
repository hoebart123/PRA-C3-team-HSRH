<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\BeheerderController;
use App\Http\Controllers\BeheerderLoginController;

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



Route::prefix('beheerder')->group(function () {
    // Login/Logout
    Route::get('login', [BeheerderLoginController::class, 'showLoginForm'])->name('beheerder.login');
    Route::post('login', [BeheerderLoginController::class, 'login'])->name('beheerder.login.submit');
    Route::post('logout', [BeheerderLoginController::class, 'logout'])->name('beheerder.logout');

    // Beschermde beheerder routes
    Route::middleware('auth:beheerder')->group(function () {
        Route::get('dashboard', [BeheerderController::class, 'index'])->name('beheerders.index');
        Route::get('beheerder/register', [BeheerderController::class, 'showRegistrationForm'])->name('beheerder.register');
        Route::post('beheerder/register', [BeheerderController::class, 'store'])->name('beheerder.register.submit');
        Route::post('/', [BeheerderController::class, 'store'])->name('beheerders.store');
        Route::post('{beheerder}/approve', [BeheerderController::class, 'approve'])->name('beheerders.approve');
        Route::delete('{beheerder}', [BeheerderController::class, 'destroy'])->name('beheerders.destroy');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Inschrijven
Route::get('/inschrijven', [RegistrationController::class, 'index'])->name('inschrijven');
Route::post('/inschrijven', [RegistrationController::class, 'store'])->name('registrations.store');
Route::delete('/inschrijven/{id}', [RegistrationController::class, 'destroy'])->name('inschrijven.delete');

Route::get('/inschrijven', [App\Http\Controllers\RegistrationController::class, 'create'])->name('registrations.create');
Route::post('/inschrijven', [App\Http\Controllers\RegistrationController::class, 'store'])->name('registrations.store');



require __DIR__.'/auth.php';
