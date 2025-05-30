@extends('layouts.app')
@section('title', 'Produtos')
@section('content')

<!DOCTYPE html>
<html>
<body>

@if (session()->has('success'))
    <span class="flex justify-center bg-green-200 text-green-700 text-sm m-2 py-1 rounded">{{ session()->get('success') }}</span>
@endif
<div class="flex justify-between items-center border py-1 px-2">
    <span class="font-bold"><span class=" text-red-700">EDITANDO PRODUTO</span> [{{ $product->title }}]</span>
    <a href="{{ route('productsread') }}" class="py-1 px-3 mb-1 text-xs text-center text-white bg-red-600 rounded">Voltar</a>
</div>
<hr class="mt-0.5 border">

{{-- EDITAR PRODUTO --}}
<form action="{{ route('productsupdate', $product->id) }}" method="POST" id="" class="text-xs" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    {{-- Card Título --}}
    <div class="pb-4 m-2 bg-white border border-blue-300 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <div class="flex items-center mt-3 px-2 space-x-2">
            <div class="w-4/12">
                <label for="category_id"><span class="font-semibold">:Categoria</span></label>
                <select name="category_id" id="category_id"
                    class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900">
                    <option value="{{ $categorynow->id }}">{{ $categorynow->category_name }}</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-4/12">
                <label for="brand_id"><span class="font-semibold">:Fabricante</span></label>
                <select name="brand_id" id="brand_id"
                    class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900">
                    <option value="{{ $brandnow->id }}">{{ $brandnow->brand_name }}</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-2/12">
                <label for="car_scale"><span class="font-semibold">:Escala</span></label>
                <select name="car_scale" id="car_scale" class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900">
                    <option value="{{ $product->car_scale }}">{{ $product->car_scale }}</option>
                    @foreach ($scales as $scale)
                        <option value="{{ $scale->scale_name }}">{{ $scale->scale_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-2/12">
                <label for="is_active"><span class="font-semibold">:Status</span></label>
                <select name="is_active" id="is_active" class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900">
                    <option value="{{ $product->is_active }}">{{ $product->is_active == 1 ? "Ativo" : "Inativo" }}</option>
                    <option value="{{ 1 }}">Ativo</option>
                    <option value="{{ 0 }}">Inativo</option>
                </select>
            </div>
        </div>
        <div class="flex items-center mt-3 px-2 space-x-2">
            <div class="w-full">
                <label for="title"><span class="font-semibold">:Título</span></label>
                <input class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900 placeholder-gray-300"
                    type="text" name="title" id="title" value="{{ $product->title }}">
            </div>
        </div>
    </div>
    {{-- Card Características do Produto --}}
    <div class="pb-4 m-2 bg-blue-50 border border-blue-300 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

        <div class="flex items-center mt-3 px-2 space-x-2">
            <div class="w-3/12">
                <label for="car_model"><span class="font-semibold">:Marca/Modelo</span></label>
                <input class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900 placeholder-gray-300"
                    type="text" name="car_model" id="car_model" value="{{ $product->car_model }}">
            </div>
            <div class="w-2/12">
                <label for="car_year"><span class="font-semibold">:Ano</span></label>
                <input class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900 placeholder-gray-300"
                    type="text" name="car_year" id="car_year" value="{{ $product->car_year }}">
            </div>
            <div class="w-2/12">
                <label for="car_color"><span class="font-semibold">:Cor</span></label>
                <select name="car_color" id="car_color" class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900">
                    <option value="{{ $product->car_color }}">{{ $product->car_color }}</option>
                    @foreach ($colors as $color)
                        <option value="{{ $color->color_name }}">{{ $color->color_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-2/12">
                <label for="car_attribute"><span class="font-semibold">:Atributo/Tipo</span></label>
                <select name="car_attribute" id="car_attribute" class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900">
                    <option value="{{ $product->car_attribute }}">{{ $product->car_attribute }}</option>
                    @foreach ($attributes as $attribute)
                        <option value="{{ $attribute->attribute_name }}">{{ $attribute->attribute_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-3/12">
                <label for="slug"><span class="font-semibold">:Slug</span></label>
                <input class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900 placeholder-gray-300"
                    type="text" name="slug" id="slug" value="{{ $product->slug }}">
            </div>
        </div>
        <div class="flex items-center mt-3 px-2 space-x-2">
            <div class="w-3/12">
                <label for="sku"><span class="font-semibold">:SKU</span></label>
                <input class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900 placeholder-gray-300"
                    type="text" name="sku" id="sku" value="{{ $product->sku }}">
            </div>
            <div class="w-3/12">
                <label for="barcode"><span class="font-semibold">:Código de Barras</span></label>
                <input class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900 placeholder-gray-300"
                    type="text" name="barcode" id="barcode" value="{{ $product->barcode }}">
            </div>
            <div class="w-2/12">
                <label for="stock"><span class="font-semibold">:Estoque</span></label>
                <input class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900 placeholder-gray-300"
                    type="text" name="stock" id="stock" value="{{ $product->stock }}">
            </div>
            <div class="w-2/12">
                <label for="editprice_normal"><span class="font-semibold">:Preço</span></label>
                <input class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900 placeholder-gray-300"
                    type="text" name="price_normal" id="editprice_normal" value="{{ old('price_normal', isset($product->price_normal) ? number_format($product->price_normal, '2', ',', '.') : '') }}">
            </div>
            <div class="w-2/12">
                <label for="editprice_sale"><span class="font-semibold">:Preço Promocional</span></label>
                <input class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900 placeholder-gray-300"
                    type="text" name="price_sale" id="editprice_sale" value="{{ old('price_sale', isset($product->price_sale) ? number_format($product->price_sale, '2', ',', '.') : '') }}">
            </div>
        </div>
        <div class="flex items-center mt-3 px-2 space-x-2">
            <div class="w-full">
                <label for="description"><span class="font-semibold">:Descrição</span></label>
                <input class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900 placeholder-gray-300"
                    type="text" name="description" id="description" value="{{ $product->description }}">
            </div>
        </div>
        <div class="flex justify-center items-center mt-3 space-x-3">
            <span>Produto em:</span>
            <div class="flex">
                <input name="is_featured" id="is_featured" type="checkbox" value="{{ 1 }}" @checked($product->is_featured == 0 ? false : true) @disabled($product->is_active == 1 ? false : true)>
                <label for="is_featured" class="ps-1">em Destaque</label>
            </div>
            <div class="flex">
                <input name="on_sale" id="on_sale" type="checkbox" value="{{ 1 }}" @checked($product->on_sale == 0 ? false : true) @disabled($product->is_active == 1 ? false : true)>
                <label for="on_sale" class="ps-1">em Promoção</label>
            </div>
            <div class="flex">
                <input name="is_preorder" id="is_preorder" type="checkbox" value="{{ 1 }}" @checked($product->is_preorder == 0 ? false : true) @disabled($product->is_active == 1 ? false : true)>
                <label for="is_preorder" class="ps-1">em Pre-Order</label>
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
                    <input type="file" name="image1" id="image1" value="{{ $product->image1 }}" onchange="previewImage1()" class="hidden"/>
                    <div class="absolute flex items-center top-0 h-[216px]">
                        <img src="{{ asset("storage/{$product->image1}") }}" class="p-1">
                        <img id="img1" class="absolute p-1">
                    </div>
                </label>
            </div>
            <div class="h-[220px] w-[175px] bg-gray-100 border-2 border-blue-300 border-dashed rounded">
                <label for="image2" class="cursor-pointer relative">
                    <div class="flex flex-col items-center justify-center py-16">
                        <p class="text-4xl py-1">&#128228;</p>
                        <p class="text-sm text-gray-500">Click to Upload</p>
                        <p class="text-sm text-gray-400">Opcional</p>
                    </div>
                    <input type="file" name="image2" id="image2" value="{{ $product->image2 }}" onchange="previewImage2()" class="hidden" />
                    <div class="absolute flex items-center top-0 h-[216px]">
                        <img src="{{ asset("storage/{$product->image2}") }}" class="p-1">
                        <img id="img2" class="absolute p-1">
                    </div>
                </label>
            </div>
            <div class="h-[220px] w-[175px] bg-gray-100 border-2 border-blue-300 border-dashed rounded">
                <label for="image3" class="cursor-pointer relative">
                    <div class="flex flex-col items-center justify-center py-16">
                        <p class="text-4xl py-1">&#128228;</p>
                        <p class="text-sm text-gray-500">Click to Upload</p>
                        <p class="text-sm text-gray-400">Opcional</p>
                    </div>
                    <input type="file" name="image3" id="image3" value="{{ $product->image3 }}" onchange="previewImage3()" class="hidden" />
                        <div class="absolute flex items-center top-0 h-[216px]">
                            <img src="{{ asset("storage/{$product->image3}") }}" class="p-1">
                            <img id="img3" class="absolute p-1">
                        </div>
                </label>
            </div>
            <div class="h-[220px] w-[175px] bg-gray-100 border-2 border-blue-300 border-dashed rounded">
                <label for="image4" class="cursor-pointer relative">
                    <div class="flex flex-col items-center justify-center py-16">
                        <p class="text-4xl py-1">&#128228;</p>
                        <p class="text-sm text-gray-500">Click to Upload</p>
                        <p class="text-sm text-gray-400">Opcional</p>
                    </div>
                    <input type="file" name="image4" id="image4" value="{{ $product->image4 }}" onchange="previewImage4()" class="hidden" />
                    <div class="absolute flex items-center top-0 h-[216px]">
                        <img src="{{ asset("storage/{$product->image4}") }}" class="p-1">
                        <img id="img4" class="absolute p-1">
                    </div>
                </label>
            </div>
            <div class="h-[220px] w-[175px] bg-gray-100 border-2 border-blue-300 border-dashed rounded">
                <label for="image5" class="cursor-pointer relative">
                    <div class="flex flex-col items-center justify-center py-16">
                        <p class="text-4xl py-1">&#128228;</p>
                        <p class="text-sm text-gray-500">Click to Upload</p>
                        <p class="text-sm text-gray-400">Opcional</p>
                    </div>
                    <input type="file" name="image5" id="image5" value="{{ $product->image5 }}" onchange="previewImage5()" class="hidden" />
                    <div class="absolute flex items-center top-0 h-[216px]">
                        <img src="{{ asset("storage/{$product->image5}") }}" class="p-1">
                        <img id="img5" class="absolute p-1">
                    </div>
                </label>
            </div>

        </div>

    </div>

    <div class="px-2">
        <button type="submit" class="w-full px-2 py-1 mt-3 text-center text-white bg-sky-700 rounded hover:bg-sky-800">Salvar Edição Produto</button>
    </div>
</form>

<script>
    let editpriceNormal = document.getElementById('editprice_normal');
    editpriceNormal.addEventListener('input', function(){
        let editnormalValue = this.value.replace(/[^\d]/g, '');
        var formattedValue = (editnormalValue.slice(0, -2).replace(/\B(?=(\d{3})+(?!\d))/g, '.')) + '' + editnormalValue.slice(-2);
        formattedValue = formattedValue.slice(0, -2) + ',' + formattedValue.slice(-2);
        this.value = formattedValue;
    });
    let editpriceSale = document.getElementById('editprice_sale');
    editpriceSale.addEventListener('input', function(){
        let editsaleValue = this.value.replace(/[^\d]/g, '');
        var formattedValue = (editsaleValue.slice(0, -2).replace(/\B(?=(\d{3})+(?!\d))/g, '.')) + '' + editsaleValue.slice(-2);
        formattedValue = formattedValue.slice(0, -2) + ',' + formattedValue.slice(-2);
        this.value = formattedValue;
    });
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

</body>
</html>

@endsection
