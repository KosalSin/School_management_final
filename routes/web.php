<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AttendantController;
use App\Http\Controllers\UserController;
use App\Models\Attendant;

//use App\Models\Student;

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin']);
Route::group(['middleware' => 'auth'], function () {
    // Dashbaord Page
    Route::get('/', [AuthController::class, 'index'])->middleware('auth');
    //Create Class
    Route::group(['prefix'=>'classes'], function(){
        Route::get('/', [ClassController::class, 'index'])->name('classes.index');
        Route::get('/create', [ClassController::class, 'create'])->name('create-class');
        Route::post('/store', [ClassController::class, 'store'])->name('store-class');
        //Edit 
        Route::get('/edit/{id}', [ClassController::class, 'edit'])->name('classes.edit');
        Route::post('/update/{id}', [ClassController::class, 'update'])->name('classes.update');
        //Delete
        Route::get('/destroy/{id}', [ClassController::class,'destroy'])->name('class.destroy');
        
    });
    //Student route
    Route::group(['prefix'=>'students'], function(){
        Route::get('/', [StudentController::class, 'index'])->name('student.index');
        Route::get('/create', [StudentController::class, 'create'])->name('create-student');
        Route::post('/store', [StudentController::class, 'store'])->name('store.student');
        Route::get('/edit/{id}', [StudentController::class, 'edit'])->name('student.edit');
        Route::post('/update/{id}', [StudentController::class, 'update'])->name('student.update');
        Route::get('/destroy/{id}', [StudentController::class,'destroy'])->name('student.destroy');
    });
    // Attendant Route
    Route::group(['prefix'=>'attendants'], function(){
        Route::get('/', [AttendantController::class, 'index'])->name('attendant.index');
        Route::get('/create', [AttendantController::class, 'create'])->name('attendant.create');
        Route::post('/store', [AttendantController::class, 'store'])->name('attendant.store');
        Route::get('/edit/{id}', [AttendantController::class, 'edit'])->name('attendant.edit');
        Route::post('/update/{id}', [AttendantController::class, 'update'])->name('attendant.update');
        Route::get('/destroy/{id}', [AttendantController::class,'destroy'])->name('attendant.destroy');
    });
    
    Route::group(['prefix'=>'users'], function(){
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/store', [UserController::class, 'store'])->name('user.store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('user.update');
        Route::get('/destroy/{id}', [UserController::class,'destroy'])->name('user.destroy');
        
    });
    

    // Logout system
    Route::get('/logout', [AuthController::class, 'logout']);
});