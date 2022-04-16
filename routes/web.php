<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\home\HomeController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Employees\EmployeeController;
use App\Http\Controllers\auth\AuthenticationController;

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




// login and registration

route::get('/login',[AuthenticationController::class,'loginPage'])->name('login');
route::get('/registration',[AuthenticationController::class,'registrationPage'])->name('registration');

route::post('/new-user',[AuthenticationController::class,'saveUser'])->name('register');
route::post('/login-user',[AuthenticationController::class,'login'])->name('Do.login');

//Dashboard

route::get('/',[HomeController::class,'home'])->name('home');
route::get('/logout',[AuthenticationController::class,'logout'])->name('logout');

// Employee
route::resource('/employee',EmployeeController::class);

// Customers  
route::resource('/customer',CustomerController::class);

