<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('students',[StudentController::class,'index']);
Route::get('fetch-students',[StudentController::class,'fetchstudent']);
Route::post('students',[StudentController::class,'store']);
Route::get('edit-student/{id}',[StudentController::class,'edit']);
Route::put('update-student/{id}',[StudentController::class,'update']);
Route::post('delete-student/{id}',[StudentController::class,'destroy']);
Route::get('/autocomplete',[StudentController::class,'autocomplete'])->name('autocomplete');

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/students',[StudentController::class,'index']);
//Route::post('/students',[StudentController::class,'store'])->name('student.store');
