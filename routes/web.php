<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard');
});

Route::get('/users', function () {
    return view('admin.users.index');
})->name('users.index');

Route::get('/users/create', function () {
    return view('admin.users.form', ['mode' => 'create']);
})->name('users.create');

Route::get('/users/{user}/edit', function (string $user) {
    return view('admin.users.form', ['mode' => 'edit', 'user' => $user]);
})->name('users.edit');
