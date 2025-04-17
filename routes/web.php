<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FundsController; 

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () { //Redireciona para a dashboard
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); //Só users verificados é que são encaminhados

Auth::routes(['verify' => true]); // Verificações de email;

Route::middleware('auth')->group(function () { //Operações CRUD
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


//Página para carregar o cartão
//Um get para mostrar o formulário de carregamento do cartão
Route::get('/add-funds', [FundsController::class, 'showAddFundsPage'])->middleware('verified');

// Route para processar o pagamento
//Post para processar o pagamento
Route::post('/add-funds', [FundsController::class, 'addFunds'])->middleware('verified');

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');