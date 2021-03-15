<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('educations','EducationController');
Route::get('educations/{id}/edit/','EducationController@edit');

// Route::get('educations-store','EducationController@storeExperience');

Route::resource('experiences','ExperienceController');
Route::get('experiences/{id}/edit/','ExperienceController@edit');