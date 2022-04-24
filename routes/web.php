<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\home\HomeController;
use App\Http\Controllers\Expense\ExpenseController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Supplier\SupplierController;
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

// salary 
route::get('/salary',[EmployeeController::class,'salarypayment'])->name('salaryManage');
route::get('/salary/{id}',[EmployeeController::class,'editSalary'])->name('editSalary');
route::put('/salary-update/{id}',[EmployeeController::class,'salarypaymentUpdate'])->name('salaryUpdate');

// Category
route::resource('/category',CategoryController::class);
route::post('/create-child',[CategoryController::class,'createChild'])->name('createChild');
route::post('/delete-child/{id}',[CategoryController::class,'deleteChild'])->name('deleteChild');
route::get('/edit-child/{id}',[CategoryController::class,'editChild'])->name('editChild');
route::put('/update-child/{id}',[CategoryController::class,'updateChild'])->name('updateChild');

// Customers  
route::resource('/customer',CustomerController::class);

// Customers  
route::resource('/supplier',SupplierController::class);

// Product
route::resource('/product',ProductController::class);

// expense
route::resource('/expense',ExpenseController::class);
route::get('/today',[ExpenseController::class,'todayExpense'])->name('todayExpense');
route::get('/filter',[ExpenseController::class,'filter'])->name('filter');
route::get('/filter-expenses',[ExpenseController::class,'filterExpense'])->name('filterExpense');

