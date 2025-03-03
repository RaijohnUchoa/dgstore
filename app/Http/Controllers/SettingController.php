<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Scale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function scalescreate(Request $request){
        $request->validate([
            'scale_name' => 'required',
            'slug' => 'required',
            'is_active' => 'required',
        ]);
        $scales = New Scale();
        $scales->scale_name = $request->scale_name;
        $scales->slug = $request->slug;
        $scales->is_active = $request->is_active;

        if ($scales->save()) {
            return redirect()->intended(route('scalesread'))->with('success', 'Escala ['.$request->scale_name.'] CADASTRADO com Sucesso!');
        }
        return redirect()->back()->with('error', 'Escala ['.$request->scale_name.'] NÃO CADASTRADO!');
    }
    public function scalesread() {
        $brands = Brand::orderBy('brand_name', 'ASC')->where('is_active', 1)->get();
        $scales = Scale::orderBy('scale_name', 'ASC')->get();
        return view('scalesread', compact('brands', 'scales'));
    }
    public function scalesupdate(Request $request, $id){
        if (!$scalesupdate = Scale::find($id))
            return redirect()->route('scalesread');
        
        $data = $request->all();
        $scalesupdate->update($data);
        return redirect()->route('scalesread')->with('success', 'Escala ['.$scalesupdate->scale_name.'] ALTERADO com Sucesso!');
    }
    public function scalesactive($id, $del){
        if (!$scalesactive = Scale::find($id))
            return redirect()->route('scalesread');

        if ($del == 'delete') {
            $scalesactive->delete();
            return redirect()->route('scalesread')->with(['success' => 'Escala ['.$scalesactive->scale_name.'] DELETADO com Sucesso!']);
        }

        if ($scalesactive->is_active == 1) {
            $scalesactive->update(['is_active' => 0]);
            return redirect()->route('scalesread')->with(['success' => 'Escala ['.$scalesactive->scale_name.'] DESATIVADO com Sucesso!']);
        } else {
            $scalesactive->update(['is_active' => 1]);
            return redirect()->route('scalesread')->with(['success' => 'Escala ['.$scalesactive->scale_name.'] ATIVADO com Sucesso!']);
        }
    }

    public function information() {
        $categories = Category::orderBy('category_name', 'ASC')->where('is_active', 1)->get();
        $brands = Brand::orderBy('brand_name', 'ASC')->where('is_active', 1)->get();
        $scales = Scale::orderBy('scale_name', 'ASC')->get();
        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select('products.*', 'categories.category_name', 'brands.brand_name')
            ->orderBy('id', 'DESC')
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
        return view('information', compact('categories', 'brands', 'scales', 'products', 'productsonsale', 'filter'));
    }
}
