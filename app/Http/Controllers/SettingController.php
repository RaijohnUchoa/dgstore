<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Scale;
use Illuminate\Http\Request;

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
}
