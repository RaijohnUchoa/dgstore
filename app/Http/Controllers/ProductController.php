<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productscreate(Request $request){

        // dd($request->all());

        $request->validate([
            'category_id' => 'required',
            'brand_id' => 'required',
            'title' => 'required',
            'price_normal' => 'required',
            'is_active' => 'required',
            'image1' => 'required|mimes:jpg,png,pdf|max:2048',
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
        $products->is_featured = $request->is_featured;
        $products->in_stock = $request->in_stock;
        $products->on_sale = $request->on_sale;
        
        $file_name = rand(0,999999) . '_' . $request->file('image1')->getClientOriginalName();
        $file_path = $request->file('image1')->storeAs('uploads', $file_name);
        $products->image1 = $file_path;

        if (!$request->image2 == null)
            $products->image2 = rand(0,999999) . '_' . $request->file('image2')->getClientOriginalName();
        if (!$request->image3 == null)
            $products->image3 = rand(0,999999) . '_' . $request->file('image3')->getClientOriginalName();
        if (!$request->image4 == null)
            $products->image4 = rand(0,999999) . '_' . $request->file('image4')->getClientOriginalName();
        if (!$request->image5 == null)
            $products->image5 = rand(0,999999) . '_' . $request->file('image5')->getClientOriginalName();

        // dd($products, $file_name, $file_path);

        if ($products->save()) {
            return redirect()->intended(route('productsread'))->with('success', 'Produto ['.$request->title.'] CADASTRADO com Sucesso!');
        }
        return redirect()->back()->with('error', 'Produto ['.$request->title.'] NÃO CADASTRADO!');
    }
    public function productsread() {
        $categories = Category::orderBy('category_name', 'ASC')->where('is_active', 1)->get();
        $brands = Brand::orderBy('brand_name', 'ASC')->where('is_active', 1)->get();
        $products = Product::orderBy('title', 'ASC')->where('is_active', 1)->get();
        return view('productsread', compact('products', 'categories', 'brands'));
    }

    // public function brandsedit($id) {
    //     if (!$brand = Brand::find($id))
    //         return redirect()->route('usersread');

    //     return view('brandsedit', compact('brand'));
    // }
    // public function brandsupdate(Request $request, $id){
    //     if (!$brandupdate = Brand::find($id))
    //         return redirect()->route('brandsread');
    //     $data = $request->all();
    //     $brandupdate->update($data);
    //     return redirect()->route('brandsread')->with('success', 'Marca ['.$request->brand_name.'] ALTERADO com Sucesso!');
    // }
    // public function brandsactive($id){
    //     if (!$brandactive = Brand::find($id))
    //         return redirect()->route('brandsread');

    //     if ($brandactive->is_active == 1) {
    //         $brandactive->update(['is_active' => 0]);
    //         return redirect()->route('brandsread')->with(['success' => 'Marca ['.$brandactive->brand_name.'] DESATIVADO com Sucesso!']);
    //     } else {
    //         $brandactive->update(['is_active' => 1]);
    //         return redirect()->route('brandsread')->with(['success' => 'Marca ['.$brandactive->brand_name.'] ATIVADO com Sucesso!']);
    //     }
    // }
    // public function brandsfilter($id){
    //     if ($id == 2) {
    //         $brands = Brand::orderBy('brand_name', 'ASC')->get();
    //     } elseif ($id == 1) {
    //         $brands = Brand::orderBy('brand_name', 'ASC')->where('is_active', 1)->get();
    //     } else {
    //         $brands = Brand::orderBy('brand_name', 'ASC')->where('is_active', 0)->get();
    //     }
    //     return view('brandsread', compact('brands'));
    // }
}
