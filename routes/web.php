<?php

use App\Http\Controllers\deviceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
Route::get('/customroms', function () {
    return view('customroms');
});
Route::get('/{id}/', [deviceController::class, 'show'])->name('customroms.show');
