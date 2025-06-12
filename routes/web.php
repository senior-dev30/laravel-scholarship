<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScholarshipController;


Route::get('/', function () {
    return view('scholarship');
})->name('scholarship');


Route::post('/', [ScholarshipController::class, 'saveData'])->name('scholarship.saveData');
