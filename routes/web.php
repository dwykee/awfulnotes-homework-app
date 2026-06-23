<?php
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

    //landing route
    Route::get('/', function () {
        return view('landing', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    })->name('landing');

    //Auth
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/dashboard', function () {
            return redirect()->route('assignments.index');
        })->name('dashboard');


    // Home route
    // Assignment routes
    Route::get('/assignments', [AssignmentController::class, 'index'])->name('assignments.index');
    Route::post('/assignments', [AssignmentController::class, 'store'])->name('assignments.store');
    Route::put('/assignments/{assignment}', [AssignmentController::class, 'update'])->name('assignments.update');
    Route::delete('/assignments/{assignment}', [AssignmentController::class, 'destroy'])->name('assignments.destroy');

    // Team routes
    Route::post('/teams', [TeamController::class, 'store'])->name('teams.store');
    Route::post('/teams/join', [TeamController::class, 'join'])->name('teams.join');
    Route::delete('/teams/{team}/leave', [TeamController::class, 'leave'])->name('teams.leave');
    Route::delete('/teams/{team}', [TeamController::class, 'destroy'])->name('teams.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Ai
    Route::post('/ai/chat', [App\Http\Controllers\AiController::class, 'chat'])->name('ai.chat');

    // Google OAuth routes
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
        });
        
        Route::get('/test-nvidia', function () {
    return [
        'api_key_set' => !empty(config('services.nvidia.api_key')),
        'api_key_prefix' => substr(config('services.nvidia.api_key') ?? '', 0, 8),
        'model' => config('services.nvidia.model'),
        'url' => config('services.nvidia.url') ?? config('services.nvidia.api_url'),
    ];
});

    //avatar update route
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])
    ->name('profile.avatar.update');
require __DIR__.'/auth.php';
