<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SupplierController extends Controller
{
    public function supplierscreate(Request $request){

        // dd($request->all());

        $request->validate([
            'supplier_name' => 'required',
            'contact' => 'required',
            'cpf_cnpj' => 'required',
            'phone' => 'required',
            'is_active' => 'required',
        ]);
        $suppliers = New Supplier();
        $suppliers->supplier_name = $request->supplier_name;
        $suppliers->contact = $request->contact;
        $suppliers->cpf_cnpj = $request->cpf_cnpj;
        $suppliers->phone = $request->phone;
        $suppliers->email = $request->email;
        $suppliers->street_address = $request->street_address;
        $suppliers->city = $request->city;
        $suppliers->state = $request->state;
        $suppliers->country = $request->country;
        $suppliers->zipcode = $request->zipcode;
        $suppliers->is_active = $request->is_active;

        $file_name = rand(0,999999) . '_' . $request->file('image_logo')->getClientOriginalName();
        $file_path = $request->file('image_logo')->storeAs('uploads', $file_name);
        $suppliers->image_logo = $file_path;
        
        if ($suppliers->save()) {
            return redirect()->intended(route('suppliersread'))->with('success', 'Fornecedor ['.$request->supplier_name.'] CADASTRADO com Sucesso!');
        }
        return redirect()->back()->with('error', 'Fornecedor ['.$request->supplier_name.'] NÃO CADASTRADO!');
    }
    public function suppliersread() {
        $suppliers = Supplier::orderBy('supplier_name', 'ASC')->where('is_active', 1)->get();

        return view('suppliersread', compact('suppliers'));
    }
    public function suppliersedit($id) {
        if (!$supplier = Supplier::find($id))
            return redirect()->route('usersread');

        return view('suppliersedit', compact('supplier'));
    }
    public function suppliersupdate(Request $request, $id){
        if (!$supplierupdate = Supplier::find($id))
            return redirect()->route('suppliersread');
        
        $image_old = $supplierupdate->image_logo;
        $data = $request->all();
        $supplierupdate->update($data);
        
        if ($request->image_logo == null) {
            if ($image_old != null) {
                $supplierupdate->update(['image_logo' => $image_old]);
            }
        }else{
            $file_name = rand(0,999999) . '_' . $request->file('image_logo')->getClientOriginalName();
            $file_path = $request->file('image_logo')->storeAs('uploads', $file_name);
            $supplierupdate->update(['image_logo' => $file_path]);
        }

        if(Storage::exists($image_old)){
            Storage::delete($image_old);
        }

        return redirect()->route('suppliersread')->with('success', 'Fornecedor ['.$request->supplier_name.'] ALTERADO com Sucesso!');
    }
    public function suppliersactive($id){
        if (!$supplieractive = Supplier::find($id))
            return redirect()->route('suppliersread');

        if ($supplieractive->is_active == 1) {
            $supplieractive->update(['is_active' => 0]);
            return redirect()->route('suppliersread')->with(['success' => 'Fornecedor ['.$supplieractive->supplier_name.'] DESATIVADO com Sucesso!']);
        } else {
            $supplieractive->update(['is_active' => 1]);
            return redirect()->route('suppliersread')->with(['success' => 'Fornecedor ['.$supplieractive->supplier_name.'] ATIVADO com Sucesso!']);
        }
    }
    public function suppliersfilter($id){
        if ($id == 2) {
            $suppliers = Supplier::orderBy('supplier_name', 'ASC')->get();
        } elseif ($id == 1) {
            $suppliers = Supplier::orderBy('supplier_name', 'ASC')->where('is_active', 1)->get();
        } else {
            $suppliers = Supplier::orderBy('supplier_name', 'ASC')->where('is_active', 0)->get();
        }
        return view('suppliersread', compact('suppliers'));
    }
}
