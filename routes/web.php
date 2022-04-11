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
   // return view('admin.dashboard');
   return redirect('dashboard');
});

Auth::routes();
Route::group(['middleware'=>'auth'] , function()
{   
    
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard',[App\Http\Controllers\DashboardController::class, 'dashboard']);
Route::get('/initiate',[App\Http\Controllers\DashboardController::class, 'initiate']);

/////////////////////////ADD CAPITAL 
Route::post('/addcapital',[App\Http\Controllers\DashboardController::class, 'addcapital']);

/////////////////////////ADD STOCK 
Route::get('/stock',[App\Http\Controllers\StocksController::class, 'stock']);
Route::post('/addstock',[App\Http\Controllers\StocksController::class, 'addstock']);

/////////////////////////ADD SALES
Route::get('/sales',[App\Http\Controllers\SalesController::class, 'sales']);
Route::post('/addsale',[App\Http\Controllers\SalesController::class, 'addsale']);
Route::get('/delivered/{id}',[App\Http\Controllers\SalesController::class, 'delivered']);
Route::get('/paid/{id}',[App\Http\Controllers\SalesController::class, 'paid']);

/////////////////////////ADD EXPENSES
Route::get('/expenses',[App\Http\Controllers\ExpensesController::class, 'expenses']);
Route::post('/addexpense',[App\Http\Controllers\ExpensesController::class, 'addexpense']);
//Route::get('/delivered/{id}',[App\Http\Controllers\SalesController::class, 'delivered']);
//Route::get('/paid/{id}',[App\Http\Controllers\SalesController::class, 'paid']);

/////////////////////////ADD BOOKINGS
Route::get('/bookings',[App\Http\Controllers\BookingsController::class, 'bookings']);
Route::post('/addbooking',[App\Http\Controllers\BookingsController::class, 'addbooking']);

/////////////////////////ADD LOANS
Route::get('/loans',[App\Http\Controllers\LoansController::class, 'loans']);
Route::post('/addloan',[App\Http\Controllers\LoansController::class, 'addloan']);
Route::post('/payloan/{id}',[App\Http\Controllers\LoansController::class, 'payloan']);

/////////////////////////ADD USERS
Route::get('/users',[App\Http\Controllers\UserController::class, 'users']);
Route::post('/addrole/{id}',[App\Http\Controllers\UserController::class, 'addrole']);
//Route::post('/payloan/{id}',[App\Http\Controllers\LoansController::class, 'payloan']);
   
});
