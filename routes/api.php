<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\Product;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::post('/add-category', [CategoryController::class, 'Create_category']);

Route::get('/categories', [CategoryController::class, 'GetAllCategories']);
Route::get('/categories/{id}', [CategoryController::class, 'GetCategoryById']);
Route::post('/category/add', [CategoryController::class, 'Create_category']);
Route::put('/category/update/{id}', [CategoryController::class, 'Update_category']);
Route::delete('/category/delete/{id}', [CategoryController::class, 'Delete_category']);

Route::post('/category-product/add', [CategoryProduct::class, 'Create_Category']);
Route::put('/category-product/update/{id}', [CategoryProduct::class, 'Update_Category']);
Route::get('/categories-product', [CategoryProduct::class, 'getAllDataCategory']);
Route::get('/categories-product/{id}', [CategoryProduct::class, 'getDataById']);
Route::delete('/categories/delete/{id}', [CategoryProduct::class, 'Delete_category']);


Route::post('/product/created', [Product::class, 'Store']);
Route::put('/product/update/{id}', [Product::class, 'Update']);
Route::get('/product', [Product::class, 'Get']);
Route::get('/product/{id}', [Product::class, 'getDataById']);
Route::delete('/product/delete/{id}', [Product::class, 'deleteProduct']);