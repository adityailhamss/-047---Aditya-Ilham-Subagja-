<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('authentication.login');
})->name('login');

Route::get('/logout', function () {
    return view('authentication.login');
})->name('logout');

Route::get('/dashboard', function () {
    return view('administrator.dashboard');
})->name('dashboard');

Route::get('/administrator-commodity', function () {
    return view('administrator.commodity.index');
})->name('administrator-commodity');

Route::get('/administrator-programstudy', function () {
    return view('administrator.program_study.index');
})->name('administrator-programstudy');

Route::get('/administrator-class', function () {
    return view('administrator.school_class.index');
})->name('administrator-class');

Route::get('/administrator-subject', function () {
    return view('administrator.subject.index');
})->name('administrator-subject');

Route::get('/administrator-history', function () {
    return view('administrator.borrowing.history.index');
})->name('administrator-history');

Route::get('/administrator-main', function () {
    return view('administrator.borrowing.main.index');
})->name('administrator-main');

Route::get('/administrator-student', function () {
    return view('administrator.student.index');
})->name('administrator-student');

Route::get('/administrator-admin', function () {
    return view('administrator.user.index');
})->name('administrator-admin');

