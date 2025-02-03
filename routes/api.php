<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;


Route::get('/top-test', [NewsController::class, 'getTopNews']);
