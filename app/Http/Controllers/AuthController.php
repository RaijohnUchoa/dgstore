<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
            return redirect()->intended(route('app'));
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
                return redirect()->intended(route('app'))->with('success', 'Seja Bem Vindo(a) ');
            }
        }
        return redirect(route('register'))->with('error', 'Falha ao Criar Usuário!');
    }

    public function logout() {
        Auth::logout();
        return view('layouts.app');
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
        $users = User::orderBy('name', 'ASC')->where('is_active', 1)->where('type', 1)->get();
        return view('usersread', compact('users'));
    }
    public function usersedit($id) {
        if (!$user = User::find($id))
            return redirect()->route('usersread');

        return view('usersedit', compact('user'));
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
        if ($id == 3) {
            $users = User::orderBy('name', 'ASC')->get();
        } elseif ($id == 2) {
            $users = User::orderBy('name', 'ASC')->where('is_active', 1)->where('type', 1)->get();
        } elseif ($id == 1) {
            $users = User::orderBy('name', 'ASC')->where('is_active', 1)->where('type', 0)->get();
        } else {
            $users = User::orderBy('name', 'ASC')->where('is_active', 0)->get();
        }
        return view('usersread', compact('users'));
    }

}
