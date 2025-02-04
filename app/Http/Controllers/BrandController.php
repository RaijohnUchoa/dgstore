<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function brandscreate(Request $request){

        // dd($request->all());

        $request->validate([
            'brand_name' => 'required',
            'slug' => 'required',
            'image' => 'required',
            'is_active' => 'required',
        ]);
        $brands = New Brand();
        $brands->brand_name = $request->brand_name;
        $brands->slug = $request->slug;
        $brands->image = $request->image;
        $brands->is_active = $request->is_active;
        
        if ($brands->save()) {
            return redirect()->intended(route('brandsread'))->with('success', 'Marca ['.$request->brand_name.'] CADASTRADO com Sucesso!');
        }
        return redirect()->back()->with('error', 'Marca ['.$request->brand_name.'] NÃO CADASTRADO!');
    }
    public function brandsread() {
        $brands = Brand::orderBy('brand_name', 'ASC')->where('is_active', 1)->get();
        return view('brandsread', compact('brands'));
    }
    public function brandsedit($id) {
        if (!$brand = Brand::find($id))
            return redirect()->route('brandsread');

        return view('brandsedit', compact('brand'));
    }
    public function brandsupdate(Request $request, $id){
        if (!$brandupdate = Brand::find($id))
            return redirect()->route('brandsread');
        $data = $request->all();
        $brandupdate->update($data);
        return redirect()->route('brandsread')->with('success', 'Marca ['.$request->brand_name.'] ALTERADO com Sucesso!');
    }
    public function brandsactive($id){
        if (!$brandactive = Brand::find($id))
            return redirect()->route('brandsread');

        if ($brandactive->is_active == 1) {
            $brandactive->update(['is_active' => 0]);
            return redirect()->route('brandsread')->with(['success' => 'Marca ['.$brandactive->brand_name.'] DESATIVADO com Sucesso!']);
        } else {
            $brandactive->update(['is_active' => 1]);
            return redirect()->route('brandsread')->with(['success' => 'Marca ['.$brandactive->brand_name.'] ATIVADO com Sucesso!']);
        }
    }
    public function brandsfilter($id){
        if ($id == 2) {
            $brands = Brand::orderBy('brand_name', 'ASC')->get();
        } elseif ($id == 1) {
            $brands = Brand::orderBy('brand_name', 'ASC')->where('is_active', 1)->get();
        } else {
            $brands = Brand::orderBy('brand_name', 'ASC')->where('is_active', 0)->get();
        }
        return view('brandsread', compact('brands'));
    }
}
