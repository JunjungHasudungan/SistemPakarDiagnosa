<?php

use App\Http\Controllers\Admin\{
    DataPakarController,
    GejalaController,
    KecanduanController,
    SolutionController
};

use App\Http\Controllers\Guest\{
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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ROUTE FOR ADMIN
    Route::group(['middleware' => 'role:admin', 'prefix' => 'admin', 'as' => 'admin.'], function(){
        Route::resources([
            'kecanduan'         => KecanduanController::class,
            'solusi'            => SolutionController::class,
            'gejala'            => GejalaController::class,
        ]);
    });

    // ROUTE FOR GUEST
    Route::group(['middlewate' => 'role:guest', 'prefix'=> 'guest', 'as' => 'guest.'], function(){
        Route::resources([
            'diagnosa'          => DiagnosaController::class,
        ]);
    });


});



require __DIR__.'/auth.php';
