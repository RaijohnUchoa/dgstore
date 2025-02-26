@extends("layouts.app")
@section("title", "Fornecedores")
@section("content")

@if(session()->has('success'))
    <span class="flex justify-center bg-green-200 text-green-700 text-xs m-2 py-1 rounded">{{ session()->get('success') }}</span>
@endif

<div class="flex justify-between items-center border py-1 px-2">
    <span class="font-semibold">FORNECEDORES</span>
    <div class="text-white">
        <a href="{{ route('suppliersfilter', 2) }}" class="bg-gray-700 text-xs py-1 px-2 rounded">Geral</a>
        <a href="{{ route('suppliersfilter', 1) }}" class="bg-green-600 text-xs py-1 px-1 rounded">Ativos</a>
        <a href="{{ route('suppliersfilter', 0) }}" class="bg-gray-500 text-xs py-1 px-1 rounded">inAtivos</a>
        <button class="bg-sky-600 text-white text-xs py-1 px-1 rounded" onclick="openForm()">Novo Fornecedor ▼</button>
    </div>
</div>
<hr class="mt-0.5 border">
{{-- INCLUIR NOVO FORNECEDOR --}}
<form action="{{ route('supplierscreate') }}" method="POST" id="open" class="text-xs hidden" enctype="multipart/form-data">
    @csrf
    <div class="flex items-center mt-3 px-2 space-x-2">
        <div class="w-full">
            <label for="supplier_name"><span class="font-semibold">:Fornecedor</span></label>
            <input class="w-full py-1 px-2 border border-blue-200 focus:border-blue-100 rounded text-xs text-blue-900 placeholder-gray-300" type="text" name="supplier_name" id="supplier_name" value="{{ old('supplier_name') }}" placeholder=" nome do fornecedor" required>
            @error('supplier_name')
                <div class="absolute text-red-400">Digite o Nome Fornecedor</div>
            @enderror
        </div>
        <div class="w-full">
            <label for="contact"><span class="font-semibold">:Contato</span></label>
            <input class="w-full py-1 px-2 border border-blue-200 focus:border-blue-100 rounded text-blue-900 placeholder-gray-300 " type="text" name="contact" id="contact" value="{{ old('contact') }}" placeholder=" contato do fornecedor" required>
            @error('contact')
                <div class="absolute text-red-400">Digite o Nome do Contato</div>
            @enderror
        </div>
        <div class="w-full">
            <label for="image_logo"><span class="font-semibold">:Imagem Logo</span></label>
            <input class="w-full py-1 px-2 border border-blue-200 focus:border-blue-100 rounded text-blue-900 placeholder-gray-300" type="file" name="image_logo"  id="image_logo" value="{{ old('image_logo') }}" placeholder=" logo do fornecedor" required>
            @error('image_logo')
                <div class="absolute text-red-400">Digite o Logo do Fornecedor</div>
            @enderror
        </div>
    </div>
    <div class="flex items-center mt-3 px-2 space-x-2">
        <div class="w-3/12">
            <label for="cpf_cnpj"><span class="font-semibold">:CPF/CNPJ</span></label>
            <input class="w-full py-1 px-2 border border-blue-200 focus:border-blue-100 rounded text-blue-900 placeholder-gray-300" type="text" name="cpf_cnpj"  id="cpf_cnpj" value="{{ old('cpf_cnpj') }}" placeholder=" cpf/cnpj" required>
            @error('cpf_cnpj')
                <div class="absolute text-red-400">Digite o CPF/CNPJ</div>
            @enderror
        </div>
        <div class="w-3/12">
            <label for="phone"><span class="font-semibold">:Telefone/Celular</span></label>
            <input class="w-full py-1 px-2 border border-blue-200 focus:border-blue-100 rounded text-blue-900 placeholder-gray-300" type="text" name="phone"  id="phone" value="{{ old('phone') }}" placeholder=" telefone/celular" required>
            @error('phone')
                <div class="absolute text-red-400">Digite o Telefone/Celular</div>
            @enderror
        </div>
        <div class="w-4/12">
            <label for="email"><span class="font-semibold">:Email</span></label>
            <input class="w-full py-1 px-2 border border-blue-200 focus:border-blue-100 rounded text-blue-900 placeholder-gray-300" type="text" name="email"  id="email" value="{{ old('email') }}" placeholder=" email válido" required>
            @error('email')
                <div class="absolute text-red-400">Digite um Email Válido</div>
            @enderror
        </div>
        <div class="w-2/12">
            <label for="is_active"><span class="font-semibold">:Status</span></label>
            <select name="is_active" id="is_active" class="w-full py-1 border border-blue-200 focus:border-blue-100 rounded text-blue-900" required>
                <option value="{{ 1 }}">Ativo</option>
                <option value="{{ 0 }}">Inativo</option>
            </select>
        </div>
    </div>
    <div class="flex items-center mt-3 px-2 space-x-2">
        <div class="w-full">
            <label for="street_address"><span class="font-semibold">:Logradouro</span></label>
            <input class="w-full py-1 px-2 border border-blue-200 focus:border-blue-100 rounded text-blue-900 placeholder-gray-300" type="text" name="street_address"  id="street_address" value="{{ old('street_address') }}" placeholder=" rua-nº-bairro" required>
            @error('street_address')
                <div class="absolute text-red-400">Digite Rua-Nº-Bairro</div>
            @enderror
        </div>
        <div class="w-full">
            <label for="city"><span class="font-semibold">:Cidade</span></label>
            <input class="w-full py-1 px-2 border border-blue-200 focus:border-blue-100 rounded text-blue-900 placeholder-gray-300" type="text" name="city"  id="city" value="{{ old('city') }}" placeholder=" cidade" required>
            @error('city')
                <div class="absolute text-red-400">Digite a Cidade</div>
            @enderror
        </div>
        <div class="w-full">
            <label for="state"><span class="font-semibold">:Estado/UF</span></label>
            <input class="w-full py-1 px-2 border border-blue-200 focus:border-blue-100 rounded text-blue-900 placeholder-gray-300" type="text" name="state"  id="state" value="{{ old('state') }}" placeholder=" sigla estado" required>
            @error('state')
                <div class="absolute text-red-400">Digite a Sigla do Estado</div>
            @enderror
        </div>
        <div class="w-full">
            <label for="country"><span class="font-semibold">:País</span></label>
            <input class="w-full py-1 px-2 border border-blue-200 focus:border-blue-100 rounded text-blue-900 placeholder-gray-300" type="text" name="country"  id="country" value="{{ old('country') }}" placeholder=" digite o país" required>
            @error('country')
                <div class="absolute text-red-400">Digite o País</div>
            @enderror
        </div>
        <div class="w-full">
            <label for="zipcode"><span class="font-semibold">:CEP</span></label>
            <input class="w-full py-1 px-2 border border-blue-200 focus:border-blue-100 rounded text-blue-900 placeholder-gray-300" type="text" name="zipcode"  id="zipcode" value="{{ old('zipcode') }}" placeholder=" digite o cep" required>
            @error('zipcode')
                <div class="absolute text-red-400">Digite o CEP</div>
            @enderror
        </div>
    </div>
    <div class="px-2">
        <button type="submit" class="w-full px-2 py-1 mt-3 text-center text-white bg-sky-700 rounded hover:bg-sky-800">Salvar Novo Fornecedor</button>
    </div>
