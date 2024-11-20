@extends("layouts.app")
@section("title", "Cateegorias")
@section("content")

<div class="">

    @if(session()->has('success'))
        <span class="flex justify-center bg-green-200 text-green-700 text-sm m-2 py-1 rounded">{{ session()->get('success') }}</span>
    @endif

    <div class="flex justify-between items-center border py-1 px-2">
        <span class="font-semibold">CATEGORIAS</span>
        <div class="text-white">
            <a href="{{ route('categoriesfilter', 2) }}" class="bg-gray-700 text-xs py-1 px-2 rounded">Geral</a>
            <a href="{{ route('categoriesfilter', 1) }}" class="bg-green-600 text-xs py-1 px-1 rounded">Ativos</a>
            <a href="{{ route('categoriesfilter', 0) }}" class="bg-gray-500 text-xs py-1 px-1 rounded">inAtivos</a>
            <button class="bg-sky-600 text-white text-xs py-1 px-1 rounded" onclick="openForm()">Novo Fornecedor ▼</button>
        </div>
    </div>
    <hr class="mt-0.5 border">
    {{-- INCLUIR NOVO USUÁRIO --}}
    <form action="{{ route('categoriescreate') }}" method="POST" id="open" class="text-xs hidden" enctype="multipart/form-data">
        @csrf
        <div class="flex items-center mt-3 px-2 space-x-2">
            <div class="w-full">
                <label for="category_name"><span class="font-semibold">:Categoria</span></label>
                <input class="w-full py-1 border border-blue-200 focus:border-blue-100 rounded text-xs text-blue-900 placeholder-gray-300" type="text" name="category_name" id="category_name" value="{{ old('category_name') }}" placeholder=" nome do categoria" required>
                @error('category_name')
                    <div class="absolute text-red-400">Digite o Nome Categoria</div>
                @enderror
            </div>
            <div class="w-full">
                <label for="slug"><span class="font-semibold">:Slug</span></label>
                <input class="w-full py-1 border border-blue-200 focus:border-blue-100 rounded text-xs text-blue-900 placeholder-gray-300" type="text" name="slug" id="slug" value="{{ old('slug') }}" placeholder=" nome do categoria" required>
                @error('slug')
                    <div class="absolute text-red-400">Digite o Slug Categoria</div>
                @enderror
            </div>
            <div class="w-full">
                <label for="image"><span class="font-semibold">:Imagem</span></label>
                <input class="w-full py-1 border border-blue-200 focus:border-blue-100 rounded text-blue-900 placeholder-gray-300" type="file" name="image"  id="image" value="{{ old('image') }}" placeholder=" imagem da categoria" required>
                @error('image')
                    <div class="absolute text-red-400">Carregue a Imagem da Categoria</div>
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
            <button type="submit" class="w-full px-2 py-1 mt-3 text-center text-white bg-sky-700 rounded hover:bg-sky-800">Salvar Nova Categoria</button>
        </div>
    </form>

    {{-- LISTA TABELAS --}}
    <div class="relative overflow-x-auto shadow sm:rounded">
        <table class="w-full mt-2 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-600 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400 border-b-4">
                <tr>
                    <th scope="col" class="px-2">#</th>
                    {{-- <th scope="col"></th> --}}
                    <th scope="col" class="px-2">Categoria</th>
                    <th scope="col" class="px-2">Slug</th>
                    <th scope="col" class="px-2">Imagem</th>
                    <th scope="col" class="px-2">Status</th>
                    <th scope="col" class="px-2">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr class="{{ $category->is_active == 1 ? 'text-green-700' : 'text-gray-300' }} text-xs odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th scope="row" class="px-2 py-1">
                            <span>{{ $loop->iteration }}]</span>
                        </th>
                        <td class="px-2 py-1">
                            <span>{{ $category->category_name }}</span>
                        </td>
                        <td class="px-2 py-1">
                            <span>{{ $category->slug }}</span>
                        </td>
                        <td class="px-2 py-1">
                            <span>{{ $category->image }}</span>
                        </td>
                        <td class="px-2 py-1">
                            <span class="py-1 px-2 mr-2 rounded hover:fonte-bold">{{ $category->is_active == 1 ? "Ativo" : "inAtivo" }}</span>
                        </td>
                        {{-- <td class="px-2 flex items-center">

                            @if ($category->is_active == 1)
                                <a href="{{ route('categorysedit', $category->id) }}" class="bg-yellow-300 py-1 px-2 mr-2 rounded text-blue-600 hover:fonte-bold">Edit</a>
                            @else
                                <span class="bg-gray-300 py-1 px-2 mr-2 rounded text-gray-400 hover:fonte-bold" disabled>Edit</span>
                            @endif
                            <a href="{{ route('categorysactive', $category->id) }}" onclick="return confirm('Tem Certeza que Deseja (DES)ATIVAR')" class="flex {{ $category->is_active == 1 ? 'bg-red-600 px-1' : 'bg-gray-400 px-1' }} rounded-full text-gray-50 hover:fonte-bold"><span>{{ $category->is_active == 1 ? 'x' : '>' }}</span></a>
                            
                        </td> --}}
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

{{-- CUSTOM SELECT --}}
{{-- <div class="inline-block relative w-64">
    <select class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
      <option>Really long option that will likely overlap the chevron</option>
      <option>Option 2</option>
      <option>Option 3</option>
    </select>
    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
      <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
    </div>
</div> --}}
