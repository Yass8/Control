<?php

use App\Http\Controllers\OperationsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


Route::get('/', function () {
    $operations = DB::table('operations')->whereVersionId(1)->get();
    return view('index', compact('operations'));
})->name('app');

Route::resource('operation', OperationsController::class);
