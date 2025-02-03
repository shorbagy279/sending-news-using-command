<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserInputController;
use App\Jobs\TestJob;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/top-headlines', [NewsController::class, 'getTopNews']);

Route::get('/userinput/form', [UserInputController::class, 'showForm'])->name('userinput.form');
Route::post('/userinput/store', [UserInputController::class, 'store'])->name('userinput.store');



Route::get('/dispatch-test-job', function () {
    TestJob::dispatch();
    return 'TestJob dispatched!';
});




