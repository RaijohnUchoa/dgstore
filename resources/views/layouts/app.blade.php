<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MyDGS')</title>
    @vite('resources/css/app.css')
</head>

<body>

    <div class="container m-auto max-w-[1280px] text-gray-300 shadow p-1 grid grid-cols-10 gap-2 select-none">
        {{-- NAVTOP --}}
        <div class="header col-span-10 bg-green-400">
            @php
                if (Auth::check()) {
                    $user = Str::of(Auth::user()->name)->explode(' ');
                    $user = $user[0];
                } else {
                    $user = 'Visitante!';
                }
            @endphp
            <x-header :user="$user"></x-header>
        </div>

        {{-- SLIDER --}}
        <div class="slider flex justify-between items-center shadow py-6 col-span-10">
            <div><<>></div>

            <div class="w-[350px]">
                <img src="{{ asset('LogoDGS.png') }}" alt="LOGO" />
            </div>

            {{-- Mostrar Carrinho --}}
            @if ($user != 'Visitante!' and Auth::user()->type > 0)
                <a href="{{ route('productscheckout') }}">
                    <div class="mt-28 -mb-8">
                        @php $sum = 0; @endphp
                        @foreach ($carts as $cart)
                            @php $sum = $sum + ($cart->price_cart * $cart->quantity) @endphp
                        @endforeach
                        <div class="relative pl-1 pr-2 bg-gray-800 border border-red-200 rounded">
                            <span>
                                <button title="incluir no carrinho" class="text-lg">&#128722;</button>
                            </span>
                            <span class="absolute left-2 -top-1.5 bg-red-600 text-[10px] px-1 text-gray-50 rounded-full">
                                {{ $carts->sum('quantity') }}
                            </span>
                            <span class="text-xs text-gray-300 font-semibold">
                                R${{ number_format($sum, '2', ',', '.') }}
                            </span>
                        </div>
                    </div>
                </a>
            @else
                <div><<>></div>
            @endif

        </div>

        {{-- MENU PRINCIPAL --}}
        <div class="navmenu shadow col-span-10">
            <x-menu :user="$user" :brands="$brands"></x-menu>
        </div>

        {{-- SIDEBAR --}}
        <div class="sidebar border shadow xl:w-[250px] col-span-2 bg-gray-100">
            @if (Auth::check())
                @if (Auth::user()->type == 0)
                    <x-sidebar :user="$user"></x-sidebar>
                @else
                    <x-sidebar :user="$user" :categories="$categories" :brands="$brands" :scales="$scales" :filter="$filter"></x-sidebar>
                @endif
            @else
                <x-sidebar :user="$user" :categories="$categories" :brands="$brands" :scales="$scales" :filter="$filter"></x-sidebar>
            @endif
        </div>

        {{-- MAIN --}}
        <div class="main border shadow text-gray-600 col-span-8">
            @yield('content')

            @if (Auth::check() and Auth::user()->type == 0)

                @if (Request::is('login'))
                    {{-- DASHBOARD --}}
                    <div class="dashboard mt-6 px-6 gap-6 flex justify-center">
                        <div class="w-4/12 text-center text-gray-700 font-bold border-2 border-gray-600 rounded p-2">
                            <p class="text-xl">USUÁRIOS</p>
                            <p class="text-2xl">[{{ count($users) }}]</p>
                        </div>
                        <div class="w-4/12 text-center text-green-700 font-bold border-2 border-green-600 rounded p-2">
                            <p class="text-xl">FORNECEDORES</p>
                            <p class="text-2xl">[{{ count($suppliers) }}]</p>
                        </div>
                        <div class="w-4/12 text-center text-orange-700 font-bold border-2 border-orange-600 rounded p-2">
                            <p class="text-xl">CATEGORIAS</p>
                            <p class="text-2xl">[{{ count($categories) }}]</p>
                        </div>
                    </div>
                    <div class="dashboard mt-6 px-6 gap-6 flex justify-center">
                        <div class="w-4/12 text-center text-red-700 font-bold border-2 border-red-600 rounded p-2">
                            <p class="text-xl">MARCAS</p>
                            <p class="text-2xl">[{{ count($brands) }}]</p>
                        </div>
                        <div class="w-4/12 text-center text-purple-700 font-bold border-2 border-purple-600 rounded p-2">
                            <p class="text-xl">ESCALAS</p>
                            <p class="text-2xl">[{{ count($scales) }}]</p>
                        </div>
                        <div class="w-4/12 text-center text-blue-700 font-bold border-2 border-blue-600 rounded p-2">
                            <p class="text-xl">PRODUTOS</p>
                            <p class="text-2xl">[{{ count($products) }}]</p>
                        </div>
                        {{-- <div class="w-4/12 text-center text-green-700 font-bold border-2 border-green-600 rounded p-2">
                            <p class="text-xl">PROMOÇÃO</p>
                            <p class="text-2xl">[{{ count($productsonsale) }}]</p>
                        </div> --}}
                    </div>

                @endif

            @endif
            
            {{-- @dd($carts) --}}
            @if (($user == 'Visitante!' or Auth::user()->type > 0) and (!Request::is('information')))

                <div class="flex-wrap flex justify-around items-center gap-2 p-1">
                    
                    @if (count($products))

                        @foreach ($products as $product)

                            <div class="relative w-[245px] rounded shadow hover:shadow-xl mt-2">

                                <a href="{{ route('productsdetails', $product->id) }}">

                                    <div class="flex justify-center items-center p-1 h-[280px]">
                                        <img src="{{ asset("storage/{$product->image1}") }}" class="max-h-[280px] rounded p-1">
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

                                    <div class="flex items-center justify-between text-[11px] px-2">
                                        <span class="text-gray-500">{{ $product->sku }}</span>
                                        <span class="text-gray-500">{{ $product->category_name }}</span>
                                    </div>
                                    <div class="px-2">
                                        <div class="border-b flex justify-center items-center h-16">
                                            <span class="text-sky-800 text-center text-sm">{{ $product->title }}</span>
                                        </div>
                                        <div class="flex items-center justify-between text-[11px]">
                                            <span class="text-gray-500">Escala: {{ $product->car_scale }}</span>
                                            <span class="text-gray-500">{{ $product->brand_name }}</span>
                                        </div>

                                        @if ($product->stock > 0)
                                            @if ($product->price_sale == 0)
                                                <div class="py-2 flex items-center justify-center text-xs">
                                                    <span class="font-semibold text-blue-800 text-base border px-2 rounded">R$ {{ old('price_normal', isset($product->price_normal) ? number_format($product->price_normal, '2', ',', '.') : '') }}</span>
                                                </div>
                                            @else
                                                <div class="py-2 flex items-center justify-between text-xs">
                                                    <span class="line-through opacity-50">R$ {{ old('price_normal', isset($product->price_normal) ? number_format($product->price_normal, '2', ',', '.') : '') }}</span>
                                                    <span class="font-semibold text-pink-800 text-base">R$ {{ old('price_normal', isset($product->price_sale) ? number_format($product->price_sale, '2', ',', '.') : '') }}</span>
                                                </div>
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
                                </a>
                                {{-- ADICIONA NO CART --}}
                                <form action="{{ route('productscartcreate', $product->id) }}" method="POST" id="" class="text-xs">
                                    @csrf
                                    <div class="flex justify-center items-center text-blue-700 font-semibold space-x-1 pb-3">
                                        <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="price_cart" id="price_cart" value="{{ $product->price_sale == 0 ? $product->price_normal : $product->price_sale }}">
            
                                        {{-- <span class="w-9 bg-gray-100 border text-center py-2 shadow rounded-full">+{{ $product->stock }}</span> --}}
                                        <input class="w-12 border text-center px-2 py-2 shadow rounded" name="quantity" type="hidden" value="{{ $product->stock > 0 ? 1 : 0 }}" @disabled($product->stock > 0 ? false : true)>
            
                                        @if ($product->stock > 0)
                                            @if ($product->is_preorder == 1)
                                                <input type="hidden" name="preorder" id="preorder" value="{{ 1 }}">
                                                <button type="submit" title="encomendar" class="px-2 py-1 hover:bg-gray-200 shadow shadow-gray-400 rounded text-base">&#128722;<span class="text-sm text-red-500">Pre-Order</span></button>
                                            @else
                                                <input type="hidden" name="preorder" id="preorder" value="{{ 0 }}">
                                                <button type="submit" title="incluir no carrinho" class="px-2 py-1 hover:bg-gray-200 shadow shadow-gray-400 rounded text-base @if ($carts->contains('product_id', $product->id)) ? border border-green-700 : '' @endif">
                                                    &#128722;<span class="text-sm">add to Cart</span>
                                                </button>
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
                                        @if ($carts->contains('product_id', $product->id))
                                            <span class="text-green-700 text-2xl">&#128504;</span>
                                        @endif
                                    </div>
                                </form>
                            </div>

                        @endforeach

                    @else

                        <span class="mt-5">{{ $filter.' Em breve produtos aqui...' }}</span>

                    @endif
                </div>

            @endif

            {{-- ============================================================================================== --}}
            {{-- <div class="m-2">
                <div class="">
                    <span class="px-2 bg-sky-300 text-sky-700 text-3xl rounded" id="contador">00:00:00</span>
                </div>
                <div class="my-2">
                    <input type="number" id="valor" value=11>
                    <button class="px-2 bg-green-300 rounded" id="start">LANCE</button>
                </div>
            </div> --}}
            {{-- ============================================================================================== --}}

        </div>

        {{-- ANUNCIOS/OFERTAS --}}
        @if ($user == 'Visitante!' or Auth::user()->type > 0)

            <div class="news shadow h-[240px] col-span-10 text-center">
                <div class="mt-2 bg-red-700 rounded">
                    <span class="text-gray-100 font-semibold">PRODUTOS EM OFERTA</span>
                </div>
                <div class="flex-wrap flex justify-around items-center gap-2 p-1 my-2">

                    @foreach ($productsonsale as $product)

                        <div class="relative h-[190px] w-[140px] rounded shadow hover:shadow-xl">

                            <div class="flex justify-center items-center p-1">
                                <img src="{{ asset("storage/{$product->image1}") }}" class="h-[140px] rounded p-1">
                            </div>
                            <div class="px-2">
                                <div class="flex justify-center items-center">
                                    <span class="text-sky-800 text-center text-xs">{{ $product->title }}</span>
                                </div>
                                <div class="py-2 ml-3 absolute top-12 w-24 -rotate-45">
                                    <span class="font-bold text-red-700 text-md bg-opacity-70 bg-sky-50 rounded shadow-md px-1">{{ old('price_normal', isset($product->price_sale) ? number_format($product->price_sale, '2', ',', '.') : '') }}</span>
                                </div>
                            </div>
                            <div class="absolute top-0 ml-3 rounded">
                                <button title="incluir no carrinho" class="bg-white hover:bg-gray-200 shadow shadow-gray-700 rounded">&#128722;</button>
                            </div>

                        </div>

                    @endforeach

                </div>
            </div>

        @endif

        {{-- FOOTER --}}
        <div class="footer shadow flex  justify-center items-center text-center h-[100px] col-span-10">
            <x-footer></x-footer>
        </div>

    </div>

    <script>
        const tempo = document.querySelector('#valor');
        const btnStart = document.querySelector('#start');
        var tempo_atual, relogio;
        btnStart.addEventListener('click', function() {
            start();
        });
        function start() {
            if (tempo.value != '' && tempo.value != '0') {
                const valor = parseInt(tempo.value);
                if (valor > 0) {
                    tempo_atual = valor;
                    if (relogio) {
                        clearInterval(relogio);
                    }
                    relogio = setInterval(contar, 1000);
                } else {
                    alert("Informe um valor maior que zero!");
                }
            } else {
                alert("Informe um número válido!");
            }
        }
        function contar() {
            tempo_atual--;
            if (tempo_atual >= 0) {
                let horas, minutos, segundos;
                horas = Math.floor(tempo_atual / 3600);
                minutos = Math.floor((tempo_atual - horas * 3600) / 60);
                segundos = tempo_atual - horas * 3600 - minutos * 60;
                if (horas < 10) {
                    horas = "0" + horas;
                }
                if (minutos < 10) {
                    minutos = "0" + minutos;
                }
                if (segundos < 10) {
                    segundos = "0" + segundos;
                }
                document.querySelector('#contador').innerHTML = "<span>" + horas + ":" + minutos + ":" + segundos +
                    "</span>";
            } else {
                clearInterval(relogio);
                // alert("Parou!");
                document.querySelector('#contador').innerHTML = "<span>" + "Você Venceu!!" + "</span>";

            }
        }
    </script>

</body>

</html 
