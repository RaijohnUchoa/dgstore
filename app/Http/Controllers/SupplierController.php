<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function supplierscreate(Request $request){

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
        $suppliers->image_logo = $request->image_logo;
        $suppliers->cpf_cnpj = $request->cpf_cnpj;
        $suppliers->phone = $request->phone;
        $suppliers->street_address = $request->street_address;
        $suppliers->city = $request->city;
        $suppliers->state = $request->state;
        $suppliers->country = $request->country;
        $suppliers->zipcode = $request->zipcode;
        $suppliers->is_active = $request->is_active;
        
        if ($suppliers->save()) {
            return redirect()->intended(route('suppliersread'))->with('success', 'Fornecedor ['.$request->supplier_name.'] CADASTRADO com Sucesso!');
        }
        return redirect()->back()->with('error', 'Fornecedor ['.$request->supplier_name.'] NÃO CADASTRADO!');
    }
    public function suppliersread() {
        $suppliers = Supplier::orderBy('supplier_name', 'ASC')->where('is_active', 1)->get();
        // dd($suppliers);

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
        $data = $request->all();
        $supplierupdate->update($data);
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
