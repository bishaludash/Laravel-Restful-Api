<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Buyer
Route::apiResource('buyer', 'Buyer\BuyerController', ['only'=>['index','show']]);

// category
Route::apiResource('category', 'Category\CategoryController');

// Product
Route::apiResource('product', 'Product\ProductController',['only'=>['index','show']]);

// Seller
Route::apiResource('seller', 'Seller\SellerController', ['only'=>['index','show']]);

// Transaction
Route::apiResource('transaction', 'Transaction\TransactionController', ['only'=>['index','show']]);

// User
Route::apiResource('user', 'User\UserController');


