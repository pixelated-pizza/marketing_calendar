<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('weekly_calendar');  
})->name('weekly_calendar');
