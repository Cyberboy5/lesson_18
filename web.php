<?php

USE App\Controllers\Controller;
USE App\Routes\Route;

// Main
Route::get('/',[Controller::class,'product_page']);
Route::get('/genre',[Controller::class,'genre']);
Route::get('/book',[Controller::class,'book']);




?>