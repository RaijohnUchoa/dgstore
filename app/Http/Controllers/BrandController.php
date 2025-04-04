<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function brandscreate(Request $request){

        $request->validate([
            'brand_name' => 'required',
            'image' => 'required',
            'is_active' => 'required',
        ]);
        $brands = New Brand();
        $brands->brand_name = $request->brand_name;

        $slug = $request->brand_name;
        $slug = Str::remove(['-', ' '], $slug);
        $slug = Str::snake($slug, '-');
        $brands->slug = 'diecast-'.$slug;

        $brands->is_active = $request->is_active;

        $file_name = rand(0,999999) . '_' . $request->file('image')->getClientOriginalName();
        $file_path = $request->file('image')->storeAs('uploads', $file_name);
        $brands->image = $file_path;

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
        $brands = Brand::orderBy('brand_name', 'ASC')->where('is_active', 1)->get();
        if (!$brand = Brand::find($id))
            return redirect()->route('brandsread');

        return view('brandsedit', compact('brands', 'brand'));
    }
    public function brandsupdate(Request $request, $id){
        if (!$brandupdate = Brand::find($id))
            return redirect()->route('brandsread');
        
        $image_old = $brandupdate->image;
        
        if ($request->image == null) {
            if ($image_old != null) {
                $request->merge([
                    'image' => $image_old,
                ]);
                $data = $request->all();
                $brandupdate->update($data);
            }
        }else{
            $data = $request->all();
            $brandupdate->update($data);
            $file_name = rand(0,999999) . '_' . $request->file('image')->getClientOriginalName();
            $file_path = $request->file('image')->storeAs('uploads', $file_name);
            $brandupdate->update(['image' => $file_path]);
            if(Storage::exists($image_old)){
                Storage::delete($image_old);
            }
        }
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
