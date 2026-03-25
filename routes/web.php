<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.index');
})->name('index');

Route::get('debts', function () {
    return view('pages.debts');
})->name('debts');

Route::get('payments', function () {
    return view('pages.payments');
})->name('payments');
Route::get('profile', function () {
    return view('pages.users.profile');
})->name('profile');
Route::get('register', function () {
    return view('pages.Auth.register');
})->name('register');

Route::get('login', function () {
    return view('pages.Auth.login');
})->name('login');
