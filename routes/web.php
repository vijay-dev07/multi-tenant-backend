<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompanyController;

use Illuminate\Support\Facades\Route;

use App\Models\Company;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $companies = Company::where('user_id', Auth::id())->paginate(5);
    return view('dashboard', compact('companies'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('companies', CompanyController::class)->except(['show']);
    Route::post('/switch-company', [CompanyController::class, 'switch'])->name('switch.company');

});

require __DIR__.'/auth.php';
