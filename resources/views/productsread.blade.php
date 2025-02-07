@extends('layouts.app')
@section('title', 'Produtos')
@section('content')

@if (session()->has('success'))
    <span
        class="flex justify-center bg-green-200 text-green-700 text-xs m-2 py-1 rounded">{{ session()->get('success') }}</span>
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
{{-- <form action="{{ route('productscreate') }}" method="POST" id="open" class="text-xs" enctype="multipart/form-data"> --}}
<form action="{{ route('productscreate') }}" method="POST" id="open" class="text-xs hidden" enctype="multipart/form-data">
    @csrf
    {{-- Card Título --}}
    <div
        class="pb-4 m-2 bg-white border border-blue-300 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <div class="flex items-center mt-3 px-2 space-x-2">
            <div class="w-4/12">
                <label for="category_id"><span class="font-semibold">:Categoria</span></label>
                <select name="category_id" id="category_id"
                    class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900"
                    required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-4/12">
                <label for="brand_id"><span class="font-semibold">:Fabricante</span></label>
                <select name="brand_id" id="brand_id"
                    class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900"
                    required>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-2/12">
                <label for="car_scale"><span class="font-semibold">:Escala</span></label>
                <select name="car_scale" id="car_scale"
                    class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900"
                    required>
                    <option value="{{ '1/64' }}">1/64</option>
                    <option value="{{ '1/87' }}">1/87</option>
                    <option value="{{ '1/72' }}">1/72</option>
                    <option value="{{ '1/50' }}">1/50</option>
                    <option value="{{ '1/43' }}">1/43</option>
                    <option value="{{ '1/32' }}">1/32</option>
                    <option value="{{ '1/24' }}">1/24</option>
                    <option value="{{ '1/18' }}">1/18</option>
                    <option value="{{ '1/12' }}">1/12</option>
                    <option value="{{ 'Outras' }}">Outras</option>
                </select>
            </div>
            <div class="w-2/12">
                <label for="is_active"><span class="font-semibold">:Status</span></label>
                <select name="is_active" id="is_active"
                    class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900"
                    required>
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
                    placeholder=" título do produto" required>
                @error('title')
                    <div class="absolute text-red-400">Digite o Título do Produto</div>
                @enderror
            </div>
        </div>
    </div>
    {{-- Card Características do Produto --}}
    <div
        class="pb-4 m-2 bg-blue-50 border border-blue-300 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

        <div class="flex items-center mt-3 px-2 space-x-2">
            <div class="w-3/12">
                <label for="car_model"><span class="font-semibold">:Marca/Modelo</span></label>
                <input
                    class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900 placeholder-gray-300"
                    type="text" name="car_model" id="car_model" value="{{ old('car_model') }}"
                    placeholder=" nome do marca">
                @error('car_model')
                    <div class="absolute text-red-400">Digite o Modelo</div>
                @enderror
            </div>
            <div class="w-2/12">
                <label for="car_year"><span class="font-semibold">:Ano</span></label>
                <input
                    class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900 placeholder-gray-300"
                    type="text" name="car_year" id="car_year" value="{{ old('car_year') }}"
                    placeholder=" nome do marca">
                @error('car_year')
                    <div class="absolute text-red-400">Digite o Modelo</div>
                @enderror
            </div>
            <div class="w-2/12">
                <label for="car_color"><span class="font-semibold">:Cor</span></label>
                <select name="car_color" id="car_color"
                    class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900">
                    <option value="{{ 'Amarelo' }}">Amarelo</option>
                    <option value="{{ 'Azul' }}">Azul</option>
                    <option value="{{ 'Branco' }}">Branco</option>
                    <option value="{{ 'Dourado' }}">Dourado</option>
                    <option value="{{ 'Cinza' }}">Cinza</option>
                    <option value="{{ 'Laranja' }}">Laranja</option>
                    <option value="{{ 'Preto' }}">Preto</option>
                    <option value="{{ 'Prata' }}">Prata</option>
                    <option value="{{ 'Verde' }}">Verde</option>
                    <option value="{{ 'Vermelho' }}">Vermelho</option>
                    <option value="{{ 'Outras' }}">Outras</option>
                </select>
            </div>
            <div class="w-2/12">
                <label for="car_attribute"><span class="font-semibold">:Atributo/Tipo</span></label>
                <select name="car_attribute" id="car_attribute"
                    class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900">
                    <option value="{{ 'Pickup' }}">Pickup</option>
                    <option value="{{ 'SUV' }}">SUV</option>
                    <option value="{{ 'Sedan' }}">Sedan</option>
                    <option value="{{ 'Conversível' }}">Conversível</option>
                    <option value="{{ 'Van' }}">Van</option>
                    <option value="{{ 'Onibus' }}">Onibus</option>
                    <option value="{{ 'Outros' }}">Outras</option>
                </select>
            </div>
            <div class="w-3/12">
                <label for="slug"><span class="font-semibold">:Slug</span></label>
                <input
                    class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900 placeholder-gray-300"
                    type="text" name="slug" id="slug" value="{{ old('slug') }}"
                    placeholder=" nome do slug">
                @error('slug')
                    <div class="absolute text-red-400">Digite o Slug do Produto</div>
                @enderror
            </div>
        </div>
        <div class="flex items-center mt-3 px-2 space-x-2">
            <div class="w-3/12">
                <label for="sku"><span class="font-semibold">:SKU</span></label>
                <input
                    class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900 placeholder-gray-300"
                    type="text" name="sku" id="sku" value="{{ old('sku') }}"
                    placeholder=" código SKU">
                @error('sku')
                    <div class="absolute text-red-400">Digite o SKU</div>
                @enderror
            </div>
            <div class="w-3/12">
                <label for="barcode"><span class="font-semibold">:Código de Barras</span></label>
                <input
                    class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900 placeholder-gray-300"
                    type="text" name="barcode" id="barcode" value="{{ old('barcode') }}"
                    placeholder=" código de barras">
                @error('barcode')
                    <div class="absolute text-red-400">Digite o Código de Barras</div>
                @enderror
            </div>
            <div class="w-2/12">
                <label for="stock"><span class="font-semibold">:Estoque</span></label>
                <input
                    class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900 placeholder-gray-300"
                    type="text" name="stock" id="stock" value="{{ old('stock') }}"
                    placeholder=" quantidade de estoque" required>
                @error('stock')
                    <div class="absolute text-red-400">Digite Quantidade do Estoque</div>
                @enderror
            </div>
            <div class="w-2/12">
                <label for="price_normal"><span class="font-semibold">:Preço</span></label>
                <input
                    class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900 placeholder-gray-300"
                    type="text" name="price_normal" id="price_normal" value="{{ old('price_normal') }}"
                    placeholder=" preço normal" required>
                @error('price_normal')
                    <div class="absolute text-red-400">Digite o Preço</div>
                @enderror
            </div>
            <div class="w-2/12">
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
        {{-- <input type="hidden" name="is_featured" id="is_featured" value="{{ 0 }}" />
        <input type="hidden" name="in_stock" id="in_stock" value="{{ 1 }}" />
        <input type="hidden" name="on_sale" id="on_sale" value="{{ 0 }}" /> --}}

        <div class="flex justify-center items-center mt-3 space-x-3">
            <span>Produto em:</span>
            <div class="flex">
                <input name="is_featured" id="is_featured" type="checkbox" value="{{ 1 }}" class="">
                <label for="is_featured" class="font-semibold ps-1">Destaque</label>
            </div>
            <div class="flex">
                <input name="on_sale" id="on_sale" type="checkbox" value="{{ 1 }}" class="">
                <label for="on_sale" class="font-semibold ps-1">Promoção</label>
            </div>
            <div class="flex">
                <input name="in_stock" id="in_stock" type="checkbox" value="{{ 1 }}" class="">
                <label for="in_stock" class="font-semibold ps-1">Estoque</label>
            </div>
        </div>
    </div>
    {{-- Card Imagem --}}
    <div
        class="py-3 m-2 bg-white border border-blue-300 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

        <div class="flex justify-evenly">

            <div class="h-[220px] w-[175px] bg-gray-100 border-2 border-blue-300 border-dashed rounded">
                <label for="image1" class="cursor-pointer relative">
                    <div class="flex flex-col items-center justify-center py-16">
                        <p class="text-4xl py-1">&#128228;</p>
                        <p class="text-sm text-gray-500">Click to Upload</p>
                        <p class="text-sm text-red-400">Obrigatória</p>
                    </div>
                    <input type="file" name="image1" id="image1" value="{{ old('image1') }}"
                        onchange="previewImage1()" class="hidden" required />
                    <img id="img1" class="absolute top-0 h-[216px] w-[175px] p-1">
                </label>
            </div>
            <div class="h-[220px] w-[175px] bg-gray-100 border-2 border-blue-300 border-dashed rounded">
                <label for="image2" class="cursor-pointer relative">
                    <div class="flex flex-col items-center justify-center py-16">
                        <p class="text-4xl py-1">&#128228;</p>
                        <p class="text-sm text-gray-500">Click to Upload</p>
                        <p class="text-sm text-gray-400">Opcional</p>
                    </div>
                    <input type="file" name="image2" id="image2" value="{{ old('image2') }}"
                        onchange="previewImage2()" class="hidden" />
                    <img id="img2" class="absolute top-0 h-[216px] w-[175px] p-1">
                </label>
            </div>
            <div class="h-[220px] w-[175px] bg-gray-100 border-2 border-blue-300 border-dashed rounded">
                <label for="image3" class="cursor-pointer relative">
                    <div class="flex flex-col items-center justify-center py-16">
                        <p class="text-4xl py-1">&#128228;</p>
                        <p class="text-sm text-gray-500">Click to Upload</p>
                        <p class="text-sm text-gray-400">Opcional</p>
                    </div>
                    <input type="file" name="image3" id="image3" value="{{ old('image3') }}"
                        onchange="previewImage3()" class="hidden" />
                    <img id="img3" class="absolute top-0 h-[216px] w-[175px] p-1">
                </label>
            </div>
            <div class="h-[220px] w-[175px] bg-gray-100 border-2 border-blue-300 border-dashed rounded">
                <label for="image4" class="cursor-pointer relative">
                    <div class="flex flex-col items-center justify-center py-16">
                        <p class="text-4xl py-1">&#128228;</p>
                        <p class="text-sm text-gray-500">Click to Upload</p>
                        <p class="text-sm text-gray-400">Opcional</p>
                    </div>
                    <input type="file" name="image4" id="image4" value="{{ old('image4') }}"
                        onchange="previewImage4()" class="hidden" />
                    <img id="img4" class="absolute top-0 h-[216px] w-[175px] p-1">
                </label>
            </div>
            <div class="h-[220px] w-[175px] bg-gray-100 border-2 border-blue-300 border-dashed rounded">
                <label for="image5" class="cursor-pointer relative">
                    <div class="flex flex-col items-center justify-center py-16">
                        <p class="text-4xl py-1">&#128228;</p>
                        <p class="text-sm text-gray-500">Click to Upload</p>
                        <p class="text-sm text-gray-400">Opcional</p>
                    </div>
                    <input type="file" name="image5" id="image5" value="{{ old('image5') }}"
                        onchange="previewImage5()" class="hidden" />
                    <img id="img5" class="absolute top-0 h-[216px] w-[175px] p-1">
                </label>
            </div>
        </div>
    </div>
    <div class="px-2">
        <button type="submit" class="w-full px-2 py-1 mt-3 text-center text-white bg-sky-700 rounded hover:bg-sky-800">Salvar Novo Produto</button>
    </div>
