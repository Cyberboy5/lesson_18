<?php

use App\Controller\ProductController;
USE App\Routes\Route;

// Main
Route::get('/',[ProductController::class,'product_page']);
Route::get('/create',[ProductController::class,'create']);

Route::post('/store',[ProductController::class,'store']);
Route::post('/edit',[ProductController::class,'edit_page']);
Route::post('/delete',[ProductController::class,'delete']);
Route::post('/update',[ProductController::class,'update']);

Route::get('/take_api',[ProductController::class,'take_api']);

?>