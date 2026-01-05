<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\BeheerderController;
use App\Http\Controllers\BeheerderLoginController;
use App\Http\Controllers\admin\AdminRegistrationController;
use App\Http\Controllers\ArchiveController;



Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/standen', function () {
    // Bereken standen per poule
    $poules = \App\Models\Game::select('poule')->whereNotNull('poule')->distinct()->pluck('poule');
    $standen = [];

    foreach($poules as $poule) {
        $games = \App\Models\Game::with('team1', 'team2')->where('poule', $poule)->whereNotNull('score1')->get();
        $teamStats = [];

        foreach($games as $game) {
            $team1Id = $game->team1_id;
            $team2Id = $game->team2_id;

            if (!isset($teamStats[$team1Id])) {
                $teamStats[$team1Id] = ['team' => $game->team1, 'punten' => 0, 'gespeeld' => 0, 'gewonnen' => 0, 'gelijk' => 0, 'verloren' => 0, 'doelpunten_voor' => 0, 'doelpunten_tegen' => 0];
            }
            if (!isset($teamStats[$team2Id])) {
                $teamStats[$team2Id] = ['team' => $game->team2, 'punten' => 0, 'gespeeld' => 0, 'gewonnen' => 0, 'gelijk' => 0, 'verloren' => 0, 'doelpunten_voor' => 0, 'doelpunten_tegen' => 0];
            }

            $teamStats[$team1Id]['gespeeld']++;
            $teamStats[$team2Id]['gespeeld']++;
            $teamStats[$team1Id]['doelpunten_voor'] += $game->score1;
            $teamStats[$team1Id]['doelpunten_tegen'] += $game->score2;
            $teamStats[$team2Id]['doelpunten_voor'] += $game->score2;
            $teamStats[$team2Id]['doelpunten_tegen'] += $game->score1;

            if ($game->score1 > $game->score2) {
                $teamStats[$team1Id]['gewonnen']++;
                $teamStats[$team1Id]['punten'] += 3;
                $teamStats[$team2Id]['verloren']++;
            } elseif ($game->score1 < $game->score2) {
                $teamStats[$team2Id]['gewonnen']++;
                $teamStats[$team2Id]['punten'] += 3;
                $teamStats[$team1Id]['verloren']++;
            } else {
                $teamStats[$team1Id]['gelijk']++;
                $teamStats[$team2Id]['gelijk']++;
                $teamStats[$team1Id]['punten'] += 1;
                $teamStats[$team2Id]['punten'] += 1;
            }
        }

        // Sorteer op punten, dan doelsaldo
        usort($teamStats, function($a, $b) {
            if ($a['punten'] == $b['punten']) {
                $saldoA = $a['doelpunten_voor'] - $a['doelpunten_tegen'];
                $saldoB = $b['doelpunten_voor'] - $b['doelpunten_tegen'];
                return $saldoB <=> $saldoA;
            }
            return $b['punten'] <=> $a['punten'];
        });

        $standen[$poule] = $teamStats;
    }

    return view('standen', compact('standen'));
})->name('standen');

Route::get('/scores', function () {
    $games = \App\Models\Game::with('team1.school', 'team2.school')->whereNotNull('score1')->orderBy('played_at')->get();
    return view('scores', compact('games'));
})->name('scores');

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
    Route::get('/', [AdminRegistrationController::class, 'index'])->name('index');
    Route::patch('/{registration}/approve', [AdminRegistrationController::class, 'approve'])->name('approve');
    Route::get('/{registration}/edit', [AdminRegistrationController::class, 'edit'])->name('edit');
    Route::put('/{registration}', [AdminRegistrationController::class, 'update'])->name('update');
    Route::delete('/{registration}', [AdminRegistrationController::class, 'destroy'])->name('destroy');
    Route::patch('/{registration}/archive', [AdminRegistrationController::class, 'archive'])->name('archive');
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

        // Games routes
        Route::resource('games', \App\Http\Controllers\GameController::class)->names('games');
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

Route::get('/manage', [AdminRegistrationController::class, 'index'])
    ->name('beheerders.manage');

Route::prefix('beheer/registrations')
    ->middleware('auth:beheerder')
    ->name('admin.registrations.')
    ->group(function () {

        Route::patch('{registration}/approve', [AdminRegistrationController::class, 'approve'])
            ->name('approve');

        Route::get('{registration}/edit', [AdminRegistrationController::class, 'edit'])
            ->name('edit');

        Route::put('{registration}', [AdminRegistrationController::class, 'update'])
            ->name('update');

        Route::delete('{registration}', [AdminRegistrationController::class, 'destroy'])
            ->name('destroy');
        Route::patch('{registration}/archive', [AdminRegistrationController::class, 'archive'])
            ->name('archive');
    });
Route::get('/informatie', function () {
    return view('informatie');
})->name('informatie');

        