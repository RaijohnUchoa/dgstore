@extends("layouts.app")
@section("title", "Marcas")
@section("content")

<div class="">

    <div class="flex justify-between items-center border py-1 px-2">
        <span class="font-bold">EDITANDO CATEGORIA[{{ $brand->brand_name }}]</span>
        <a href="{{ route('brandsread') }}" class="py-1 px-3 mb-1 text-xs text-center text-white bg-red-600 rounded">Voltar</a>
    </div>
    <hr class="mt-0.5 border">

    {{-- ALTERAR USUÁRIO --}}
    <form action="{{ route('brandsupdate', $brand->id) }}" method="POST" id="open" class="text-xs">
        @csrf
        @method('PUT')
        <div class="flex items-center mt-3 px-2 space-x-2">
            <div class="w-full">
                <label for="brand_name"><span class="font-semibold">:Marca</span></label>
                <input class="w-full py-1 border border-blue-200 focus:border-blue-100 rounded text-xs text-blue-900 placeholder-gray-300" type="text" name="brand_name" id="brand_name" value="{{ $brand->brand_name }}" placeholder=" nome do marca" required>
                @error('brand_name')
                    <div class="absolute text-red-400">Digite o Nome Marca</div>
                @enderror
            </div>
            <div class="w-full">
                <label for="slug"><span class="font-semibold">:Slug</span></label>
                <input class="w-full py-1 border border-blue-200 focus:border-blue-100 rounded text-xs text-blue-900 placeholder-gray-300" type="text" name="slug" id="slug" value="{{ $brand->slug }}" placeholder=" nome do marca" required>
                @error('slug')
                    <div class="absolute text-red-400">Digite o Slug Marca</div>
                @enderror
            </div>
            <div class="w-full">
                <label for="image"><span class="font-semibold">:Imagem</span></label>
                <input class="w-full py-1 border border-blue-200 focus:border-blue-100 rounded text-blue-900 placeholder-gray-300" type="file" name="image"  id="image" value="{{ $brand->image }}" placeholder=" imagem da marca" required>
                @error('image')
                    <div class="absolute text-red-400">Carregue a Imagem da Marca</div>
                @enderror
            </div>
            <div class="w-full">
                <label for="is_active"><span class="font-semibold">:Status</span></label>
                <select name="is_active" id="is_active" class="w-full py-1 border border-blue-200 focus:border-blue-100 rounded text-blue-900" required>
                    <option value="{{ $brand->is_active }}">{{ $brand->is_active == 1 ? "Ativo" : "Inativo"}}</option>
                    <option value="{{ 1 }}">Ativo</option>
                    <option value="{{ 0 }}">Inativo</option>
                </select>
            </div>
        </div>
        <div class="px-2">
            <button type="submit" class="w-full px-2 py-1 mt-3 text-center text-white bg-sky-700 rounded hover:bg-sky-800">Salvar Edição Marca</button>
        </div>

    </form>

</div>

@endsection

