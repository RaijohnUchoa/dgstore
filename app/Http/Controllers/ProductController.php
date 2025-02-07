<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function productscreate(Request $request){
        $request->validate([
            'category_id' => 'required',
            'brand_id' => 'required',
            'title' => 'required',
            'price_normal' => 'required',
            'is_active' => 'required',
            'image1' => 'required|mimes:jpeg,png,jpg,gif,pdf|max:2048',
        ]);
        $products = New Product();
        $products->category_id = $request->category_id;
        $products->brand_id = $request->brand_id;
        $products->title = $request->title;
        $products->slug = $request->slug;
        $products->barcode = $request->barcode;
        $products->sku = $request->sku;
        $products->car_model = $request->car_model;
        $products->car_year = $request->car_year;
        $products->car_color = $request->car_color;
        $products->car_scale = $request->car_scale;
        $products->car_attribute = $request->car_attribute;
        $products->stock = $request->stock;
        $products->price_normal = $request->price_normal;
        $products->price_sale = $request->price_sale;
        $products->description = $request->description;
        $products->is_active = $request->is_active;
        $products->is_featured = $request->is_featured == null ? "0" : "1";
        $products->on_sale = $request->on_sale == null ? "0" : "1";
        $products->in_stock = $request->in_stock == null ? "0" : "1";
        
        $file_name = rand(0,999999) . '_' . $request->file('image1')->getClientOriginalName();
        $file_path = $request->file('image1')->storeAs('uploads', $file_name);
        $products->image1 = $file_path;

        if (!$request->image2 == null) {
            $file_name = rand(0,999999) . '_' . $request->file('image2')->getClientOriginalName();
            $file_path = $request->file('image2')->storeAs('uploads', $file_name);
            $products->image2 = $file_path;
        }
        if (!$request->image3 == null) {
            $file_name = rand(0,999999) . '_' . $request->file('image3')->getClientOriginalName();
            $file_path = $request->file('image3')->storeAs('uploads', $file_name);
            $products->image3 = $file_path;
        }
        if (!$request->image4 == null) {
            $file_name = rand(0,999999) . '_' . $request->file('image4')->getClientOriginalName();
            $file_path = $request->file('image4')->storeAs('uploads', $file_name);
            $products->image4 = $file_path;
        }
        if (!$request->image5 == null) {
            $file_name = rand(0,999999) . '_' . $request->file('image5')->getClientOriginalName();
            $file_path = $request->file('image5')->storeAs('uploads', $file_name);
            $products->image5 = $file_path;
        }
        if ($products->save()) {
            return redirect()->intended(route('productsread'))->with('success', 'Produto ['.$request->title.'] CADASTRADO com Sucesso!');
        }
        return redirect()->back()->with('error', 'Produto ['.$request->title.'] NÃO CADASTRADO!');
    }
    public function productsread() {
        $categories = Category::orderBy('category_name', 'ASC')->where('is_active', 1)->get();
        $brands = Brand::orderBy('brand_name', 'ASC')->where('is_active', 1)->get();

        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select('products.*', 'categories.category_name', 'brands.brand_name')
            ->orderBy('brand_id', 'ASC')
            ->get();

        return view('productsread', compact('products', 'categories', 'brands'));
    }
    public function productsedit($id) {
        $categories = Category::orderBy('category_name', 'ASC')->where('is_active', 1)->get();
        $brands = Brand::orderBy('brand_name', 'ASC')->where('is_active', 1)->get();
        if (!$product = Product::find($id))
            return redirect()->route('productsread');

        $categorynow = Category::find($product->category_id);
        // $categorynow = $categorynow->category_name;
        $brandnow = Brand::find($product->brand_id);
        // $brandnow = $brandnow->brand_name;
        return view('productsedit', compact('product', 'categories', 'brands', 'categorynow', 'brandnow'));
    }
    public function productsupdate(Request $request, $id){
        
        if (!$productsupdate = Product::find($id))
            return redirect()->route('productsread');

        $data = $request->all();
        $productsupdate->update($data);

        if ($request->is_featured == null) {
            $productsupdate->update(['is_featured' => 0]);
        }
        if ($request->on_sale == null) {
            $productsupdate->update(['on_sale' => 0]);
        }
        if ($request->in_stock == null) {
            $productsupdate->update(['in_stock' => 0]);
        }

        if (!$request->image1 == null) {
            $file_name = rand(0,999999) . '_' . $request->file('image1')->getClientOriginalName();
            $file_path = $request->file('image1')->storeAs('uploads', $file_name);
            $productsupdate->update(['image1' => $file_path]);
        }
        if (!$request->image2 == null) {
            $file_name = rand(0,999999) . '_' . $request->file('image2')->getClientOriginalName();
            $file_path = $request->file('image2')->storeAs('uploads', $file_name);
            $productsupdate->update(['image2' => $file_path]);
        }
        if (!$request->image3 == null) {
            $file_name = rand(0,999999) . '_' . $request->file('image3')->getClientOriginalName();
            $file_path = $request->file('image3')->storeAs('uploads', $file_name);
            $productsupdate->update(['image3' => $file_path]);
        }
        if (!$request->image4 == null) {
            $file_name = rand(0,999999) . '_' . $request->file('image4')->getClientOriginalName();
            $file_path = $request->file('image4')->storeAs('uploads', $file_name);
            $productsupdate->update(['image4' => $file_path]);
        }
        if (!$request->image5 == null) {
            $file_name = rand(0,999999) . '_' . $request->file('image5')->getClientOriginalName();
            $file_path = $request->file('image5')->storeAs('uploads', $file_name);
            $productsupdate->update(['image5' => $file_path]);
        }
        return redirect()->route('productsread')->with('success', 'Produto ['.$productsupdate->title.'] ALTERADO com Sucesso!');
    }
    public function productsactive($id){
        if (!$productactive = Product::find($id))
            return redirect()->route('productsread');

        if ($productactive->is_active == 1) {
            $productactive->update(['is_active' => 0]);
            return redirect()->route('productsread')->with(['success' => 'Produto ['.$productactive->title.'] DESATIVADO com Sucesso!']);
        } else {
            $productactive->update(['is_active' => 1]);
            return redirect()->route('productsread')->with(['success' => 'Produto ['.$productactive->title.'] ATIVADO com Sucesso!']);
        }
    }
    public function productsfilter($id){

        $categories = Category::orderBy('category_name', 'ASC')->where('is_active', 1)->get();
        $brands = Brand::orderBy('brand_name', 'ASC')->where('is_active', 1)->get();

        if ($id == 2) {
            $products = DB::table('products')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->join('brands', 'products.brand_id', '=', 'brands.id')
                ->select('products.*', 'categories.category_name', 'brands.brand_name')
                ->orderBy('brand_id', 'ASC')
                ->get();
        } elseif ($id == 1) {
            $products = DB::table('products')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->join('brands', 'products.brand_id', '=', 'brands.id')
                ->select('products.*', 'categories.category_name', 'brands.brand_name')
                ->orderBy('brand_id', 'ASC')
                ->where('products.is_active', 1)
                ->get();
        } else {
            $products = DB::table('products')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->join('brands', 'products.brand_id', '=', 'brands.id')
                ->select('products.*', 'categories.category_name', 'brands.brand_name')
                ->orderBy('brand_id', 'ASC')
                ->where('products.is_active', 0)
                ->get();
        }
        return view('productsread', compact('categories', 'brands', 'products'));
    }
    public function productsdelete($id, $img){

        if (!$productdel = Product::find($id))
            return redirect()->route('productsread');

        if ($img == 1) {
            $imgdel = $productdel->image1;
            $productdel->update(['image1' => null]);
        }
        if ($img == 2) {
            $imgdel = $productdel->image2;
            $productdel->update(['image2' => null]);
        }
        if ($img == 3) {
            $imgdel = $productdel->image3;
            $productdel->update(['image3' => null]);
        }
        if ($img == 4) {
            $imgdel = $productdel->image4;
            $productdel->update(['image4' => null]);
        }
        if ($img == 5) {
            $imgdel = $productdel->image5;
            $productdel->update(['image5' => null]);
        }

        if(Storage::exists($imgdel)){
            Storage::delete($imgdel);
        }
        return redirect()->route('productsread')->with('success', 'Imagem DELETADA com Sucesso!');
    }
}