</form>

{{-- LISTA/EDIT PRODUTOS --}}
@forelse ($products as $product)

    <div class="border-b p-1 {{ $product->is_active == 1 ? 'text-blue-900' : 'text-gray-300' }} text-xs odd:bg-gray-75 even:bg-white">

        <span class="text-red-900">{{ $loop->iteration }}]</span>
        <span class="">{{ substr($product->title, 0, 55) }}</span>

        <div class="flex justify-between items-center text-center pr-2">

            <div class="flex items-center pt-1 {{ $product->is_active == 0 ? 'opacity-15' : '' }}">

                @if ($product->image1 != null)
                    <div class="h-18 p-1 mr-1 border border-blue-300 rounded">
                        <img src="{{ asset("storage/{$product->image1}") }}" class="h-16 w-14">
                    </div>
                    <a href="{{ route('productsdelete', [$product->id, 1]) }}">
                        <span class="" title="Deletar">
                            <svg class="-mt-9 -ml-5 rounded bg-white" height="15px" viewBox="0 -960 960 960" width="15px" fill="#ef4444">
                                <path d="m376-300 104-104 104 104 56-56-104-104 104-104-56-56-104 104-104-104-56 56 104 104-104 104 56 56Zm-96 180q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520Zm-400 0v520-520Z" />
                            </svg>
                        </span>
                    </a>
                @else
                    <a href="{{ route('productsedit', $product->id) }}">
                        <div class="h-18 p-1 mr-1 border border-blue-300 border-dashed rounded" title="Incluir Imagem">
                            <span class="flex justify-center items-center h-16 w-14">&#128228;</span>
                        </div>
                    </a>
                @endif
                @if ($product->image2 != null)
                    <div class="h-18 p-1 mr-1 border border-blue-300 rounded">
                        <img src="{{ asset("storage/{$product->image2}") }}" class="h-16 w-14">
                    </div>
                    <a href="{{ route('productsdelete', [$product->id, 2]) }}">
                        <span class="" title="Deletar">
                            <svg class="-mt-9 -ml-5 rounded bg-white" height="15px" viewBox="0 -960 960 960"
                                width="15px" fill="#ef4444">
                                <path
                                    d="m376-300 104-104 104 104 56-56-104-104 104-104-56-56-104 104-104-104-56 56 104 104-104 104 56 56Zm-96 180q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520Zm-400 0v520-520Z" />
                            </svg>
                        </span>
                    </a>
                @else
                    <a href="{{ route('productsedit', $product->id) }}">
                        <div class="h-18 p-1 mr-1 border border-blue-300 border-dashed rounded" title="Incluir Imagem">
                            <span class="flex justify-center items-center h-16 w-14">&#128228;</span>
                        </div>
                    </a>
                @endif
                @if ($product->image3 != null)
                    <div class="h-18 p-1 mr-1 border border-blue-300 rounded">
                        <img src="{{ asset("storage/{$product->image3}") }}" class="h-16 w-14">
                    </div>
                    <a href="{{ route('productsdelete', [$product->id, 3]) }}">
                        <span class="" title="Deletar">
                            <svg class="-mt-9 -ml-5 rounded bg-white" height="15px" viewBox="0 -960 960 960"
                                width="15px" fill="#ef4444">
                                <path
                                    d="m376-300 104-104 104 104 56-56-104-104 104-104-56-56-104 104-104-104-56 56 104 104-104 104 56 56Zm-96 180q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520Zm-400 0v520-520Z" />
                            </svg>
                        </span>
                    </a>
                @else
                    <a href="{{ route('productsedit', $product->id) }}">
                        <div class="h-18 p-1 mr-1 border border-blue-300 border-dashed rounded" title="Incluir Imagem">
                            <span class="flex justify-center items-center h-16 w-14">&#128228;</span>
                        </div>
                    </a>
                @endif
                @if ($product->image4 != null)
                    <div class="h-18 p-1 mr-1 border border-blue-300 rounded">
                        <img src="{{ asset("storage/{$product->image4}") }}" class="h-16 w-14">
                    </div>
                    <a href="{{ route('productsdelete', [$product->id, 4]) }}">
                        <span class="" title="Deletar">
                            <svg class="-mt-9 -ml-5 rounded bg-white" height="15px" viewBox="0 -960 960 960"
                                width="15px" fill="#ef4444">
                                <path
                                    d="m376-300 104-104 104 104 56-56-104-104 104-104-56-56-104 104-104-104-56 56 104 104-104 104 56 56Zm-96 180q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520Zm-400 0v520-520Z" />
                            </svg>
                        </span>
                    </a>
                @else
                    <a href="{{ route('productsedit', $product->id) }}">
                        <div class="h-18 p-1 mr-1 border border-blue-300 border-dashed rounded" title="Incluir Imagem">
                            <span class="flex justify-center items-center h-16 w-14">&#128228;</span>
                        </div>
                    </a>
                @endif
                @if ($product->image5 != null)
                    <div class="h-18 p-1 mr-1 border border-blue-300 rounded">
                        <img src="{{ asset("storage/{$product->image5}") }}" class="h-16 w-14">
                    </div>
                    <a href="{{ route('productsdelete', [$product->id, 5]) }}">
                        <span class="" title="Deletar">
                            <svg class="-mt-9 -ml-5 rounded bg-white" height="15px" viewBox="0 -960 960 960"
                                width="15px" fill="#ef4444">
                                <path
                                    d="m376-300 104-104 104 104 56-56-104-104 104-104-56-56-104 104-104-104-56 56 104 104-104 104 56 56Zm-96 180q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520Zm-400 0v520-520Z" />
                            </svg>
                        </span>
                    </a>
                @else
                    <a href="{{ route('productsedit', $product->id) }}">
                        <div class="h-18 p-1 mr-1 border border-blue-300 border-dashed rounded" title="Incluir Imagem">
                            <span class="flex justify-center items-center h-16 w-14">&#128228;</span>
                        </div>
                    </a>
                @endif

            </div>
            {{-- FORMULÁRIO ALTERAR NA LISTAGEM --}}
            <form action="{{ route('productsupdate', $product->id) }}" method="POST" id="open" class="text-xs mt-3">
                @csrf
                @method('PUT')

                <div class="flex items-center">

                    <div class="flex items-center gap-x-1">
                        {{-- <span>{{ $product->id }}</span>
                        <span>{{ $product->category_id }}</span>
                        <span>{{ $product->brand_id }}</span> --}}

                        {{-- <select name="category_id" id="category_id"
                            class="w-36 py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs {{ $product->is_active == 1 ? 'text-blue-900' : 'text-gray-300' }}"
                            @disabled($product->is_active == 1 ? false : true)>
                            <option value="{{ $product->category_id }}">{{ $product->category_name }}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                        <select name="brand_id" id="brand_id"
                            class="w-32 py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs {{ $product->is_active == 1 ? 'text-blue-900' : 'text-gray-300' }}"
                            @disabled($product->is_active == 1 ? false : true)>
                            <option value="{{ $product->brand_id }}">{{ $product->brand_name }}</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                            @endforeach
                        </select> --}}

                        <div class="w-32 py-1 px-2 border border-blue-200 rounded text-xs {{ $product->is_active == 1 ? 'text-blue-900' : 'text-gray-300' }}">
                            <div class="flex">
                                <input name="is_featured" id="is_featured" type="checkbox" value="{{ 1 }}" @checked($product->is_featured == 0 ? false : true) @disabled($product->is_active == 1 ? false : true)>
                                <label for="is_featured" class="ps-1">em Destaque</label>
                            </div>
                            <div class="flex">
                                <input name="on_sale" id="on_sale" type="checkbox" value="{{ 1 }}" @checked($product->on_sale == 0 ? false : true) @disabled($product->is_active == 1 ? false : true)>
                                <label for="on_sale" class="ps-1">em Promoção</label>
                            </div>
                            <div class="flex">
                                <input name="in_stock" id="in_stock" type="checkbox" value="{{ 1 }}" @checked($product->in_stock == 0 ? false : true) @disabled($product->is_active == 1 ? false : true)>
                                <label for="in_stock" class="ps-1">em Estoque</label>
                            </div>
                        </div>

                        <input
                            class="w-16 py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs {{ $product->is_active == 1 ? 'text-blue-900' : 'text-gray-300' }}"
                            type="text" name="stock" id="stock" value="{{ $product->stock }}"
                            @disabled($product->is_active == 1 ? false : true)>
                        <input
                            class="w-20 py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs {{ $product->is_active == 1 ? 'text-blue-900' : 'text-gray-300' }}"
                            type="text" name="price_normal" id="price_normal"
                            value="{{ $product->price_normal }}" @disabled($product->is_active == 1 ? false : true)>
                        <input
                            class="w-20 py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs {{ $product->is_active == 1 ? 'text-blue-900' : 'text-gray-300' }}"
                            type="text" name="price_sale" id="price_sale" value="{{ $product->price_sale }}"
                            @disabled($product->is_active == 1 ? false : true)>

                        @if ($product->is_active == 1)
                            <button type="submit" class="" title="Atualizar">
                                <svg height="22px" viewBox="0 -960 960 960" width="22px" fill="#0284c7">
                                    <path d="M482-160q-134 0-228-93t-94-227v-7l-64 64-56-56 160-160 160 160-56 56-64-64v7q0 100 70.5 170T482-240q26 0 51-6t49-18l60 60q-38 22-78 33t-82 11Zm278-161L600-481l56-56 64 64v-7q0-100-70.5-170T478-720q-26 0-51 6t-49 18l-60-60q38-22 78-33t82-11q134 0 228 93t94 227v7l64-64 56 56-160 160Z" />
                                </svg>
                            </button>
                            <a href="{{ route('productsedit', $product->id) }}">
                                <span class="" title="Editar">
                                    <svg height="19px" viewBox="0 -960 960 960" width="19px" fill="#eab308">
                                        <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h357l-80 80H200v560h560v-278l80-80v358q0 33-23.5 56.5T760-120H200Zm280-360ZM360-360v-170l367-367q12-12 27-18t30-6q16 0 30.5 6t26.5 18l56 57q11 12 17 26.5t6 29.5q0 15-5.5 29.5T897-728L530-360H360Zm481-424-56-56 56 56ZM440-440h56l232-232-28-28-29-28-231 231v57Zm260-260-29-28 29 28 28 28-28-28Z" />
                                    </svg>
                                </span>
                            </a>
                            <a href="{{ route('productsactive', $product->id) }}"
                                onclick="return confirm('Tem Certeza que Deseja (DESATIVAR)?')">
                                <span class="" title="Desativar">
                                    <svg height="19px" viewBox="0 -960 960 960" width="19px" fill="#ef4444">
                                        <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
                                    </svg>
                                </span>
                            </a>
                        @else
                            <span class="">
                                <svg height="22px" viewBox="0 -960 960 960" width="22px" fill="#d1d5db">
                                    <path d="M482-160q-134 0-228-93t-94-227v-7l-64 64-56-56 160-160 160 160-56 56-64-64v7q0 100 70.5 170T482-240q26 0 51-6t49-18l60 60q-38 22-78 33t-82 11Zm278-161L600-481l56-56 64 64v-7q0-100-70.5-170T478-720q-26 0-51 6t-49 18l-60-60q38-22 78-33t82-11q134 0 228 93t94 227v7l64-64 56 56-160 160Z" />
                                </svg>
                            </span>
                            <span class="">
                                <svg height="19px" viewBox="0 -960 960 960" width="19px" fill="#d1d5db">
                                    <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h357l-80 80H200v560h560v-278l80-80v358q0 33-23.5 56.5T760-120H200Zm280-360ZM360-360v-170l367-367q12-12 27-18t30-6q16 0 30.5 6t26.5 18l56 57q11 12 17 26.5t6 29.5q0 15-5.5 29.5T897-728L530-360H360Zm481-424-56-56 56 56ZM440-440h56l232-232-28-28-29-28-231 231v57Zm260-260-29-28 29 28 28 28-28-28Z" />
                                </svg>
                            </span>
                            <a href="{{ route('productsactive', $product->id) }}"
                                onclick="return confirm('Tem Certeza que Deseja (REATIVAR)?')">
                                <span class="" title="Reativar">
                                    <svg height="20px" viewBox="0 -960 960 960" width="20px" fill="#16a34a">
                                        <path d="M440-320h80v-166l64 62 56-56-160-160-160 160 56 56 64-62v166ZM280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520Zm-400 0v520-520Z" />
                                    </svg>
                                </span>
                            </a>
                        @endif
                    </div>
                </div>
            </form>

        </div>

    </div>

