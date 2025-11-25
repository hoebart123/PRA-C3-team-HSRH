<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('home');
})->name('home')->middleware('auth');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::get('/manage', function () {
    return view('manage');
})->name('manage');
Route::post('/contact', function (Request $request) {
    $data = $request->only('name', 'email', 'message');
    Message::create($data);

    return redirect()->route('contact')->with('success', 'Bericht verstuurd!');
})->name('contact.send');
