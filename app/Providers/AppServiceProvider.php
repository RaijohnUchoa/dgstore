<?php

namespace App\Providers;

use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Color;
use App\Models\Scale;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $categories = Category::orderBy('category_name', 'ASC')->where('is_active', 1)->get();
        $brands = Brand::orderBy('brand_name', 'ASC')->where('is_active', 1)->get();
        $scales = Scale::orderBy('scale_name', 'ASC')->where('is_active', 1)->get();
        $colors = Color::orderBy('color_name', 'ASC')->where('is_active', 1)->get();
        $attributes = Attribute::orderBy('attribute_name', 'ASC')->where('is_active', 1)->get();
        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select('products.*', 'categories.category_name', 'brands.brand_name')
            ->orderBy('id', 'DESC')
            ->where('products.is_active', 1)
            ->get();
        $productsonsale = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select('products.*', 'categories.category_name', 'brands.brand_name')
            ->orderBy('id', 'DESC')
            ->where('products.is_active', 1)
            ->where('products.on_sale', 1)
            ->get();
        $filter = '';
        
        // $carts = Cart::orderBy('user_id', 'ASC')->get();

        view()->share('brands', $brands);
        view()->share('categories', $categories);
        view()->share('scales', $scales);
        view()->share('colors', $colors);
        view()->share('attributes', $attributes);
        view()->share('products', $products);
        view()->share('productsonsale', $productsonsale);
        view()->share('filter', $filter);

        // view()->share('carts', $carts);
    }
}
