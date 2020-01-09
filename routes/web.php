<?php

Route::get('/', 'ProductController@index');
Route::get('/get-product', 'ProductController@getProduct');
Route::post('/add-product', 'ProductController@addProduct');
Route::post('/update-product', 'ProductController@updateProduct');
Route::post('/delete-product', 'ProductController@deleteProduct');

Route::get('/get-category', 'CategoryController@getCategory');
Route::post('/add-category', 'CategoryController@addCategory');

Route::get('/get-brand', 'BrandController@getBrand');
Route::post('/add-brand', 'BrandController@addBrand');

