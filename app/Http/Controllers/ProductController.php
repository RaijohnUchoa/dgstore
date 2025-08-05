<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function productscreate(Request $request){

        $normal = str_replace(',', '.', str_replace('.', '', $request->price_normal));
        $sale = str_replace(',', '.', str_replace('.', '', $request->price_sale));
        
        $request->merge([
            'price_normal' => $normal,
            'price_sale' => $sale
        ]);

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

        $slug = $request->title;
        $slug = Str::slug($slug, '-');
        $products->slug = 'diecast-'.$slug;

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
        $products->is_preorder = $request->is_preorder == null ? "0" : "1";

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
            if ($request->price_sale == 0) {
                $products->update(['on_sale' => 0]);
            }
            if ($request->is_preorder == 1) {
                $products->update(['is_featured' => 0]);
                $products->update(['on_sale' => 0]);
            }
            return redirect()->intended(route('productsread'))->with('success', 'Produto ['.$request->title.'] CADASTRADO com Sucesso!');
        }

        return redirect()->back()->with('error', 'Produto ['.$request->title.'] NÃO CADASTRADO!');
    }
    public function productsread() {
        return view('productsread');
    }
    public function productsedit($id) {
        if (!$product = Product::find($id))
            return redirect()->route('productsread');

        $categorynow = Category::find($product->category_id);
        $brandnow = Brand::find($product->brand_id);
        return view('productsedit', compact('product', 'categorynow', 'brandnow'));
    }
    public function productsupdate(Request $request, $id){
        if (!$productsupdate = Product::find($id))
            return redirect()->route('productsread');
        
        $normal = str_replace(',', '.', str_replace('.', '', $request->price_normal));
        $sale = str_replace(',', '.', str_replace('.', '', $request->price_sale));
        
        $request->merge([
            'price_normal' => $normal,
            'price_sale' => $sale
        ]);
        
        $data = $request->all();
        $productsupdate->update($data);
        
        //AJUSTES
        if ($request->is_featured == null) {
            $productsupdate->update(['is_featured' => 0]);
        }
        if ($request->on_sale == null) {
            $productsupdate->update(['on_sale' => 0]);
        }
        if ($request->is_preorder == null) {
            $productsupdate->update(['is_preorder' => 0]);
        }
        if ($request->price_sale == 0) {
            $productsupdate->update(['on_sale' => 0]);
        }
        if ($request->price_sale != 0) {
            $productsupdate->update(['on_sale' => 1]);
        }
        if ($request->is_preorder == 1) {
            $productsupdate->update(['is_featured' => 0]);
            $productsupdate->update(['on_sale' => 0]);
            $productsupdate->update(['stock' => 0]);
        }
        
        if ($request->stock == 0) {
            $productsupdate->update(['is_featured' => 0]);
            $productsupdate->update(['on_sale' => 0]);
            $productsupdate->update(['price_sale' => 0]);
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
        if ($id == 2) { //Pre-Order
            $products = DB::table('products')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->join('brands', 'products.brand_id', '=', 'brands.id')
                ->select('products.*', 'categories.category_name', 'brands.brand_name')
                ->orderBy('id', 'DESC')
                ->where('products.is_active', 1)
                ->where('products.is_preorder', 1)
                ->get();
        } elseif ($id == 1) { //Ativos
            $products = DB::table('products')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->join('brands', 'products.brand_id', '=', 'brands.id')
                ->select('products.*', 'categories.category_name', 'brands.brand_name')
                ->orderBy('id', 'DESC')
                ->where('products.is_active', 1)
                ->get();
        } elseif ($id == 0) { //InAtivos
            $products = DB::table('products')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->join('brands', 'products.brand_id', '=', 'brands.id')
                ->select('products.*', 'categories.category_name', 'brands.brand_name')
                ->orderBy('id', 'DESC')
                ->where('products.is_active', 0)
                ->get();
        } else { //Geral
            $products = DB::table('products')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->join('brands', 'products.brand_id', '=', 'brands.id')
                ->select('products.*', 'categories.category_name', 'brands.brand_name')
                ->orderBy('id', 'DESC')
                ->get();
        }
        return view('productsread', compact('products'));
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

    //FILTROS MENU PRODUTOS
    public function productsfiltercategory($filter) {
        if (Auth::check()) {
            $user = Auth::user()->id;
        } else {
            $user = 1;
        }
        $carts = DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->select('carts.*', 'products.title', 'products.image1')
            ->where(['carts.user_id' => $user])
            ->orderBy('id', 'DESC')
            ->get();
        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select('products.*', 'categories.category_name', 'brands.brand_name')
            ->orderBy('id', 'DESC')
            ->where('products.is_active', 1)
            ->where('categories.category_name', '=', $filter)
            ->get();
        return view('layouts.app', compact('products', 'filter', 'carts'));
    }
    public function productsfilterbrand($filter) {
        if (Auth::check()) {
            $user = Auth::user()->id;
        } else {
            $user = 1;
        }
        $carts = DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->select('carts.*', 'products.title', 'products.image1')
            ->where(['carts.user_id' => $user])
            ->orderBy('id', 'DESC')
            ->get();
        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select('products.*', 'categories.category_name', 'brands.brand_name')
            ->orderBy('id', 'DESC')
            ->where('products.is_active', 1)
            ->where('brands.brand_name', '=', $filter)
            ->get();
        return view('layouts.app', compact('products', 'filter', 'carts'));
    }
    public function productsfilterscale($filter) {
        if (Auth::check()) {
            $user = Auth::user()->id;
        } else {
            $user = 1;
        }
        $carts = DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->select('carts.*', 'products.title', 'products.image1')
            ->where(['carts.user_id' => $user])
            ->orderBy('id', 'DESC')
            ->get();
        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select('products.*', 'categories.category_name', 'brands.brand_name')
            ->orderBy('id', 'DESC')
            ->where('products.is_active', 1)
            ->where('products.car_scale', '=', $filter)
            ->get();
        return view('layouts.app', compact('products', 'filter', 'carts'));
    }
    public function productsfiltersale() {
        if (Auth::check()) {
            $user = Auth::user()->id;
        } else {
            $user = 1;
        }
        $carts = DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->select('carts.*', 'products.title', 'products.image1')
            ->where(['carts.user_id' => $user])
            ->orderBy('id', 'DESC')
            ->get();
        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select('products.*', 'categories.category_name', 'brands.brand_name')
            ->orderBy('id', 'DESC')
            ->where('products.is_active', 1)
            ->where('products.on_sale', 1)
            ->get();
        return view('layouts.app', compact('products', 'carts'));
    }
    public function productsfilterpreorder() {
        if (Auth::check()) {
            $user = Auth::user()->id;
        } else {
            $user = 1;
        }
        $carts = DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->select('carts.*', 'products.title', 'products.image1')
            ->where(['carts.user_id' => $user])
            ->orderBy('id', 'DESC')
            ->get();
        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select('products.*', 'categories.category_name', 'brands.brand_name')
            ->orderBy('id', 'DESC')
            ->where('products.is_active', 1)
            ->where('products.is_preorder', 1)
            ->get();
        return view('layouts.app', compact('products', 'carts'));
    }
    public function productsfilterfeatured() {
        if (Auth::check()) {
            $user = Auth::user()->id;
        } else {
            $user = 1;
        }
        $carts = DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->select('carts.*', 'products.title', 'products.image1')
            ->where(['carts.user_id' => $user])
            ->orderBy('id', 'DESC')
            ->get();
        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select('products.*', 'categories.category_name', 'brands.brand_name')
            ->orderBy('id', 'DESC')
            ->where('products.is_active', 1)
            ->where('products.is_featured', 1)
            ->get();
        return view('layouts.app', compact('products', 'carts'));
    }

    //DETALHES PRODUTOS
    public function productsdetails($id) {
        if (Auth::check()) {
            $user = (Auth::user()->name);
        } else {
            $user = 'Visitante!';
        }
        if (!$product = Product::find($id))
            return redirect()->route('productsread');
    
        $categorynow = Category::find($product->category_id);
        $brandnow = Brand::find($product->brand_id);
        return view('productsdetails', compact('product', 'categorynow', 'brandnow', 'user'));
    }
    public function productsdetailsimage($id, $img) {
        if (!$producttoggleimage = Product::find($id))
            return redirect()->route('productsread');

        if ($img == 2) {
            $toggleimg = $producttoggleimage->image2;
            $producttoggleimage->update(['image2' => $producttoggleimage->image1]);
        }
        if ($img == 3) {
            $toggleimg = $producttoggleimage->image3;
            $producttoggleimage->update(['image3' => $producttoggleimage->image1]);
        }
        if ($img == 4) {
            $toggleimg = $producttoggleimage->image4;
            $producttoggleimage->update(['image4' => $producttoggleimage->image1]);
        }
        if ($img == 5) {
            $toggleimg = $producttoggleimage->image5;
            $producttoggleimage->update(['image5' => $producttoggleimage->image1]);
        }
        $producttoggleimage->update(['image1' => $toggleimg]);

        return redirect()->route('productsdetails', ['id' => $id]);
    }

    //CARRINHO DE COMPRAS
    public function productscartcreate(Request $request, $id) {        
        if (Auth::check()) {
            $userId = (Auth::user()->id);
        } else {
            return redirect()->route('login')->with('success', 'Faça LOGIN ou Registre-se!!');
        }
        $cart = Cart::where(['user_id' => $userId, 'product_id' => $id]);
        
        if (!$product = Product::find($id))
            return redirect()->route('productsdetails', ['id' => $id]);
        
        if ($cart->count() === 0) {
            $productcart = New Cart();
            $productcart->user_id = $userId;
            $productcart->product_id = $id;
            $productcart->quantity = ($request->quantity == null ? 1 : $request->quantity);
            $productcart->price_cart = $request->price_cart;
            $productcart->preorder = $request->preorder;

            if ($productcart->save()) {
                // $stock = $product->stock;
                // $product->update(['stock' => ($stock - $request->quantity)]); //ajuste estoque

                return redirect()->back()->with('success', 'Produto ['.$product->title.'] INCLUÍDO com Sucesso!');;
            }

        } else {
            $qty = ($request->quantity == null ? 1 : $request->quantity);
            $qt = $cart->pluck('quantity')->first() + (int)$qty;
            $cart->update(['quantity' => $qt]);
            return redirect()->route('productsdetails', ['id' => $id])->with('success', 'Produto ['.$product->title.'] ALTERADO Quantidade com Sucesso!');
        }
    }
    public function productscartdelete($id) {

        if (!$productcart = Cart::find($id))
            return redirect()->route('productsdetails', ['id' => $id]);
        
        $productcart->delete();
        $id = Cart::where(['user_id' => Auth::user()->id])->orderby('id', 'DESC')->first();
        $id = $id->product_id;

        return redirect()->route('productsdetails', ['id' => $id]);
    }

    //CHECKOUT
    public function productscheckout() {

        $carts = DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->select('carts.*', 'products.title', 'products.image1')
            ->where(['carts.user_id' => Auth::user()->id])
            ->orderBy('id', 'DESC')
            ->get();

        // $userId = (Auth::user()->id);
        // $carts = Cart::where(['user_id' => $userId])->get();
       
        // dd($userId, $carts);

        return view('productscheckout', compact('carts'));
    }
}
