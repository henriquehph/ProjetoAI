<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FundsController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CatalogController;
use App\Models\User;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TransactionController;


Route::get('/', [ProductController::class, 'index'])->name('home'); // Rota para a página inicial, que lista os produtos

/* Route::get('/dashboard', function () { //Redireciona para a dashboard
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); //Só users verificados é que são encaminhados  */


Auth::routes(['verify' => true]); // Verificações de email;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Routes for Board Members
    Route::middleware('can:admin')->group(function () {
        Route::resource('users', UserController::class);

    });
});

Route::view('dashboard', 'dashboard')->name('dashboard');

//Route::middleware('auth')->get('/transactions/history/{user}', [TransactionController::class, 'history'])->name('transactions.history');
Route::get('transactions/history/{user?}', [TransactionController::class, 'history'])->name('transactions.history');

//Route::get('user/create', [UserController::class, 'create'])->name('user.create');
//Route::post('user', [UserController::class, 'store'])->name('user.store');
//Route::get('users', [UserController::class, 'index'])->name('users.index');
//Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
//Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
//Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
//Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');

//Route::resource('users', UserController::class);

//Catalog/Products Routes
Route::resource('products', ProductController::class);

Route::resource('orders', OrderController::class);

//Cart Routes
//Show the Cart
Route::get('cart', [CartController::class, 'show'])->name('cart.show');
// Add a product to the cart:
Route::post('cart/{product}', [CartController::class, 'addToCart'])->name('cart.add');
// Remove a product from the cart:
Route::delete('cart/{product}', [CartController::class, 'removeFromCart'])->name('cart.remove');
// Confirm (store) the cart and save products registration on the database:
Route::post('cart', [CartController::class, 'confirm'])->name('cart.confirm');
// Clear the cart:
Route::delete('cart', [CartController::class, 'destroy'])->name('cart.destroy');

require __DIR__ . '/auth.php';

//Pagina para carregar catálogo
//get pra listar os valeu
Route::get('catalog', [ProductController::class, 'index'])->name('catalog');


Route::middleware('auth')->group(function () {
    Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
});

//Página para carregar o cartão
//Um get para mostrar o formulário de carregamento do cartão
Route::get('/add-funds', [FundsController::class, 'showAddFundsPage'])->middleware('verified');

// Route para processar o pagamento
//Post para processar o pagamento
Route::post('/add-funds', [FundsController::class, 'addFunds'])->middleware('verified');

// Mostrar a página de pagamento de membership
Route::get('/membership/pay', [MembershipController::class, 'showPaymentForm'])->name('payments.pay');

// Processar o pagamento de membership
Route::post('/membership/pay', [MembershipController::class, 'processPayment'])->name('membership.process');
