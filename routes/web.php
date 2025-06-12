<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('user', UserController::class)->missing(function (Request $request) {
    return Redirect::route('user.index');
})->withTrashed(['show']);
