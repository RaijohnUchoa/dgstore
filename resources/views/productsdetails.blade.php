@extends('layouts.app')
@section('title', 'DetalhesProdutos')
@section('content')

    @if(session()->has('success'))
        <span class="flex justify-center bg-green-200 text-green-700 text-xs m-2 py-1 rounded">{{ session()->get('success') }}</span>
    @endif

    <div class="flex justify-between items-center border py-1 px-2">
        <span class="font-semibold">DETALHES DO PRODUTO</span>
        <a href="{{ url('/') }}" class="py-1 px-3 mb-1 text-xs text-center text-white bg-red-600 rounded">Voltar</a>
    </div>
    {{-- <hr class="mt-0.5 border"> --}}

    <div class="p-1">

        <div class="relative flex justify-between rounded text-xs">
            
            <div class="w-3/4 flex rounded border text-xs">

                {{-- IMAGENS --}}
                <div class="w-1/2 flex items-center border-r border-gray-100">
                    <div class="p-1">
                        <img src="{{ asset("storage/{$product->image1}") }}" class="rounded mb-1">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('productsdetailsimage', [$product->id, 2]) }}">
                                <img src="{{ $product->image2 != null ? asset("storage/{$product->image2}") : '' }}" class="{{ $product->image2 != null ? 'w-[80px] p-1 rounded border' : '' }}">
                            </a>
                            <a href="{{ route('productsdetailsimage', [$product->id, 3]) }}">
                                <img src="{{ $product->image3 != null ? asset("storage/{$product->image3}") : '' }}" class="{{ $product->image3 != null ? 'w-[80px] p-1 rounded border' : '' }}">
                            </a>
                            <a href="{{ route('productsdetailsimage', [$product->id, 4]) }}">
                                <img src="{{ $product->image4 != null ? asset("storage/{$product->image4}") : '' }}" class="{{ $product->image4 != null ? 'w-[80px] p-1 rounded border' : '' }}">
                            </a>
                            <a href="{{ route('productsdetailsimage', [$product->id, 5]) }}">
                                <img src="{{ $product->image5 != null ? asset("storage/{$product->image5}") : '' }}" class="{{ $product->image5 != null ? 'w-[80px] p-1 rounded border' : '' }}">
                            </a>
                        </div>
                    </div>
                </div>
                {{-- DADOS --}}
                <div class="w-1/2 p-2">
                    <p class="text-blue-700 text-sm font-semibold">#{{ $product->title }}</p>
                    <div class="text-center mt-7">
                        @if ($product->stock > 0)
                            @if ($product->price_sale == 0)
                                <p class="font-semibold text-blue-800 text-sm"><span class="border-b border-blue-800 px-2 py-1 rounded">R$ {{ old('price_normal', isset($product->price_normal) ? number_format($product->price_normal, '2', ',', '.') : '') }}</span></p>
                            @else
                                <p class="line-through opacity-50 text-sm py-1">R$ {{ old('price_normal', isset($product->price_normal) ? number_format($product->price_normal, '2', ',', '.') : '') }}</p>
                                <p class="font-semibold text-pink-800 text-sm"><span class="border-b border-red-800 px-2 py-1 rounded">R$ {{ old('price_normal', isset($product->price_sale) ? number_format($product->price_sale, '2', ',', '.') : '') }}</span></p>
                            @endif
                        @else
                            @if ($product->is_preorder == 1)
                                @if ($product->price_normal != 0)
                                    <div class="py-2 flex items-center justify-center text-xs">
                                        <span class="font-semibold text-blue-800 text-base border px-2 rounded">R$ {{ old('price_normal', isset($product->price_normal) ? number_format($product->price_normal, '2', ',', '.') : '') }}</span>
                                    </div>
                                @else
                                    <div class="py-2 flex items-center justify-center text-xs">
                                        <span class="text-gray-400 text-sm border px-2 rounded">Preço em Breve</span>
                                    </div>
                                @endif
                            @else
                                <div class="py-2 flex items-center justify-center text-xs">
                                    <span class="text-gray-50 border px-2 py-1 rounded-r-full bg-gray-700">ESGOTADO<em class="text-[15px]">!</em></span>
                                </div>
                            @endif

                        @endif
                    </div>
                    <hr class="mt-7">

                    {{-- ADICIONAR NO CARRINHO --}}
                    <form action="{{ route('productscartcreate', $product->id) }}" method="POST" id="" class="text-xs">
                        @csrf
                        <div class="flex justify-center items-center text-blue-700 font-semibold space-x-1 mt-3">
                            <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="price_cart" id="price_cart" value="{{ $product->price_sale == 0 ? $product->price_normal : $product->price_sale }}">

                            <span class="w-9 bg-gray-100 border text-center py-2 shadow rounded-full">+{{ $product->stock }}</span>
                            <input class="w-12 border text-center px-2 py-2 shadow rounded" name="quantity" type="number" value="{{ $product->stock > 0 ? 1 : 0 }}" @disabled($product->stock > 0 ? false : true)>

                            @if ($product->stock > 0)
                                @if ($product->is_preorder == 1)
                                    <input type="hidden" name="preorder" id="preorder" value="{{ 1 }}">
                                    <button type="submit" title="encomendar" class="px-2 py-1 hover:bg-gray-200 shadow shadow-gray-400 rounded text-base">&#128722;<span class="text-sm text-red-500">Pre-Order</span></button>
                                @else
                                    <input type="hidden" name="preorder" id="preorder" value="{{ 0 }}">
                                    <button type="submit" title="incluir no carrinho" class="px-2 py-1 hover:bg-gray-200 shadow shadow-gray-400 rounded text-base">&#128722;<span class="text-sm">add to Cart</span></button>
                                @endif
                            @else
                                @if ($product->is_preorder == 1)
                                    <input type="hidden" name="preorder" id="preorder" value="{{ 1 }}">
                                    <button type="submit" title="encomendar" class="px-2 py-1 hover:bg-gray-200 shadow shadow-gray-400 rounded text-base">&#128722;<span class="text-sm text-red-500">Pre-Order</span></button>
                                @else
                                    <input type="hidden" name="preorder" id="preorder" value="{{ 0 }}">
                                    <span title="encomendar" class="px-2 py-1 shadow shadow-gray-400 rounded text-sm text-gray-400">&#128722;<span class="">Pre-Order</span></span>
                                @endif
                            @endif
                        </div>
                    </form>

                    <hr class="my-3">
                    <div class="my-3">
                        <p class="py-1">Categoria: <strong>{{ $categorynow->category_name }}</strong></p>
                        <p class="py-1">Marca: <strong>{{ $brandnow->brand_name }}</strong></p>
                        <p class="py-1">Escala: <strong>{{ $product->car_scale }}</strong></p>
                        <p class="py-1">Modelo: <strong>{{ $product->car_model }}</p></strong>
                        <p class="py-1">Ano: <strong>{{ $product->car_year }}</strong></p>
                        <p class="py-1">Cor: <strong>{{ $product->car_color }}</strong></p>
                        <p class="py-1">Tipo: <strong>{{ $product->car_attribute }}</strong></p>
                        <p class="py-1">Estoque: <strong>{{ $product->stock == 1 ? 'Único' : $product->stock }}</strong></p>
                        <p class="py-1">SKU: <strong>{{ $product->sku }}</strong></p>
                        <p class="py-1">Código Barra: <strong>{{ $product->barcode }}</strong></p>
                        <p class="py-1 mt-3">Descrição:</p>
                        <p class=""><strong>{{ $product->description }}</strong></p>
                    </div>
                </div>
            </div>
            {{-- CARRINHO LATERAL --}}
            <div class="w-1/4 p-1 border rounded">

                @if (Auth::check())
                    @php
                        $sum = 0;
                        $carts = DB::table('carts')
                        ->join('products', 'carts.product_id', '=', 'products.id')
                        ->select('carts.*', 'products.title', 'products.image1')
                        ->where(['carts.user_id' => Auth::user()->id])
                        ->orderBy('id', 'DESC')
                        ->get();
                    @endphp
                    <a href="{{ route('productscheckout') }}">
                        <div class="px-2 mt-1 text-center text-blue-900 border border-red-100 bg-red-100 rounded shadow shadow-red-200">
                            <span class="text-base">&#128722;</span>
                            <span class="font-semibold">Checkout Carrinho</span>
                        </div>
                    </a>
                    @foreach ($carts as $cart)

                        <div class="mt-1 bg-gray-50 border shadow rounded">

                            <div class="relative flex p-1 h-[65px]">

                                <div class="flex items-center w-1/5 max-h-[65px]">
                                    <a href="{{ route('productsdetails', $cart->product_id) }}"><img class="max-h-[60px]" src="{{ asset("storage/{$cart->image1}") }}"></a>
                                </div>
                                <div class="w-4/5 text-[10px] px-1">
                                    <div class="h-1/2">
                                        <span class="text-blue-900">{{ $cart->title }}</span>
                                    </div>
                                    <div class="h-1/2 flex items-end justify-between">
                                        <span>Unidade(s): <strong class="text-red-900">{{ $cart->quantity }}</strong></span>
                                        <span>x</span>
                                        <span>Preço: <strong class="text-blue-900">R$ {{ number_format($cart->price_cart * $cart->quantity, '2', ',', '.') }}</strong></span>
                                    </div>
                                </div>

                                <a href="{{ route('productscartdelete', $cart->id) }}">
                                    <span class="absolute top-0 left-[-4px] px-1">
                                        <svg class="rounded bg-white" height="14px" viewBox="0 -960 960 960" width="14px" fill="#ef4444">
                                            <path d="m376-300 104-104 104 104 56-56-104-104 104-104-56-56-104 104-104-104-56 56 104 104-104 104 56 56Zm-96 180q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520Zm-400 0v520-520Z" />
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                        @php $sum = $sum + ($cart->price_cart * $cart->quantity) @endphp

                    @endforeach
                    <div class="flex justify-between mt-1 px-2 py-1 border text-[10px] font-bold text-blue-900 shadow shadow-gray-200">
                        <span class="">Total Produtos</span>
                        <span class="">R$ {{ number_format($sum, '2', ',', '.') }}</span>
                    </div>
                    <a href="{{ route('productscheckout') }}">
                        <div class="px-2 mt-1 text-center text-blue-900 border border-red-100 bg-red-100 rounded shadow shadow-red-200">
                            <span class="text-base">&#128722;</span>
                            <span class="font-semibold">Checkout Carrinho</span>
                        </div>
                    </a>
                @endif
                    
            </div>

            @if ($product->stock > 0)
                @if ($product->is_preorder == 1)
                    <span class="absolute py-1 px-1 top-1 bg-green-700 text-gray-50 text-[10px] font-semibold rounded-r-full">Pre-Order</span>
                @elseif ($product->on_sale == 1)
                    <span class="absolute py-1 px-1 top-1 bg-red-700 text-gray-50 text-[10px] font-semibold rounded-r-full">OFERTA</span>
                @endif
            @else
                @if ($product->is_preorder == 1)
                    <span class="absolute py-1 px-1 top-1 bg-green-700 text-gray-50 text-[10px] font-semibold rounded-r-full">Pre-Order</span>
                @else
                    <span class="absolute py-1 px-1 top-1 bg-slate-700 text-gray-50 text-[10px] font-semibold rounded-r-full">ESGOTADO!</span>
                @endif
            @endif

        </div>

    </div>

    <div class="mt-4 bg-gray-800 text-center rounded">
        <span class="text-gray-100 font-semibold">PRODUTOS</span>
    </div>

@endsection


