@extends("layouts.app")
@section("title", "Usuários")
@section("content")

<div class="">

    <div class="flex justify-between items-center border py-1 px-2">
        <span class="font-bold">EDITANDO FORNECEDOR[{{ $supplier->supplier_name }}]</span>
        <a href="{{ route('suppliersread') }}" class="py-1 px-3 mb-1 text-xs text-center text-white bg-red-600 rounded">Voltar</a>
    </div>
    <hr class="mt-0.5 border">

    {{-- ALTERAR USUÁRIO --}}
    <form action="{{ route('suppliersupdate', $supplier->id) }}" method="POST" id="open" class="text-xs">
        @csrf
        @method('PUT')
        <div class="flex items-center mt-3 px-2 space-x-2">
            <div class="w-full">
                <label for="supplier_name"><span class="font-semibold">:Fornecedor</span></label>
                <input class="w-full py-1 border border-blue-200 focus:border-blue-100 rounded text-xs text-blue-900 placeholder-gray-300" type="text" name="supplier_name" id="supplier_name" value="{{ $supplier->supplier_name }}" placeholder=" nome do fornecedor" required>
                @error('supplier_name')
                    <div class="absolute text-red-400">Digite o Nome Fornecedor</div>
                @enderror
            </div>
            <div class="w-full">
                <label for="contact"><span class="font-semibold">:Contato</span></label>
                <input class="w-full py-1 border border-blue-200 focus:border-blue-100 rounded text-blue-900 placeholder-gray-300 " type="text" name="contact" id="contact" value="{{ $supplier->contact }}" placeholder=" contato do fornecedor" required>
                @error('contact')
                    <div class="absolute text-red-400">Digite o Nome do Contato</div>
                @enderror
            </div>
            <div class="w-full">
                <label for="image_logo"><span class="font-semibold">:Novo Logo</span></label>
                <input class="w-full py-1 border border-blue-200 focus:border-blue-100 rounded text-blue-900 placeholder-gray-300" type="file" name="image_logo"  id="image_logo" value="{{ $supplier->image_logo }}" placeholder=" logo do fornecedor">
                @error('image_logo')
                    <div class="absolute text-red-400">Digite o Logo do Fornecedor</div>
                @enderror
            </div>
            <img src="{{ asset("LogoDGS.png") }}" class="w-32" alt="LOGO"/>
        </div>
        <div class="flex items-center mt-3 px-2 space-x-2">
            <div class="w-full">
                <label for="cpf_cnpj"><span class="font-semibold">:CPF/CNPJ</span></label>
                <input class="w-full py-1 border border-blue-200 focus:border-blue-100 rounded text-blue-900 placeholder-gray-300" type="text" name="cpf_cnpj"  id="cpf_cnpj" value="{{ $supplier->cpf_cnpj }}" placeholder=" cpf/cnpj" required>
                @error('cpf_cnpj')
                    <div class="absolute text-red-400">Digite o CPF/CNPJ</div>
                @enderror
            </div>
            <div class="w-full">
                <label for="phone"><span class="font-semibold">:Telefone/Celular</span></label>
                <input class="w-full py-1 border border-blue-200 focus:border-blue-100 rounded text-blue-900 placeholder-gray-300" type="text" name="phone"  id="phone" value="{{ $supplier->phone }}" placeholder=" telefone/celular" required>
                @error('phone')
                    <div class="absolute text-red-400">Digite o Telefone/Celular</div>
                @enderror
            </div>
        </div>
        <div class="flex items-center mt-3 px-2 space-x-2">
            <div class="w-full">
                <label for="street_address"><span class="font-semibold">:Logradouro</span></label>
                <input class="w-full py-1 border border-blue-200 focus:border-blue-100 rounded text-blue-900 placeholder-gray-300" type="text" name="street_address"  id="street_address" value="{{ $supplier->street_address }}" placeholder=" rua-nº-bairro" required>
                @error('street_address')
                    <div class="absolute text-red-400">Digite Rua-Nº-Bairro</div>
                @enderror
            </div>
            <div class="w-full">
                <label for="city"><span class="font-semibold">:Cidade</span></label>
                <input class="w-full py-1 border border-blue-200 focus:border-blue-100 rounded text-blue-900 placeholder-gray-300" type="text" name="city"  id="city" value="{{ $supplier->city }}" placeholder=" cidade" required>
                @error('city')
                    <div class="absolute text-red-400">Digite a Cidade</div>
                @enderror
            </div>
            <div class="w-full">
                <label for="state"><span class="font-semibold">:Estado/UF</span></label>
                <input class="w-full py-1 border border-blue-200 focus:border-blue-100 rounded text-blue-900 placeholder-gray-300" type="text" name="state"  id="state" value="{{ $supplier->state }}" placeholder=" sigla estado" required>
                @error('state')
                    <div class="absolute text-red-400">Digite a Sigra do Estado</div>
                @enderror
            </div>
            <div class="w-full">
                <label for="country"><span class="font-semibold">:País</span></label>
                <input class="w-full py-1 border border-blue-200 focus:border-blue-100 rounded text-blue-900 placeholder-gray-300" type="text" name="country"  id="country" value="{{ $supplier->country }}" placeholder=" digite o país" required>
                @error('country')
                    <div class="absolute text-red-400">Digite o País</div>
                @enderror
            </div>
            <div class="w-full">
                <label for="zipcode"><span class="font-semibold">:CEP</span></label>
                <input class="w-full py-1 border border-blue-200 focus:border-blue-100 rounded text-blue-900 placeholder-gray-300" type="text" name="zipcode"  id="zipcode" value="{{ $supplier->zipcode }}" placeholder=" digite o cep" required>
                @error('zipcode')
                    <div class="absolute text-red-400">Digite o CEP</div>
                @enderror
            </div>
            <div class="w-full">
                <label for="is_active"><span class="font-semibold">:Status</span></label>
                <select name="is_active" id="is_active" class="w-full py-1 border border-blue-200 focus:border-blue-100 rounded text-blue-900" required>
                    <option value="{{ $supplier->is_active }}">{{ $supplier->is_active == 1 ? "Ativo" : "Inativo"}}</option>
                    <option value="{{ 1 }}">Ativo</option>
                    <option value="{{ 0 }}">Inativo</option>
                </select>
            </div>
        </div>
        <div class="px-2">
            <button type="submit" class="w-full px-2 py-1 mt-3 text-center text-white bg-sky-700 rounded hover:bg-sky-800">Salvar Edição Fornecedor</button>
        </div>

    </form>

</div>

@endsection

