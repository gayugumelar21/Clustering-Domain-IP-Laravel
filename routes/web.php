<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IpClassificationController;

Route::get('/', function () {
    return view('upload');
});

Route::post('/upload', [IpClassificationController::class, 'uploadFile'])->name('upload');
Route::post('/results', [IpClassificationController::class, 'showResults'])->name('results');
