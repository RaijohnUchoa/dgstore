<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Scale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function information() {
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
        return view('information', compact('carts'));
    }
    //SCALES
    public function scalescreate(Request $request){
        $request->validate([
            'scale_name' => 'required',
            'is_active' => 'required',
        ]);
        $scales = New Scale();
        $scales->scale_name = $request->scale_name;

        $slug = $request->scale_name;
        $slug = Str::remove([':', ' '], $slug);
        $scales->slug = 'diecast-scale-'.$slug;
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
    //COLORS
    public function colorscreate(Request $request){
        $request->validate([
            'color_name' => 'required',
            'is_active' => 'required',
        ]);
        $colors = New Color();
        $colors->color_name = $request->color_name;

        $slug = $request->color_name;
        $slug = Str::remove(['(', ')', ' '], $slug);
        $slug = Str::snake($slug, '-');

        $colors->slug = 'diecast-color-'.$slug;
        $colors->is_active = $request->is_active;

        if ($colors->save()) {
            return redirect()->intended(route('colorsread'))->with('success', 'Cor ['.$request->color_name.'] CADASTRADO com Sucesso!');
        }
        return redirect()->back()->with('error', 'Cor ['.$request->color_name.'] NÃO CADASTRADO!');
    }
    public function colorsread() {
        $brands = Brand::orderBy('brand_name', 'ASC')->where('is_active', 1)->get();
        $colors = Color::orderBy('color_name', 'ASC')->get();
        return view('colorsread', compact('brands', 'colors'));
    }
    public function colorsupdate(Request $request, $id){
        if (!$colorsupdate = Color::find($id))
            return redirect()->route('colorsread');

        $data = $request->all();
        $colorsupdate->update($data);

        $slug = $request->color_name;
        $slug = Str::remove(['(', ')', ' '], $slug);
        $slug = Str::snake($slug, '-');
        $colorsupdate->update(['slug' => 'diecast-color-'.$slug]);

        return redirect()->route('colorsread')->with('success', 'Cor ['.$colorsupdate->color_name.'] ALTERADO com Sucesso!');
    }
    public function colorsactive($id, $del){
        if (!$coloractive = Color::find($id))
            return redirect()->route('colorsread');

        if ($del == 'delete') {
            $coloractive->delete();
            return redirect()->route('colorsread')->with(['success' => 'Cor ['.$coloractive->color_name.'] DELETADO com Sucesso!']);
        }

        if ($coloractive->is_active == 1) {
            $coloractive->update(['is_active' => 0]);
            return redirect()->route('colorsread')->with(['success' => 'Cor ['.$coloractive->color_name.'] DESATIVADO com Sucesso!']);
        } else {
            $coloractive->update(['is_active' => 1]);
            return redirect()->route('colorsread')->with(['success' => 'Cor ['.$coloractive->color_name.'] ATIVADO com Sucesso!']);
        }
    }
    //ATRIBUTOS
    public function attributescreate(Request $request){
        $request->validate([
            'attribute_name' => 'required',
            'is_active' => 'required',
        ]);
        $attributes = New Attribute();
        $attributes->attribute_name = $request->attribute_name;

        $slug = $request->attribute_name;
        $slug = Str::remove(['(', ')', ' '], $slug);
        $slug = Str::snake($slug, '-');

        $attributes->slug = 'diecast-atributo-'.$slug;
        $attributes->is_active = $request->is_active;

        if ($attributes->save()) {
            return redirect()->intended(route('attributesread'))->with('success', 'Atributo ['.$request->attribute_name.'] CADASTRADO com Sucesso!');
        }
        return redirect()->back()->with('error', 'Cor ['.$request->attribute_name.'] NÃO CADASTRADO!');
    }
    public function attributesread() {
        $brands = Brand::orderBy('brand_name', 'ASC')->where('is_active', 1)->get();
        $attributes = Attribute::orderBy('attribute_name', 'ASC')->get();
        return view('attributesread', compact('brands', 'attributes'));
    }
    public function attributesupdate(Request $request, $id){
        if (!$attributeupdate = Attribute::find($id))
            return redirect()->route('attributesread');

        $data = $request->all();
        $attributeupdate->update($data);

        $slug = $request->attribute_name;
        $slug = Str::remove(['(', ')', ' '], $slug);
        $slug = Str::snake($slug, '-');
        $attributeupdate->update(['slug' => 'diecast-atributo-'.$slug]);

        return redirect()->route('attributesread')->with('success', 'Atributo ['.$attributeupdate->attribute_name.'] ALTERADO com Sucesso!');
    }
    public function attributesactive($id, $del){
        if (!$attributeactive = Attribute::find($id))
            return redirect()->route('attributesread');

        if ($del == 'delete') {
            $attributeactive->delete();
            return redirect()->route('attributesread')->with(['success' => 'Atributo ['.$attributeactive->attribute_name.'] DELETADO com Sucesso!']);
        }

        if ($attributeactive->is_active == 1) {
            $attributeactive->update(['is_active' => 0]);
            return redirect()->route('attributesread')->with(['success' => 'Atributo ['.$attributeactive->attribute_name.'] DESATIVADO com Sucesso!']);
        } else {
            $attributeactive->update(['is_active' => 1]);
            return redirect()->route('attributesread')->with(['success' => 'Atributo ['.$attributeactive->attribute_name.'] ATIVADO com Sucesso!']);
        }
    }
}
