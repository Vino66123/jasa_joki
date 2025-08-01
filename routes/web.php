<?php

use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\ServiceController;
use App\Http\Controllers\Customer\PortfolioController;
use App\Http\Controllers\Customer\CustomerDashboardController;
use App\Http\Controllers\Customer\CustomerLoginController;
use App\Http\Controllers\Customer\CustomerRegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\AdminOrdersController;

use App\Http\Controllers\Admin\PaymentController;



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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// Route::middleware(['auth', 'customer'])->group(function () {
//     Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
//     // Tambahkan route customer lainnya di sini
// });
Route::get('/login', [CustomerLoginController::class, 'showLoginForm'])->name('customer.login');
Route::post('/login', [CustomerLoginController::class, 'login'])->name('customer.login.submit');
Route::post('/logout', [CustomerLoginController::class, 'logout'])->name('customer.logout');
Route::get('/register', [CustomerRegisterController::class, 'showRegistrationForm'])->name('customer.register');
Route::post('/register', [CustomerRegisterController::class, 'register'])->name('customer.register.submit');


Route::name('customer.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portofolio.index');
    // Route::get('/testimoni', [TestimonialController::class, 'index'])->name('testimonial.index');
    Route::get('/layanan', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/layanan/{service}', [ServiceController::class, 'show'])->name('services.show');  
});



Route::prefix('customer')->name('customer.dashboard.')->middleware(['auth', 'customer'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('index');
    Route::get('/orders', [CustomerDashboardController::class, 'orderHistory'])->name('order-history');
    Route::get('/orders/{id}', [CustomerDashboardController::class, 'showOrder'])->name('order-detail');
    Route::get('/orders/create', [CustomerDashboardController::class, 'createOrder'])->name('create-order');
    Route::post('/orders', [CustomerDashboardController::class, 'storeOrder'])->name('store-order');
    Route::get('/orders/{orderId}/payment', [CustomerDashboardController::class, 'showPayment'])->name('payment');
    Route::post('/orders/{orderId}/payment', [CustomerDashboardController::class, 'processPayment'])->name('process-payment');
    Route::get('/orders/{orderId}/testimonial', [CustomerDashboardController::class, 'createTestimonial'])->name('create-testimonial');
    Route::post('/orders/{orderId}/testimonial', [CustomerDashboardController::class, 'storeTestimonial'])->name('store-testimonial');
});

Route::get('admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
Route::post('admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

Route::prefix('admin')->name('admin.')->middleware(['auth:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/add-admin', [AdminController::class, 'createAdmin'])->name('create-admin');
    Route::post('/add-admin', [AdminController::class, 'storeAdmin'])->name('store-admin');
    Route::resource('orders', AdminOrdersController::class);
    Route::resource('services', AdminServiceController::class);
    Route::get('/customers', [AdminCustomerController::class, 'index'])->name('customers.index');
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::put('/pembayaran/{id}', [PaymentController::class, 'update'])->name('payments.update');
});



// require __DIR__.'/auth.php';
