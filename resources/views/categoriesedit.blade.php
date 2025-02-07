@extends("layouts.app")
@section("title", "Categorias")
@section("content")

<div class="">

    <div class="flex justify-between items-center border py-1 px-2">
        <span class="font-bold">EDITANDO CATEGORIA[{{ $category->category_name }}]</span>
        <a href="{{ route('categoriesread') }}" class="py-1 px-3 mb-1 text-xs text-center text-white bg-red-600 rounded">Voltar</a>
    </div>
    <hr class="mt-0.5 border">

    {{-- ALTERAR USUÁRIO --}}
    <form action="{{ route('categoriesupdate', $category->id) }}" method="POST" id="" class="text-xs" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="flex items-center mt-3 px-2 space-x-2">
            <div class="w-3/12">
                <label for="category_name"><span class="font-semibold">:Categoria</span></label>
                <input class="w-full py-1 border border-blue-200 focus:border-blue-100 rounded text-xs text-blue-900 placeholder-gray-300" type="text" name="category_name" id="category_name" value="{{ $category->category_name }}" placeholder=" nome do categoria" required>
                @error('category_name')
                    <div class="absolute text-red-400">Digite o Nome Categoria</div>
                @enderror
            </div>
            <div class="w-3/12">
                <label for="slug"><span class="font-semibold">:Slug</span></label>
                <input class="w-full py-1 border border-blue-200 focus:border-blue-100 rounded text-xs text-blue-900 placeholder-gray-300" type="text" name="slug" id="slug" value="{{ $category->slug }}" placeholder=" nome do categoria" required>
                @error('slug')
                    <div class="absolute text-red-400">Digite o Slug Categoria</div>
                @enderror
            </div>
            <div class="w-3/12">
                <label for="image"><span class="font-semibold">:Imagem</span></label>
                <input class="w-full py-1 border border-blue-200 focus:border-blue-100 rounded text-blue-900 placeholder-gray-300" type="file" name="image"  id="image" value="{{ $category->image }}">
                @error('image')
                    <div class="absolute text-red-400">Carregue a Imagem da Categoria</div>
                @enderror
            </div>
            <div class="w-1/12">
                <img src="{{ asset("storage/{$category->image}") }}" class="w-48 py-1 px-1 border" alt="&#128228;">
            </div>
            <div class="w-2/12">
                <label for="is_active"><span class="font-semibold">:Status</span></label>
                <select name="is_active" id="is_active" class="w-full py-1 border border-blue-200 focus:border-blue-100 rounded text-blue-900" required>
                    <option value="{{ $category->is_active }}">{{ $category->is_active == 1 ? "Ativo" : "Inativo"}}</option>
                    <option value="{{ 1 }}">Ativo</option>
                    <option value="{{ 0 }}">Inativo</option>
                </select>
            </div>
        </div>
        <div class="px-2">
            <button type="submit" class="w-full px-2 py-1 mt-3 text-center text-white bg-sky-700 rounded hover:bg-sky-800">Salvar Edição Categoria</button>
        </div>

    </form>

</div>

@endsection

