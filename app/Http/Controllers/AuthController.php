<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Scale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login() {
        return view('auth.login');
    }

    public function loginPost(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)) {
            $categories = Category::orderBy('category_name', 'ASC')->where('is_active', 1)->get();
            $brands = Brand::orderBy('brand_name', 'ASC')->where('is_active', 1)->get();
            $scales = Scale::orderBy('scale_name', 'ASC')->where('is_active', 1)->get();
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
            return view('layouts.app', compact('products', 'categories', 'brands', 'scales', 'productsonsale'));
        }
        return redirect(route('login'))->with('error', 'Falhar ao logar usuário!');
    }

    public function register() {
        return view('auth.register');
    }

    public function registerPost(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = New User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if ($user->save()) {
            $credentials = $request->only('email', 'password');
            if(Auth::attempt($credentials)) {
                $categories = Category::orderBy('category_name', 'ASC')->where('is_active', 1)->get();
                $brands = Brand::orderBy('brand_name', 'ASC')->where('is_active', 1)->get();
                $scales = Scale::orderBy('scale_name', 'ASC')->where('is_active', 1)->get();
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
                return view('layouts.app', compact('products', 'categories', 'brands', 'scales', 'productsonsale'));
            }
        }
        return redirect(route('register'))->with('error', 'Falha ao Criar Usuário!');
    }

    public function logout() {
        Auth::logout();
        $categories = Category::orderBy('category_name', 'ASC')->where('is_active', 1)->get();
        $brands = Brand::orderBy('brand_name', 'ASC')->where('is_active', 1)->get();
        $scales = Scale::orderBy('scale_name', 'ASC')->where('is_active', 1)->get();
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
        return view('layouts.app', compact('products', 'categories', 'brands', 'scales', 'productsonsale'));
    }

    //CRUD USUÁRIOS ADMINISTRATIVO
    public function userscreate(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'type' => 'required',
        ]);
        $user = New User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->type = $request->type;
        if ($request->type == 0) {
            $user->password = Hash::make($request->password.'@admin');
        } else {
            $user->password = Hash::make($request->password);
        }
        if ($user->save()) {
            $credentials = $request->only('email', 'password');
            if(Auth::attempt($credentials)) {
                return redirect()->intended(route('usersread'))->with('success', 'Usuário ['.$request->name.'] CADASTRADO com Sucesso!');
            }
        }
        return redirect()->back()->with('error', 'Usuário ['.$request->name.'] NÃO CADASTRADO!');
    }
    public function usersread() {
        $brands = Brand::orderBy('brand_name', 'ASC')->where('is_active', 1)->get();
        $users = User::orderBy('name', 'ASC')->where('is_active', 1)->get();

        return view('usersread', compact('brands', 'users'));
    }
    public function usersedit($id) {
        $brands = Brand::orderBy('brand_name', 'ASC')->where('is_active', 1)->get();
        if (!$user = User::find($id))
            return redirect()->route('usersread');

        return view('usersedit', compact('brands', 'user'));
    }
    public function usersupdate(Request $request, $id){
        if (!$userupdate = User::find($id))
            return redirect()->route('usersread');
        $data = $request->all();
        $userupdate->update($data);
        return redirect()->route('usersread')->with('success', 'Usuário ['.$request->name.'] ALTERADO com Sucesso!');
    }
    public function usersactive($id){
        if (!$useractive = User::find($id))
            return redirect()->route('usersread');

        if ($useractive->is_active == 1) {
            $useractive->update(['is_active' => 0]);
            return redirect()->route('usersread')->with(['success' => 'Usuário ['.$useractive->name.'] DESATIVADO com Sucesso!']);
        } else {
            $useractive->update(['is_active' => 1]);
            return redirect()->route('usersread')->with(['success' => 'Usuário ['.$useractive->name.'] ATIVADO com Sucesso!']);
        }
    }
    public function usersfilter($id){
        $brands = Brand::orderBy('brand_name', 'ASC')->where('is_active', 1)->get();
        if ($id == 3) {
            $users = User::orderBy('name', 'ASC')->get();
        } elseif ($id == 2) {
            $users = User::orderBy('name', 'ASC')->where('is_active', 1)->where('type', 1)->get();
        } elseif ($id == 1) {
            $users = User::orderBy('name', 'ASC')->where('is_active', 1)->where('type', 0)->get();
        } else {
            $users = User::orderBy('name', 'ASC')->where('is_active', 0)->get();
        }
        return view('usersread', compact('brands', 'users'));
    }

}
