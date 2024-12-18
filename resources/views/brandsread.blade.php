@extends("layouts.app")
@section("title", "Marcas")
@section("content")

<div class="">

    @if(session()->has('success'))
        <span class="flex justify-center bg-green-200 text-green-700 text-sm m-2 py-1 rounded">{{ session()->get('success') }}</span>
    @endif

    <div class="flex justify-between items-center border py-1 px-2">
        <span class="font-semibold">MARCAS</span>
        <div class="text-white">
            <a href="{{ route('brandsfilter', 2) }}" class="bg-gray-700 text-xs py-1 px-2 rounded">Geral</a>
            <a href="{{ route('brandsfilter', 1) }}" class="bg-green-600 text-xs py-1 px-1 rounded">Ativos</a>
            <a href="{{ route('brandsfilter', 0) }}" class="bg-gray-500 text-xs py-1 px-1 rounded">inAtivos</a>
            <button class="bg-sky-600 text-white text-xs py-1 px-1 rounded" onclick="openForm()">Nova Marca ▼</button>
        </div>
    </div>
    <hr class="mt-0.5 border">
    {{-- INCLUIR NOVO USUÁRIO --}}
    <form action="{{ route('brandscreate') }}" method="POST" id="open" class="text-xs hidden" enctype="multipart/form-data">
        @csrf
        <div class="flex items-center mt-3 px-2 space-x-2">
            <div class="w-full">
                <label for="brand_name"><span class="font-semibold">:Marca</span></label>
                <input class="w-full py-1 border border-blue-200 focus:border-blue-100 rounded text-xs text-blue-900 placeholder-gray-300" type="text" name="brand_name" id="brand_name" value="{{ old('brand_name') }}" placeholder=" nome do marca" required>
                @error('brand_name')
                    <div class="absolute text-red-400">Digite o Nome Marca</div>
                @enderror
            </div>
            <div class="w-full">
                <label for="slug"><span class="font-semibold">:Slug</span></label>
                <input class="w-full py-1 border border-blue-200 focus:border-blue-100 rounded text-xs text-blue-900 placeholder-gray-300" type="text" name="slug" id="slug" value="{{ old('slug') }}" placeholder=" nome do marca" required>
                @error('slug')
                    <div class="absolute text-red-400">Digite o Slug Marca</div>
                @enderror
            </div>
            <div class="w-full">
                <label for="image"><span class="font-semibold">:Imagem</span></label>
                <input class="w-full py-1 border border-blue-200 focus:border-blue-100 rounded text-blue-900 placeholder-gray-300" type="file" name="image"  id="image" value="{{ old('image') }}" placeholder=" imagem da marca" required>
                @error('image')
                    <div class="absolute text-red-400">Carregue a Imagem da Marca</div>
                @enderror
            </div>
            <div class="w-full">
                <label for="is_active"><span class="font-semibold">:Status</span></label>
                <select name="is_active" id="is_active" class="w-full py-1 border border-blue-200 focus:border-blue-100 rounded text-blue-900" required>
                    <option value="{{ 1 }}">Ativo</option>
                    <option value="{{ 0 }}">Inativo</option>
                </select>
            </div>
        </div>
        <div class="px-2">
            <button type="submit" class="w-full px-2 py-1 mt-3 text-center text-white bg-sky-700 rounded hover:bg-sky-800">Salvar Nova Marca</button>
        </div>
    </form>

    {{-- LISTA TABELAS --}}
    <div class="relative overflow-x-auto shadow sm:rounded">
        <table class="w-full mt-2 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-600 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400 border-b-4">
                <tr>
                    <th scope="col" class="px-2">#</th>
                    {{-- <th scope="col"></th> --}}
                    <th scope="col" class="px-2">Marca</th>
                    <th scope="col" class="px-2">Slug</th>
                    <th scope="col" class="px-2">Imagem</th>
                    <th scope="col" class="px-2">Status</th>
                    <th scope="col" class="px-2">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($brands as $brand)
                    <tr class="{{ $brand->is_active == 1 ? 'text-green-700' : 'text-gray-300' }} text-xs odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th scope="row" class="px-2 py-1">
                            <span>{{ $loop->iteration }}]</span>
                        </th>
                        <td class="px-2 py-1">
                            <span>{{ $brand->brand_name }}</span>
                        </td>
                        <td class="px-2 py-1">
                            <span>{{ $brand->slug }}</span>
                        </td>
                        <td class="px-2 py-1">
                            <span>{{ $brand->image }}</span>
                        </td>
                        <td class="px-2 py-1">
                            <span class="py-1 px-2 mr-2 rounded hover:fonte-bold">{{ $brand->is_active == 1 ? "Ativo" : "inAtivo" }}</span>
                        </td>
                        <td class="px-2 flex items-center">

                            @if ($brand->is_active == 1)
                                <a href="{{ route('brandsedit', $brand->id) }}" class="bg-yellow-300 py-1 px-2 mr-2 rounded text-blue-600 hover:fonte-bold">Edit</a>
                            @else
                                <span class="bg-gray-300 py-1 px-2 mr-2 rounded text-gray-400 hover:fonte-bold" disabled>Edit</span>
                            @endif
                            <a href="{{ route('brandsactive', $brand->id) }}" onclick="return confirm('Tem Certeza que Deseja (DES)ATIVAR')" class="flex {{ $brand->is_active == 1 ? 'bg-red-600 px-1' : 'bg-gray-400 px-1' }} rounded-full text-gray-50 hover:fonte-bold"><span>{{ $brand->is_active == 1 ? 'X' : '>' }}</span></a>
                            
                        </td>
                    </tr>
                @empty
                    <tr><td>Lista Vazia</td></tr>
                @endforelse
                </tr>
            </tbody>
        </table>
    </div>


</div>

@endsection

<script>
    function openForm() {
      document.querySelector('#open').classList.toggle('hidden')
    }
    openForm()
</script>
