<?php

use App\Http\Controllers\VoteController;
use App\Http\Livewire\Admin\ChangePassword;
use App\Http\Livewire\Admin\Candidate;
use App\Http\Livewire\Admin\Dashboard;
use App\Http\Livewire\Admin\GetCandidateVotes;
use App\Http\Livewire\Admin\Login as AdminLogin;
use App\Http\Livewire\Admin\Position;
use App\Http\Livewire\Admin\Setting;
use App\Http\Livewire\Admin\Voter;
use App\Http\Livewire\Frontend\Home;
use App\Http\Livewire\Frontend\Login;
use App\Http\Livewire\Frontend\LogoutPage;
use App\Models\Admin;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'isvoted'])->group(function () {
    Route::get('/', Home::class)->name('front.home');
    Route::post('/vote', [VoteController::class, 'store'])->name('newVote');
    Route::get('/logout', Login::class)->name('front.logout');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/logout', LogoutPage::class)->name('front.logout');
});


Route::middleware(['guest'])->group(function () {
    Route::get('/login', Login::class)->name('front.login');
    Route::get('/admin', AdminLogin::class)->name('admin.login');
});

Route::middleware(['guest:admin'])->group(function () {
    Route::get('/admin/login', AdminLogin::class)->name('admin.login');
});


// admin routes
Route::middleware(['auth:admin'])->group(function () {
    Route::prefix('/admin')->group(function () {
        Route::get('/dashboard', Dashboard::class)->name('admin.dashboard');
        Route::get('/positions', Position::class)->name('admin.positions');
        Route::get('/candidates', Candidate::class)->name('admin.candidates');
        Route::post('/votersCsv', [VoteController::class, 'update'])->name('admin.votersUpload');
        Route::get('/voters', Voter::class)->name('admin.voters');
        Route::get('/settings', Setting::class)->name('admin.settings');
        Route::get('/change-password', ChangePassword::class)->name('admin.change_password');
        Route::get('/votes', GetCandidateVotes::class)->name('admin.votes');
    });
});

Route::get('/result', [VoteController::class, 'index'])->name('result');