</form>

{{-- LISTA TABELAS --}}
<div class="relative overflow-x-auto shadow sm:rounded">
    <table class="w-full mt-2 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-600 bg-gray-100 dark:bg-gray-700 dark:text-gray-400 border-b-4">
            <tr>
                <th scope="col" class="px-2">#</th>
                <th scope="col"></th>
                <th scope="col" class="">Fornecedor</th>
                <th scope="col" class="px-2">Contato</th>
                <th scope="col" class="px-2">CPF/CNPJ</th>
                <th scope="col" class="px-2">Telefone/Celular</th>
                <th scope="col" class="px-2">Email</th>
                <th scope="col" class="px-2">Status</th>
                <th scope="col" class="px-2">Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($suppliers as $supplier)
                <tr class="{{ $supplier->is_active == 1 ? 'text-green-700' : 'text-gray-300' }} border-b text-xs leading-8 odd:bg-white even:bg-gray-50">
                    <th scope="row" class="py-1">
                        <span>{{ $loop->iteration }}]</span>
                    </th>
                    <td class="py-1 {{ $supplier->is_active == 0 ? 'opacity-15' : '' }}">
                        <img src="{{ asset("storage/{$supplier->image_logo}") }}" class="w-12 py-1 px-1 border" alt="&#128228;">
                    </td>
                    <td class="py-1">
                        <span>{{ $supplier->supplier_name }}</span>
                    </td>
                    <td class="px-2 py-1">
                        <span>{{ $supplier->contact }}</span>
                    </td>
                    <td class="px-2 py-1">
                        <span>{{ $supplier->cpf_cnpj }}</span>
                    </td>
                    <td class="px-2 py-1">
                        <span>{{ $supplier->phone }}</span>
                    </td>
                    <td class="px-2 py-1">
                        <span>{{ $supplier->email }}</span>
                    </td>
                    <td class="px-2 py-1">
                        <span class="py-1 px-2 mr-2 rounded hover:fonte-bold">{{ $supplier->is_active == 1 ? "Ativo" : "inAtivo" }}</span>
                    </td>
                    <td class="px-2">
                        <div class="flex gap-1">
                            @if ($supplier->is_active == 1)
                                <a href="{{ route('suppliersedit', $supplier->id) }}">
                                    <span class="" title="Editar">
                                        <svg height="19px" viewBox="0 -960 960 960" width="19px" fill="#eab308">
                                            <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h357l-80 80H200v560h560v-278l80-80v358q0 33-23.5 56.5T760-120H200Zm280-360ZM360-360v-170l367-367q12-12 27-18t30-6q16 0 30.5 6t26.5 18l56 57q11 12 17 26.5t6 29.5q0 15-5.5 29.5T897-728L530-360H360Zm481-424-56-56 56 56ZM440-440h56l232-232-28-28-29-28-231 231v57Zm260-260-29-28 29 28 28 28-28-28Z"/>
                                        </svg>
                                    </span>
                                </a>
                                <a href="{{ route('suppliersactive', $supplier->id) }}" onclick="return confirm('Tem Certeza que Deseja (DESATIVAR)?')">
                                    <span class="" title="Desativar">
                                        <svg height="19px" viewBox="0 -960 960 960" width="19px" fill="#ef4444">
                                            <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/>
                                        </svg>
                                    </span>
                                </a>
                            @else
                                <span class="">
                                    <svg height="19px" viewBox="0 -960 960 960" width="19px" fill="#d1d5db">
                                        <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h357l-80 80H200v560h560v-278l80-80v358q0 33-23.5 56.5T760-120H200Zm280-360ZM360-360v-170l367-367q12-12 27-18t30-6q16 0 30.5 6t26.5 18l56 57q11 12 17 26.5t6 29.5q0 15-5.5 29.5T897-728L530-360H360Zm481-424-56-56 56 56ZM440-440h56l232-232-28-28-29-28-231 231v57Zm260-260-29-28 29 28 28 28-28-28Z"/>
                                    </svg>
                                </span>
                                <a href="{{ route('suppliersactive', $supplier->id) }}" onclick="return confirm('Tem Certeza que Deseja (REATIVAR)?')">
                                    <span class="" title="Reativar">
                                        <svg height="20px" viewBox="0 -960 960 960" width="20px" fill="#16a34a">
                                            <path d="M440-320h80v-166l64 62 56-56-160-160-160 160 56 56 64-62v166ZM280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520Zm-400 0v520-520Z"/>
                                        </svg>
                                    </span>
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td>Lista Vazia</td></tr>
            @endforelse
            </tr>
        </tbody>
    </table>
</div>

@endsection

<script>
    function openForm() {
      document.querySelector('#open').classList.toggle('hidden')
    }
    openForm()
</script>