@empty
    <td>Lista Vazia</td>
@endforelse

@endsection

<script>
    function openForm() {
        document.querySelector('#open').classList.toggle('hidden')
    }
    openForm()
</script>

<script>
    function previewImage1() {
        var image1 = document.querySelector('#image1').files[0];
        var preview = document.getElementById('img1');
        var reader = new FileReader();
        reader.onloadend = function() {
            preview.src = reader.result;
        }
        if (image1) {
            reader.readAsDataURL(image1);
        } else {
            preview.src = "";
        }
    }

    function previewImage2() {
        var image2 = document.querySelector('#image2').files[0];
        var preview = document.getElementById('img2');
        var reader = new FileReader();
        reader.onloadend = function() {
            preview.src = reader.result;
        }
        if (image2) {
            reader.readAsDataURL(image2);
        } else {
            preview.src = "";
        }
    }

    function previewImage3() {
        var image3 = document.querySelector('#image3').files[0];
        var preview = document.getElementById('img3');
        var reader = new FileReader();
        reader.onloadend = function() {
            preview.src = reader.result;
        }
        if (image3) {
            reader.readAsDataURL(image3);
        } else {
            preview.src = "";
        }
    }

    function previewImage4() {
        var image4 = document.querySelector('#image4').files[0];
        var preview = document.getElementById('img4');
        var reader = new FileReader();
        reader.onloadend = function() {
            preview.src = reader.result;
        }
        if (image4) {
            reader.readAsDataURL(image4);
        } else {
            preview.src = "";
        }
    }

    function previewImage5() {
        var image5 = document.querySelector('#image5').files[0];
        var preview = document.getElementById('img5');
        var reader = new FileReader();
        reader.onloadend = function() {
            preview.src = reader.result;
        }
        if (image5) {
            reader.readAsDataURL(image5);
        } else {
            preview.src = "";
        }
    }
</script>
