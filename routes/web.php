<?php

use App\Http\Controllers\Admin\{
    DashboardController as AdminDashboardController,
    DataPakarController,
    GejalaController,
    KecanduanController,
    SolutionController
};

use App\Http\Controllers\Guest\{
    DashboardController as GuestDashboardController,
    DiagnosaController,
};
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ROUTE FOR ADMIN
    Route::group(['auth', 'verified', 'middleware' => 'role:admin', 'prefix' => 'admin', 'as' => 'admin.'], function(){
        Route::resources([
            'kecanduan'         => KecanduanController::class,
            'solusi'            => SolutionController::class,
            'gejala'            => GejalaController::class,
            'dashboard'         => AdminDashboardController::class,
        ]);
    });

    // ROUTE FOR GUEST
    Route::group(['auth', 'verified', 'middleware' => 'role:guest', 'prefix'=> 'guest', 'as' => 'guest.'], function(){
        Route::resources([
            'diagnosa'          => DiagnosaController::class,
            'dashboard'         => GuestDashboardController::class,
        ]);
    });


});



require __DIR__.'/auth.php';
