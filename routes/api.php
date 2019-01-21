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
Route::apiResource('buyer.transactions', 'Buyer\BuyerTransactionController', ['only'=>['index']]);
Route::apiResource('buyer.products', 'Buyer\BuyerProductController', ['only'=>['index']]);
Route::apiResource('buyer.sellers', 'Buyer\BuyerSellerController', ['only'=>['index']]);
Route::apiResource('buyer.categories', 'Buyer\BuyerCategoryController', ['only'=>['index']]);

// category
Route::apiResource('category', 'Category\CategoryController');
Route::apiResource('category.products', 'Category\CategoryProductController', ['only'=>'index']);
Route::apiResource('category.seller', 'Category\CategorySellerController', ['only'=>'index']);
Route::apiResource('category.transactions', 'Category\CategoryTransactionController', ['only'=>'index']);
Route::apiResource('category.buyer', 'Category\CategoryBuyerController', ['only'=>'index']);

// Product
Route::apiResource('product', 'Product\ProductController',['only'=>['index','show']]);

// Seller
Route::apiResource('seller', 'Seller\SellerController', ['only'=>['index','show']]);

// Transaction
Route::apiResource('transaction', 'Transaction\TransactionController', ['only'=>['index','show']]);
Route::apiResource('transaction.categories', 'Transaction\TransactionCategoryController', ['only'=>['index']]);
Route::apiResource('transaction.sellers', 'Transaction\TransactionSellerController', ['only'=>['index']]);

// User
Route::apiResource('user', 'User\UserController');



