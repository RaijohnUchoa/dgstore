<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    global $categories;
    global $brands;
    $categories = Category::orderBy('category_name', 'ASC')->where('is_active', 1)->get();
    $brands = Brand::orderBy('brand_name', 'ASC')->where('is_active', 1)->get();
    $products = DB::table('products')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->select('products.*', 'categories.category_name', 'brands.brand_name')
        ->orderBy('brand_id', 'ASC')
        ->where('products.is_active', 1)
        ->get();
    return view('layouts.app', compact('products', 'categories', 'brands'));
});

Route::middleware('auth')->group(function () {
    Route::view('app', 'layouts.app')->name('app');
});
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
// USUÁRIOS
Route::get('/usersread', [AuthController::class, 'usersread'])->name('usersread');
Route::post('/userscreate', [AuthController::class, 'userscreate'])->name('userscreate');
Route::get('/usersedit/{id}', [AuthController::class, 'usersedit'])->name('usersedit');
Route::put('/usersupdate/{id}', [AuthController::class, 'usersupdate'])->name('usersupdate');
Route::get('/usersactive/{id}', [AuthController::class, 'usersactive'])->name('usersactive');
Route::get('/usersfilter/{id}', [AuthController::class, 'usersfilter'])->name('usersfilter');
// FORNECEDORES
Route::get('/suppliersread', [SupplierController::class, 'suppliersread'])->name('suppliersread');
Route::post('/supplierscreate', [SupplierController::class, 'supplierscreate'])->name('supplierscreate');
Route::get('/suppliersedit/{id}', [SupplierController::class, 'suppliersedit'])->name('suppliersedit');
Route::put('/suppliersupdate/{id}', [SupplierController::class, 'suppliersupdate'])->name('suppliersupdate');
Route::get('/suppliersactive/{id}', [SupplierController::class, 'suppliersactive'])->name('suppliersactive');
Route::get('/suppliersfilter/{id}', [SupplierController::class, 'suppliersfilter'])->name('suppliersfilter');
// CATEGORIAS
Route::get('/categoriesread', [CategoryController::class, 'categoriesread'])->name('categoriesread');
Route::post('/categoriescreate', [CategoryController::class, 'categoriescreate'])->name('categoriescreate');
Route::get('/categoriesedit/{id}', [CategoryController::class, 'categoriesedit'])->name('categoriesedit');
Route::put('/categoriesupdate/{id}', [CategoryController::class, 'categoriesupdate'])->name('categoriesupdate');
Route::get('/categoriesactive/{id}', [CategoryController::class, 'categoriesactive'])->name('categoriesactive');
Route::get('/categoriesfilter/{id}', [CategoryController::class, 'categoriesfilter'])->name('categoriesfilter');
// MARCAS
Route::get('/brandsread', [BrandController::class, 'brandsread'])->name('brandsread');
Route::post('/brandscreate', [BrandController::class, 'brandscreate'])->name('brandscreate');
Route::get('/brandsedit/{id}', [BrandController::class, 'brandsedit'])->name('brandsedit');
Route::put('/brandsupdate/{id}', [BrandController::class, 'brandsupdate'])->name('brandsupdate');
Route::get('/brandsactive/{id}', [BrandController::class, 'brandsactive'])->name('brandsactive');
Route::get('/brandsfilter/{id}', [BrandController::class, 'brandsfilter'])->name('brandsfilter');
// PRODUTOS
Route::get('/productsread', [ProductController::class, 'productsread'])->name('productsread');
Route::post('/productscreate', [ProductController::class, 'productscreate'])->name('productscreate');
Route::get('/productsedit/{id}', [ProductController::class, 'productsedit'])->name('productsedit');
Route::put('/productsupdate/{id}', [ProductController::class, 'productsupdate'])->name('productsupdate');
Route::get('/productsactive/{id}', [ProductController::class, 'productsactive'])->name('productsactive');
Route::get('/productsdelete/{id}/{img}', [ProductController::class, 'productsdelete'])->name('productsdelete');
Route::get('/productsfilter/{id}', [ProductController::class, 'productsfilter'])->name('productsfilter');
Route::get('/productsfiltercategory/{filter}', [ProductController::class, 'productsfiltercategory'])->name('productsfiltercategory');
Route::get('/productsfilterbrand/{filter}', [ProductController::class, 'productsfilterbrand'])->name('productsfilterbrand');
