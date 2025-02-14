<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MyDGS')</title>
    @vite('resources/css/app.css')
</head>

<body>

    <div class="container m-auto max-w-[1280px] bg-gray-50 text-gray-300 shadow p-1 grid grid-cols-10 gap-2 select-none">
        {{-- NAVTOP --}}
        <div class="header col-span-10">
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
        <div class="slider flex justify-center items-center shadow py-6 col-span-10">
            <div class="w-[350px]">
                <img src="{{ asset('LogoDGS.png') }}" alt="LOGO" />
            </div>
        </div>

        {{-- MENU PRINCIPAL --}}
        <div class="navmenu shadow col-span-10">
            <x-menu :brands="$brands"></x-menu>
        </div>
        {{-- SIDEBAR --}}
        <div class="sidebar border shadow w-[250px] col-span-2">
            @if (Auth::check())
                @if (Auth::user()->type == 0)
                    <x-sidebar></x-sidebar>
                @else
                    <x-sidebar :categories="$categories" :brands="$brands" :scales="$scales"></x-sidebar>
                @endif

            @else
                <x-sidebar :categories="$categories" :brands="$brands" :scales="$scales"></x-sidebar>
            @endif
        </div>

        {{-- MAIN --}}

        <div class="main border shadow bg-gray-50 text-gray-600 col-span-8">
            @yield('content')

            @if ($user == 'Visitante!' or Auth::user()->type > 0)

                <div class="flex-wrap flex justify-around items-center gap-2 p-1">
                    @foreach ($products as $product)
                        {{-- <div class="h-[488px] w-[245px] rounded transform transition-all hover:-translate-y-2 duration-300 shadow-lg hover:shadow-2xl"> --}}
                        <div class="h-[489px] w-[245px] rounded shadow hover:shadow-xl">
                            <div class="flex justify-center items-center p-1">
                                <img src="{{ asset("storage/{$product->image1}") }}" class="h-[280px] rounded p-1">
                            </div>
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
                                <div class="py-3 flex items-center justify-between text-xs">
                                    <span class="line-through opacity-50">R$ {{ $product->price_normal }}</span>
                                    <span class="px-2 py-1 font-semibold bg-yellow-400 text-red-600 rounded-s-2xl">R$ {{ $product->price_normal - $product->price_sale }}</span>
                                    <span class="font-semibold text-sky-800 text-base">R$ {{ $product->price_sale }}</span>
                                </div>
                            </div>
                            <div class="shadow py-3 flex items-center justify-around rounded">
                                {{-- <button class="px-3 py-2 text-xs rounded-lg bg-sky-700 hover:bg-sky-800 text-white font-semibold">Buy Now</button> --}}
                                <button class="px-3 py-2 bg-sky-600 hover:bg-sky-800 shadow shadow-sky-800 rounded-lg text-white text-xs font-semibold">Buy Now</button>
                                <button class="px-2 py-1 bg-gray-50 hover:bg-gray-200 shadow shadow-gray-400 rounded-lg">&#128722;</button>
                                <button class="px-2 py-1 bg-gray-50 hover:bg-gray-200 shadow shadow-gray-400 rounded-lg">&#128150;</button>
                            </div>
                        </div>
                    @endforeach
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

        {{-- ANUNCIOS --}}
        <div class="news shadow h-[200px] col-span-10">
            NEWS
        </div>

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
