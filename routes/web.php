<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth', 'admin'])->namespace('Admin')->group(function () {
    /*
    * Rutas para la especialidad
    */
    Route::get('/specialties', 'SpecialtyController@index');
    Route::get('/specialties/create', 'SpecialtyController@create');
    Route::get('/specialties/{specialty}/edit', 'SpecialtyController@edit');
    Route::post('/specialties', 'SpecialtyController@store');
    Route::put('/specialties/{specialty}', 'SpecialtyController@update');
    Route::delete('/specialties/{specialty}', 'SpecialtyController@destroy');
    /*
    * Rutas para los medicos
    */
    Route::resource('doctors', 'DoctorController');
    /*
    * Rutas para los pacientes
    */
    Route::resource('patients', 'PatientController');
});

Route::middleware(['auth', 'doctor'])->namespace('Doctor')->group(function () {
    /*
    * Rutas para el horario
    */
    Route::get('/schedule', 'ScheduleController@edit');
    Route::post('/schedule', 'ScheduleController@store');
});
