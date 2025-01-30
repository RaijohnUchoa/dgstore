@extends('layouts.app')
@section('title', 'Produtos')
@section('content')

    <div class="">

        @if (session()->has('success'))
            <span
                class="flex justify-center bg-green-200 text-green-700 text-sm m-2 py-1 rounded">{{ session()->get('success') }}</span>
        @endif

        <div class="flex justify-between items-center border py-1 px-2">
            <span class="font-semibold">PRODUTOS</span>
            <div class="text-white">
                <a href="{{ route('productsfilter', 2) }}" class="bg-gray-700 text-xs py-1 px-2 rounded">Geral</a>
                <a href="{{ route('productsfilter', 1) }}" class="bg-green-600 text-xs py-1 px-1 rounded">Ativos</a>
                <a href="{{ route('productsfilter', 0) }}" class="bg-gray-500 text-xs py-1 px-1 rounded">inAtivos</a>
                <button class="bg-sky-600 text-white text-xs py-1 px-1 rounded" onclick="openForm()">Novo Produto ▼</button>
            </div>
        </div>
        <hr class="mt-0.5 border">
        {{-- INCLUIR NOVO PRODUTO --}}
        {{-- <form action="{{ route('productscreate') }}" method="POST" id="open" class="text-xs hidden" enctype="multipart/form-data"> --}}
        <form action="{{ route('productscreate') }}" method="POST" id="open" class="text-xs" enctype="multipart/form-data">
            @csrf
            
            {{-- Card Título --}}
            <div class="pb-4 m-2 bg-white border border-blue-300 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <div class="flex items-center mt-3 px-2 space-x-2">
                    <div class="w-4/12">
                        <label for="category_id"><span class="font-semibold">:Categoria</span></label>
                        <select name="category_id" id="category_id"
                            class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-4/12">
                        <label for="brand_id"><span class="font-semibold">:Fabricante</span></label>
                        <select name="brand_id" id="brand_id"
                            class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900" required>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-2/12">
                        <label for="car_scale"><span class="font-semibold">:Escala</span></label>
                        <select name="car_scale" id="car_scale"
                            class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900" required>
                            <option value="{{ "1/64" }}">1/64</option>
                            <option value="{{ "1/87" }}">1/87</option>
                            <option value="{{ "1/72" }}">1/72</option>
                            <option value="{{ "1/50" }}">1/50</option>
                            <option value="{{ "1/43" }}">1/43</option>
                            <option value="{{ "1/32" }}">1/32</option>
                            <option value="{{ "1/24" }}">1/24</option>
                            <option value="{{ "1/18" }}">1/18</option>
                            <option value="{{ "1/12" }}">1/12</option>
                            <option value="{{ 'Outras' }}">Outras</option>
                        </select>
                    </div>
                    <div class="w-2/12">
                        <label for="is_active"><span class="font-semibold">:Status</span></label>
                        <select name="is_active" id="is_active"
                            class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900" required>
                            <option value="{{ 1 }}">Ativo</option>
                            <option value="{{ 0 }}">Inativo</option>
                        </select>
                    </div>
                </div>
                <div class="flex items-center mt-3 px-2 space-x-2">
                    <div class="w-full">
                        <label for="title"><span class="font-semibold">:Título</span></label>
                        <input
                            class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900 placeholder-gray-300"
                            type="text" name="title" id="title" value="{{ old('title') }}"
                            placeholder=" título do produto">
                        @error('title')
                            <div class="absolute text-red-400">Digite o Título do Produto</div>
                        @enderror
                    </div>
                </div>
            </div>
            {{-- Card Atributos --}}
            <div class="pb-4 m-2 bg-blue-50 border border-blue-300 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                <div class="flex items-center mt-3 px-2 space-x-2">
                    <div class="w-full">
                        <label for="car_model"><span class="font-semibold">:Marca/Modelo</span></label>
                        <input
                            class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900 placeholder-gray-300"
                            type="text" name="car_model" id="car_model" value="{{ old('car_model') }}"
                            placeholder=" nome do marca">
                        @error('car_model')
                            <div class="absolute text-red-400">Digite o Modelo</div>
                        @enderror
                    </div>
                    <div class="w-full">
                        {{-- @php $yearc = date('Y'); $years = range($yearc - 125, $yearc); rsort($years) @endphp
                        <label for="car_year"><span class="font-semibold">:Ano</span></label>
                        <select name="car_year" id="car_year"
                            class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900" required>
                            @foreach ($years as $year)
                                <option value="{{ "$year" }}">{{ $year }}</option>
                            @endforeach
                        </select> --}}
                        <label for="car_year"><span class="font-semibold">:Ano</span></label>
                        <input
                            class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900 placeholder-gray-300"
                            type="text" name="car_year" id="car_year" value="{{ old('car_year') }}"
                            placeholder=" nome do marca">
                        @error('car_year')
                            <div class="absolute text-red-400">Digite o Modelo</div>
                        @enderror
                    </div>
                    <div class="w-full">
                        <label for="car_color"><span class="font-semibold">:Cor</span></label>
                        <select name="car_color" id="car_color"
                            class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900">
                            <option value="{{ "Amarelo" }}">Amarelo</option>
                            <option value="{{ "Azul" }}">Azul</option>
                            <option value="{{ "Branco" }}">Branco</option>
                            <option value="{{ "Dourado" }}">Dourado</option>
                            <option value="{{ "Cinza" }}">Cinza</option>
                            <option value="{{ "Laranja" }}">Laranja</option>
                            <option value="{{ "Preto" }}">Preto</option>
                            <option value="{{ "Prata" }}">Prata</option>
                            <option value="{{ "Verde" }}">Verde</option>
                            <option value="{{ "Vermelho" }}">Vermelho</option>
                            <option value="{{ "Outras" }}">Outras</option>
                        </select>
                    </div>
                </div>
                <div class="flex items-center mt-3 px-2 space-x-2">
                    <div class="w-full">
                        <label for="stock"><span class="font-semibold">:Estoque</span></label>
                        <input
                            class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900 placeholder-gray-300"
                            type="text" name="stock" id="stock" value="{{ old('stock') }}"
                            placeholder=" quantidade de estoque">
                        @error('stock')
                            <div class="absolute text-red-400">Digite Quantidade do Estoque</div>
                        @enderror
                    </div>
                    <div class="w-full">
                        <label for="price_normal"><span class="font-semibold">:Preço</span></label>
                        <input
                            class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900 placeholder-gray-300"
                            type="text" name="price_normal" id="price_normal" value="{{ old('price_normal') }}"
                            placeholder=" preço normal" required>
                        @error('price_normal')
                            <div class="absolute text-red-400">Digite o Preço</div>
                        @enderror
                    </div>
                    <div class="w-full">
                        <label for="price_sale"><span class="font-semibold">:Preço Promocional</span></label>
                        <input
                            class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900 placeholder-gray-300"
                            type="text" name="price_sale" id="price_sale" value="{{ old('price_sale') }}"
                            placeholder=" preço promocional">
                        @error('price_sale')
                            <div class="absolute text-red-400">Digite o Preço Promocional</div>
                        @enderror
                    </div>
                </div>
                <div class="flex items-center mt-3 px-2 space-x-2">
                    <div class="w-full">
                        <label for="description"><span class="font-semibold">:Descrição</span></label>
                        <input
                            class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900 placeholder-gray-300"
                            type="text" name="description" id="description" value="{{ old('description') }}"
                            placeholder=" descrição do produto">
                        @error('description')
                            <div class="absolute text-red-400">Digite a Descrição do Produto</div>
                        @enderror
                    </div>
                </div>
                <div class="flex items-center mt-3 px-2 space-x-2">
                    <div class="w-full">
                        <label for="car_attribute"><span class="font-semibold">:Atributos</span></label>
                        <input
                            class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900 placeholder-gray-300"
                            type="text" name="car_attribute" id="car_attribute" value="{{ old('car_attribute') }}"
                            placeholder=" atributos">
                        @error('car_attribute')
                            <div class="absolute text-red-400">Digite os Atributos</div>
                        @enderror
                    </div>
                    <div class="w-full">
                        <label for="slug"><span class="font-semibold">:Slug</span></label>
                        <input
                            class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900 placeholder-gray-300"
                            type="text" name="slug" id="slug" value="{{ old('slug') }}"
                            placeholder=" nome do slug">
                        @error('slug')
                            <div class="absolute text-red-400">Digite o Slug do Produto</div>
                        @enderror
                    </div>
                    <div class="w-full">
                        <label for="sku"><span class="font-semibold">:SKU</span></label>
                        <input
                            class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900 placeholder-gray-300"
                            type="text" name="sku" id="sku" value="{{ old('sku') }}"
                            placeholder=" código SKU">
                        @error('sku')
                            <div class="absolute text-red-400">Digite o SKU</div>
                        @enderror
                    </div>
                    <div class="w-full">
                        <label for="barcode"><span class="font-semibold">:Código de Barras</span></label>
                        <input
                            class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900 placeholder-gray-300"
                            type="text" name="barcode" id="barcode" value="{{ old('barcode') }}"
                            placeholder=" código de barras">
                        @error('barcode')
                            <div class="absolute text-red-400">Digite o Código de Barras</div>
                        @enderror
                    </div>
                </div>
            </div>
            {{-- Card Imagem --}}

            {{-- <div class="pb-4 m-2 bg-white border border-blue-300 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <div class="flex items-center mt-3 px-2 space-x-2">
                    <div class="w-4/12">
                        <label for="image"><span class="font-semibold">:Imagem</span></label>
                        <input
                            class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-blue-900"
                            type="file" name="image" id="image" value="{{ old('image') }}"
                            placeholder=" imagem do produto" required>
                        @error('image')
                            <div class="absolute text-red-400">Carregue a Imagem do Produto</div>
                        @enderror
                    </div>
                </div>
            </div> --}}

            <div class="pb-4 m-2 bg-white border border-blue-300 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                
                <div class="flex items-center mt-3 px-2 space-x-2">
                    
                    <div class="w-4/12 bg-gray-100 border-2 border-blue-300 border-dashed rounded">
                        <label for="image1" class="cursor-pointer">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16"> <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/></svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                <p class="text-xs text-gray-500">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                            </div>
                            <input type="file" name="image1" id="image1" value="{{ old('image1') }}" class="mb-2" required/>
                        </label>
                    </div>
                    <div class="w-4/12 bg-gray-100 border-2 border-blue-300 border-dashed rounded">
                        <label for="image2" class="cursor-pointer">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16"> <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/></svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                <p class="text-xs text-gray-500">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                            </div>
                            <input type="file" name="image2" id="image2" value="{{ old('image2') }}" class="mb-2"/>
                        </label>
                    </div>
                    <div class="w-4/12 bg-gray-100 border-2 border-blue-300 border-dashed rounded">
                        <label for="image3" class="cursor-pointer">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16"> <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/></svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                <p class="text-xs text-gray-500">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                            </div>
                            <input type="file" name="image3" id="image3" value="{{ old('image3') }}" class="mb-2"/>
                        </label>
                    </div>

                </div>
                
            </div>
            
            <input type="number" name="is_featured" id="is_featured" value="{{ 0 }}"/>
            <input type="number" name="in_stock" id="in_stock" value="{{ 1 }}"/>
            <input type="number" name="on_sale" id="on_sale" value="{{ 0 }}"/>

            <div class="px-2">
                <button type="submit"
                    class="w-full px-2 py-1 mt-3 text-center text-white bg-sky-700 rounded hover:bg-sky-800">Salvar Novo
                    Produto</button>
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
                    @forelse ($products as $product)
                        <tr
                            class="{{ $product->is_active == 1 ? 'text-green-700' : 'text-gray-300' }} text-xs odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row" class="px-2 py-1">
                                <span>{{ $loop->iteration }}]</span>
                            </th>
                            <td class="px-2 py-1">
                                <span>{{ $product->product_name }}</span>
                            </td>
                            <td class="px-2 py-1">
                                <span>{{ $product->slug }}</span>
                            </td>
                            <td class="px-2 py-1">
                                <figure class="">
                                    <img src="{{ asset("storage/{$product->image1}") }}" class="w-16" alt="imagem">
                                    <figcaption class="bg-red-700 text-white text-center w-16">R${{ $product->price_normal }}</figcaption>
                                </figure>
                            </td>
                            <td class="px-2 py-1">
                                <span
                                    class="py-1 px-2 mr-2 rounded hover:fonte-bold">{{ $product->is_active == 1 ? 'Ativo' : 'inAtivo' }}</span>
                            </td>
                            <td class="px-2 flex items-center">

                                @if ($product->is_active == 1)
                                    <a href="{{ route('productsedit', $product->id) }}"
                                        class="bg-yellow-300 py-1 px-2 mr-2 rounded text-blue-600 hover:fonte-bold">Edit</a>
                                @else
                                    <span class="bg-gray-300 py-1 px-2 mr-2 rounded text-gray-400 hover:fonte-bold"
                                        disabled>Edit</span>
                                @endif
                                <a href="{{ route('productsactive', $product->id) }}"
                                    onclick="return confirm('Tem Certeza que Deseja (DES)ATIVAR')"
                                    class="flex {{ $product->is_active == 1 ? 'bg-red-600 px-1' : 'bg-gray-400 px-1' }} rounded-full text-gray-50 hover:fonte-bold"><span>{{ $product->is_active == 1 ? 'X' : '>' }}</span></a>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>Lista Vazia</td>
                        </tr>
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
