<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function categoriescreate(Request $request){

        $request->validate([
            'category_name' => 'required',
            'image' => 'required',
            'is_active' => 'required',
        ]);
        
        $categories = New Category();
        $categories->category_name = $request->category_name;
        
        $slug = $request->category_name;
        $slug = Str::remove(['-', ' '], $slug);
        $slug = Str::snake($slug, '-');
        $categories->slug = 'diecast-'.$slug;

        $categories->is_active = $request->is_active;

        $file_name = rand(0,999999) . '_' . $request->file('image')->getClientOriginalName();
        $file_path = $request->file('image')->storeAs('uploads', $file_name);
        $categories->image = $file_path;

        if ($categories->save()) {
            return redirect()->intended(route('categoriesread'))->with('success', 'Categoria ['.$request->category_name.'] CADASTRADO com Sucesso!');
        }
        return redirect()->back()->with('error', 'Categoria ['.$request->category_name.'] NÃO CADASTRADO!');
    }
    public function categoriesread() {
        $brands = Brand::orderBy('brand_name', 'ASC')->where('is_active', 1)->get();
        $categories = Category::orderBy('category_name', 'ASC')->where('is_active', 1)->get();
        return view('categoriesread', compact('brands', 'categories'));
    }
    public function categoriesedit($id) {
        $brands = Brand::orderBy('brand_name', 'ASC')->where('is_active', 1)->get();
        if (!$category = Category::find($id))
            return redirect()->route('categoriesread');

        return view('categoriesedit', compact('brands', 'category'));
    }
    public function categoriesupdate(Request $request, $id){
        if (!$categoryupdate = Category::find($id))
            return redirect()->route('categoriesread');
        
        $image_old = $categoryupdate->image;

        if ($request->image == null) {
            if ($image_old != null) {
                $request->merge([
                    'image' => $image_old,
                ]);
                $data = $request->all();
                $categoryupdate->update($data);
            }
        }else{
            $data = $request->all();
            $categoryupdate->update($data);
            $file_name = rand(0,999999) . '_' . $request->file('image')->getClientOriginalName();
            $file_path = $request->file('image')->storeAs('uploads', $file_name);
            $categoryupdate->update(['image' => $file_path]);
            if(Storage::exists($image_old)){
                Storage::delete($image_old);
            }
        }
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
        $brands = Brand::orderBy('brand_name', 'ASC')->where('is_active', 1)->get();
        if ($id == 2) {
            $categories = Category::orderBy('category_name', 'ASC')->get();
        } elseif ($id == 1) {
            $categories = Category::orderBy('category_name', 'ASC')->where('is_active', 1)->get();
        } else {
            $categories = Category::orderBy('category_name', 'ASC')->where('is_active', 0)->get();
        }
        return view('categoriesread', compact('brands', 'categories'));
    }
}
