<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();



Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return redirect()->route('adminDashboard');
    });
    Route::get('/login',[App\Http\Controllers\adminController::class, 'login'])->name('adminLogin');
    Route::post('/login',[App\Http\Controllers\adminController::class, 'loginHandler'])->name('adminLoginHandler');

    Route::get('/dashboard',[App\Http\Controllers\adminController::class, 'index'])->name('adminDashboard');
    Route::get('/election',[App\Http\Controllers\adminController::class, 'election'])->name('adminElection');
    Route::get('/election/create',[App\Http\Controllers\adminController::class, 'electionCreate'])->name('adminElectionCreate');
    Route::post('/election/create',[App\Http\Controllers\adminController::class, 'electionStore'])->name('adminElectionStore');
    Route::get('/election/edit/{id}',[App\Http\Controllers\adminController::class, 'electionEdit'])->name('adminElectionEdit');
    Route::put('/election/edit/{id}',[App\Http\Controllers\adminController::class, 'electionUpdate'])->name('adminElectionUpdate');
    Route::delete('/election',[App\Http\Controllers\adminController::class, 'electionDelete'])->name('adminElectionDelete');
    Route::get('/candidate',[App\Http\Controllers\adminController::class, 'candidate'])->name('adminCandidate');
    Route::get('/candidate/create',[App\Http\Controllers\adminController::class, 'candidateCreate'])->name('adminCandidateCreate');
    Route::post('/candidate/create',[App\Http\Controllers\adminController::class, 'candidateStore'])->name('adminCandidateStore');
    Route::get('/candidate/edit/{id}',[App\Http\Controllers\adminController::class, 'candidateEdit'])->name('adminCandidateEdit');
    Route::put('/candidate/edit/{id}',[App\Http\Controllers\adminController::class, 'candidateUpdate'])->name('adminCandidateUpdate');
    Route::delete('/candidate',[App\Http\Controllers\adminController::class, 'candidateDelete'])->name('adminCandidateDelete');
});

Route::prefix('user')->group(function () {
    Route::get('/', function() {
        return redirect()->route('home');
    });
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/vote', [App\Http\Controllers\HomeController::class, 'vote'])->name('vote');
    Route::post('/vote', [App\Http\Controllers\HomeController::class, 'voteHandler'])->name('voteHandler');
});
