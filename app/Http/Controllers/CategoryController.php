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
        return redirect()->back()->with('error', 'Categoria ['.$request->supplier_name.'] NÃO CADASTRADO!');
    }
    public function categoriesread() {
        $categories = Category::orderBy('category_name', 'ASC')->where('is_active', 1)->get();
        // dd($categories);

        return view('categoriesread', compact('categories'));
    }
    // public function suppliersedit($id) {
    //     if (!$supplier = Supplier::find($id))
    //         return redirect()->route('usersread');

    //     return view('suppliersedit', compact('supplier'));
    // }
    // public function suppliersupdate(Request $request, $id){
    //     if (!$userupdate = Supplier::find($id))
    //         return redirect()->route('suppliersread');
    //     $data = $request->all();
    //     $userupdate->update($data);
    //     return redirect()->route('suppliersread')->with('success', 'Fornecedor ['.$request->supplier_name.'] ALTERADO com Sucesso!');
    // }
    // public function suppliersactive($id){
    //     if (!$supplieractive = Supplier::find($id))
    //         return redirect()->route('suppliersread');

    //     if ($supplieractive->is_active == 1) {
    //         $supplieractive->update(['is_active' => 0]);
    //         return redirect()->route('suppliersread')->with(['success' => 'Fornecedor ['.$supplieractive->supplier_name.'] DESATIVADO com Sucesso!']);
    //     } else {
    //         $supplieractive->update(['is_active' => 1]);
    //         return redirect()->route('suppliersread')->with(['success' => 'Fornecedor ['.$supplieractive->supplier_name.'] ATIVADO com Sucesso!']);
    //     }
    // }
    // public function suppliersfilter($id){
    //     if ($id == 2) {
    //         $suppliers = Supplier::orderBy('supplier_name', 'ASC')->get();
    //     } elseif ($id == 1) {
    //         $suppliers = Supplier::orderBy('supplier_name', 'ASC')->where('is_active', 1)->get();
    //     } else {
    //         $suppliers = Supplier::orderBy('supplier_name', 'ASC')->where('is_active', 0)->get();
    //     }
    //     return view('suppliersread', compact('suppliers'));
    // }
}
