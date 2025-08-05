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

            $carts = DB::table('carts')
                ->join('products', 'carts.product_id', '=', 'products.id')
                ->select('carts.*', 'products.title', 'products.image1')
                ->where(['carts.user_id' => Auth::user()->id])
                ->orderBy('id', 'DESC')
                ->get();
                
            if (count($carts) > 0) {
                $last_id = $carts[0]->product_id;
                return redirect()->route('productsdetails', $last_id);
            }

            return view('layouts.app', compact('carts'));
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

                $carts = DB::table('carts')
                ->join('products', 'carts.product_id', '=', 'products.id')
                ->select('carts.*', 'products.title', 'products.image1')
                ->where(['carts.user_id' => Auth::user()->id])
                ->orderBy('id', 'DESC')
                ->get();
                
            if (count($carts) > 0) {
                $last_id = $carts[0]->product_id;
                return redirect()->route('productsdetails', $last_id);
            }

            return view('layouts.app', compact('carts'));
            }
        }
        return redirect(route('register'))->with('error', 'Falha ao Criar Usuário!');
    }

    public function logout() {
        Auth::logout();
        // if (Auth::check()) {
        //     $user = Auth::user()->id;
        // } else {
            $user = 1;
        // }
        $carts = DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->select('carts.*', 'products.title', 'products.image1')
            ->where(['carts.user_id' => $user])
            ->orderBy('id', 'DESC')
            ->get();
        return view('layouts.app', compact('carts'));
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
