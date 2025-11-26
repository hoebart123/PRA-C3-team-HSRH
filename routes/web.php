<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BeheerderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Message;
use App\Http\Controllers\RegistrationController;

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/beheerders', [BeheerderController::class, 'index'])->name('beheerders.index');
    Route::post('/beheerders', [BeheerderController::class, 'store'])->name('beheerders.store');
    Route::post('/beheerders/{beheerder}/approve', [BeheerderController::class, 'approve'])->name('beheerders.approve');
    Route::delete('/beheerders/{beheerder}', [BeheerderController::class, 'destroy'])->name('beheerders.destroy');
});

Route::post('/inschrijven/scholen', [RegistrationController::class, 'store'])->name('registrations.store');

require __DIR__.'/auth.php';
