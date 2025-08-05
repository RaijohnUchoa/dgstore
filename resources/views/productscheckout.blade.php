@extends('layouts.app')
@section('title', 'CheckoutProdutos')
@section('content')

    @if(session()->has('success'))
        <span class="flex justify-center bg-green-200 text-green-700 text-xs m-2 py-1 rounded">{{ session()->get('success') }}</span>
    @endif

    <div class="flex justify-between items-center border py-1 px-2">
        <span class="font-semibold">CHECKOUT</span>
        <a href="{{ url('/') }}" class="py-1 px-3 mb-1 text-xs text-center text-white bg-red-600 rounded">Voltar</a>
    </div>

    <div class="p-1">

        <div class="relative flex justify-between rounded text-sm">
            
            
            {{-- CARRINHO CHECKOUT --}}
            <div class="w-3/4 p-1 border rounded">

                @php $sum = 0 @endphp

                @foreach ($carts as $cart)

                    <div class="h-[65px] mt-1 bg-gray-50 border shadow rounded">

                        {{-- <div class="relative flex p-1"> --}}
                        <div class="flex p-1">

                            <div class="flex items-center">
                                <a href="{{ route('productsdetails', $cart->product_id) }}"><img class="max-h-[60px] w-[40px]" src="{{ asset("storage/{$cart->image1}") }}"></a>
                            </div>
                            <div class="w-4/5 px-1">
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
                                <span class="px-1">
                                    <svg class="rounded bg-white" height="14px" viewBox="0 -960 960 960" width="14px" fill="#ef4444">
                                        <path d="m376-300 104-104 104 104 56-56-104-104 104-104-56-56-104 104-104-104-56 56 104 104-104 104 56 56Zm-96 180q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520Zm-400 0v520-520Z" />
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>

                    @php $sum = $sum + ($cart->price_cart * $cart->quantity) @endphp

                @endforeach

                <div class="flex justify-between mt-1 px-2 py-1 border font-bold text-blue-900 shadow shadow-gray-200">
                    <span class="">Total Produtos</span>
                    <span class="">R$ {{ number_format($sum, '2', ',', '.') }}</span>
                </div>
                    
            </div>

            {{-- @if ($product->stock > 0)
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
            @endif --}}

        </div>

    </div>

    <div class="mt-4 bg-gray-800 text-center rounded">
        <span class="text-gray-100 font-semibold">PRODUTOS</span>
    </div>

@endsection


