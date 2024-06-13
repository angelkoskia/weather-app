<?php

use App\Http\Controllers\NoDatabaseWeatherController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DatabaseWeatherController;

Route::get('/dataBase', [DatabaseWeatherController::class, 'showWeather'])->name('dataBase');
Route::get('/noDataBase/{city}/{country_code?}',[NoDatabaseWeatherController::class, 'showWeather'])->name('noDataBase');


