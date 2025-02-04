<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoriescreate(Request $request){

        // dd($request->all());

        $request->validate([
            'category_name' => 'required',
            'slug' => 'required',
            'image' => 'required',
            'is_active' => 'required',
        ]);
        $categories = New Category();
        $categories->category_name = $request->category_name;
        $categories->slug = $request->slug;
        $categories->image = $request->image;
        $categories->is_active = $request->is_active;
        
        if ($categories->save()) {
            return redirect()->intended(route('categoriesread'))->with('success', 'Categoria ['.$request->category_name.'] CADASTRADO com Sucesso!');
        }
        return redirect()->back()->with('error', 'Categoria ['.$request->category_name.'] NÃO CADASTRADO!');
    }
    public function categoriesread() {
        $categories = Category::orderBy('category_name', 'ASC')->where('is_active', 1)->get();
        return view('categoriesread', compact('categories'));
    }
    public function categoriesedit($id) {
        if (!$category = Category::find($id))
            return redirect()->route('categoriesread');

        return view('categoriesedit', compact('category'));
    }
    public function categoriesupdate(Request $request, $id){
        if (!$categoryupdate = Category::find($id))
            return redirect()->route('categoriesread');
        $data = $request->all();
        $categoryupdate->update($data);
        return redirect()->route('categoriesread')->with('success', 'Categoria ['.$request->category_name.'] ALTERADO com Sucesso!');
    }
    public function categoriesactive($id){
        if (!$categoryactive = Category::find($id))
            return redirect()->route('categoriesread');

        if ($categoryactive->is_active == 1) {
            $categoryactive->update(['is_active' => 0]);
            return redirect()->route('categoriesread')->with(['success' => 'Categoria ['.$categoryactive->category_name.'] DESATIVADO com Sucesso!']);
        } else {
            $categoryactive->update(['is_active' => 1]);
            return redirect()->route('categoriesread')->with(['success' => 'Categoria ['.$categoryactive->category_name.'] ATIVADO com Sucesso!']);
        }
    }
    public function categoriesfilter($id){
        if ($id == 2) {
            $categories = Category::orderBy('category_name', 'ASC')->get();
        } elseif ($id == 1) {
            $categories = Category::orderBy('category_name', 'ASC')->where('is_active', 1)->get();
        } else {
            $categories = Category::orderBy('category_name', 'ASC')->where('is_active', 0)->get();
        }
        return view('categoriesread', compact('categories'));
    }
}
