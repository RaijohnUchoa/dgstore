<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield("title", "MyDGS")</title>
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
        <img src="{{ asset("LogoDGS.png") }}" alt="LOGO"/>
      </div>
    </div>

    {{-- MENU PRINCIPAL --}}
    <div class="navmenu shadow col-span-10">
        <x-menu></x-menu>
    </div>
    {{-- SIDEBAR --}}
    <div class="sidebar border shadow w-[250px] col-span-2">
        <x-sidebar></x-sidebar>
    </div>

    {{-- MAIN --}}

    <div class="main border shadow bg-gray-50 text-gray-600 col-span-8">
      @yield('content')

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

      {{-- <div class="py-1 w-full gap-3 flex-wrap flex justify-center items-center">

        <div class="w-60 bg-white rounded transform transition-all hover:-translate-y-2 duration-300 shadow-lg hover:shadow-2xl">
          <img class="p-1 object-cover rounded-xl" src="https://www.mjtoysinc.com/wp-content/uploads/2023/12/JLCP7463-24.jpg" alt="">
          <p class="text-gray-500 text-center text-[10px]">SKU: JLCP7463-24</p>

          <div class="px-2 rounded">
            <div class="border-b flex justify-center items-center h-16">
              <span class="text-sky-700 text-center">1960 VW Delivery Van Short do Brasil e do Mundo</span>
            </div>
            <div class="flex items-center justify-between text-[11px]">
              <span class="text-gray-500">Scala: 1/64</span>
              <span class="text-gray-500">M2 Machine</span>
            </div>
            <div class="py-3 flex items-center justify-between text-xs">
              <span class="line-through opacity-50">R$ 2.000</span>
              <span class="px-2 py-1 font-semibold bg-yellow-400 text-red-600 rounded-s-2xl">Save 10%</span>
              <span class="font-semibold text-sky-700 text-base">R$ 1.800</span>
            </div>
          </div>
          <div class="shadow py-3 flex items-center justify-around rounded">
            <button class="px-3 py-2 text-xs rounded-lg bg-sky-700 hover:bg-sky-800 text-white font-semibold">Buy Now</button>
            <button class="px-2 py-1 bg-gray-50 hover:bg-gray-200 shadow rounded-lg">&#128722;</button>
            <button class="px-2 py-1 bg-gray-50 hover:bg-gray-200 shadow rounded-lg">&#128150;</button>
          </div>
        </div>
        <div class="w-60 bg-white rounded transform transition-all hover:-translate-y-2 duration-300 shadow-lg hover:shadow-2xl">
          <img class="p-1 object-cover rounded-xl" src="https://www.mjtoysinc.com/wp-content/uploads/2023/12/JLCP7464-24.jpg" alt="">
          <p class="text-gray-500 text-center text-[10px]">SKU: JLCP7463-24</p>

          <div class="px-2 rounded">
            <div class="border-b flex justify-center items-center h-16">
              <span class="text-sky-700 text-center">1960 VW Delivery Van Short do Brasil e do Mundo</span>
            </div>
            <div class="flex items-center justify-between text-[11px]">
              <span class="text-gray-500">Scala: 1/64</span>
              <span class="text-gray-500">M2 Machine</span>
            </div>
            <div class="py-3 flex items-center justify-between text-xs">
              <span class="line-through opacity-50">R$ 2.000</span>
              <span class="px-2 py-1 font-semibold bg-yellow-400 text-red-600 rounded-s-2xl">Save 10%</span>
              <span class="font-semibold text-sky-700 text-base">R$ 1.800</span>
            </div>
          </div>
          <div class="shadow py-3 flex items-center justify-around rounded">
            <button class="px-3 py-2 text-xs rounded-lg bg-sky-700 hover:bg-sky-800 text-white font-semibold">Buy Now</button>
            <button class="px-2 py-1 bg-gray-50 hover:bg-gray-200 shadow rounded-lg">&#128722;</button>
            <button class="px-2 py-1 bg-gray-50 hover:bg-gray-200 shadow rounded-lg">&#128150;</button>
          </div>
        </div>
        <div class="w-60 bg-white rounded transform transition-all hover:-translate-y-2 duration-300 shadow-lg hover:shadow-2xl">
          <img class="p-1 object-cover rounded-xl" src="https://www.mjtoysinc.com/wp-content/uploads/2023/12/31500-MJS67.jpg" alt="">
          <p class="text-gray-500 text-center text-[10px]">SKU: JLCP7463-24</p>

          <div class="px-2 rounded">
            <div class="border-b flex justify-center items-center h-16">
              <span class="text-sky-700 text-center">1960 VW Delivery Van Short do Brasil e do Mundo</span>
            </div>
            <div class="flex items-center justify-between text-[11px]">
              <span class="text-gray-500">Scala: 1/64</span>
              <span class="text-gray-500">M2 Machine</span>
            </div>
            <div class="py-3 flex items-center justify-between text-xs">
              <span class="line-through opacity-50">R$ 2.000</span>
              <span class="px-2 py-1 font-semibold bg-yellow-400 text-red-600 rounded-s-2xl">Save 10%</span>
              <span class="font-semibold text-sky-700 text-base">R$ 1.800</span>
            </div>
          </div>
          <div class="shadow py-3 flex items-center justify-around rounded">
            <button class="px-3 py-2 text-xs rounded-lg bg-sky-700 hover:bg-sky-800 text-white font-semibold">Buy Now</button>
            <button class="px-2 py-1 bg-gray-50 hover:bg-gray-200 shadow rounded-lg">&#128722;</button>
            <button class="px-2 py-1 bg-gray-50 hover:bg-gray-200 shadow rounded-lg">&#128150;</button>
          </div>
        </div>
        <div class="w-60 bg-white rounded transform transition-all hover:-translate-y-2 duration-300 shadow-lg hover:shadow-2xl">
          <img class="p-1 object-cover rounded-xl" src="https://www.mjtoysinc.com/wp-content/uploads/2023/12/31500-MJS66-1.jpg" alt="">
          <p class="text-gray-500 text-center text-[10px]">SKU: JLCP7463-24</p>

          <div class="px-2 rounded">
            <div class="border-b flex justify-center items-center h-16">
              <span class="text-sky-700 text-center">1960 VW Delivery Van Short do Brasil e do Mundo</span>
            </div>
            <div class="flex items-center justify-between text-[11px]">
              <span class="text-gray-500">Scala: 1/64</span>
              <span class="text-gray-500">M2 Machine</span>
            </div>
            <div class="py-3 flex items-center justify-between text-xs">
              <span class="line-through opacity-50">R$ 2.000</span>
              <span class="px-2 py-1 font-semibold bg-yellow-400 text-red-600 rounded-s-2xl">Save 10%</span>
              <span class="font-semibold text-sky-700 text-base">R$ 1.800</span>
            </div>
          </div>
          <div class="shadow py-3 flex items-center justify-around rounded">
            <button class="px-3 py-2 text-xs rounded-lg bg-sky-700 hover:bg-sky-800 text-white font-semibold">Buy Now</button>
            <button class="px-2 py-1 bg-gray-50 hover:bg-gray-200 shadow rounded-lg">&#128722;</button>
            <button class="px-2 py-1 bg-gray-50 hover:bg-gray-200 shadow rounded-lg">&#128150;</button>
          </div>
        </div>
        <div class="w-60 bg-white rounded transform transition-all hover:-translate-y-2 duration-300 shadow-lg hover:shadow-2xl">
          <img class="p-1 object-cover rounded-xl" src="https://www.mjtoysinc.com/wp-content/uploads/2023/11/HKF56.jpg" alt="">
          <p class="text-gray-500 text-center text-[10px]">SKU: JLCP7463-24</p>

          <div class="px-2 rounded">
            <div class="border-b flex justify-center items-center h-16">
              <span class="text-sky-700 text-center">1960 VW Delivery Van Short do Brasil e do Mundo</span>
            </div>
            <div class="flex items-center justify-between text-[11px]">
              <span class="text-gray-500">Scala: 1/64</span>
              <span class="text-gray-500">M2 Machine</span>
            </div>
            <div class="py-3 flex items-center justify-between text-xs">
              <span class="line-through opacity-50">R$ 2.000</span>
              <span class="px-2 py-1 font-semibold bg-yellow-400 text-red-600 rounded-s-2xl">Save 10%</span>
              <span class="font-semibold text-sky-700 text-base">R$ 1.800</span>
            </div>
          </div>
          <div class="shadow py-3 flex items-center justify-around rounded">
            <button class="px-3 py-2 text-xs rounded-lg bg-sky-700 hover:bg-sky-800 text-white font-semibold">Buy Now</button>
            <button class="px-2 py-1 bg-gray-50 hover:bg-gray-200 shadow rounded-lg">&#128722;</button>
            <button class="px-2 py-1 bg-gray-50 hover:bg-gray-200 shadow rounded-lg">&#128150;</button>
          </div>
        </div>

      </div> --}}

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
        if(tempo.value != '' && tempo.value != '0') {
          
          const valor = parseInt(tempo.value);

          if(valor > 0) {

            tempo_atual = valor;

            if(relogio) {
              clearInterval(relogio);
            }
            
            relogio = setInterval(contar, 1000);

          }else{

            alert("Informe um valor maior que zero!");

          }

        }else{

          alert("Informe um número válido!");

        }
      }

      function contar() {
        
        tempo_atual--;
        
        if(tempo_atual >= 0) {

          let horas, minutos, segundos;

          horas = Math.floor(tempo_atual/3600);
          minutos = Math.floor((tempo_atual - horas * 3600)/60);
          segundos = tempo_atual - horas * 3600 - minutos * 60;

          if(horas < 10) {
            horas = "0"+horas;
          }
          if(minutos < 10) {
            minutos = "0"+minutos;
          }
          if(segundos < 10) {
            segundos = "0"+segundos;
          }

          document.querySelector('#contador').innerHTML = "<span>"+horas+":"+minutos+":"+segundos+"</span>";

        }else{

          clearInterval(relogio);
          // alert("Parou!");
          document.querySelector('#contador').innerHTML = "<span>"+"Você Venceu!!"+"</span>";

        }
      }

    </script>

</body>
</html



{{-- <div class="main border shadow bg-white text-sm text-center p-2 col-span-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">

  <div class="border shadow h-96 p-2">
    <div class="w-full object-cover zoomable"><img src="https://www.mjtoysinc.com/wp-content/uploads/2023/12/JLCP7463-24.jpg" alt=""></div>
    <p class="h-[20px] text-[11px]">SKU: JLCP7463-24</p>
    <p class="h-[70px] text-sky-700">Johnny Lightning 1:64 1980 Toyota</p>
    <p class="h-[30px] py-1 mt-1 font-bold text-base text-sky-700">$45.00</p>
    <button type="button" class="mt-2 text-white bg-sky-700 hover:bg-sky-900 px-4 py-1 rounded inline-flex items-center">
      <svg class="w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 21">
        <path d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z"/>
      </svg>
      Add Cart
    </button>
  </div>
  <div class="border shadow h-96 p-2">
    <div><img src="https://www.mjtoysinc.com/wp-content/uploads/2023/12/JLCP7464-24.jpg" alt=""></div>
    <p class="h-[20px] text-[11px]">SKU: JLCP7463-24</p>
    <p class="h-[70px] text-sky-700">Johnny Lightning 1:64 1980 Toyota land Cruiser</p>
    <p class="h-[30px] py-1 mt-1 font-bold text-base text-sky-700">$45.00</p>
    <button type="button" class="mt-2 text-white bg-sky-700 hover:bg-sky-900 px-4 py-1 rounded inline-flex items-center">
      <svg class="w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 21">
        <path d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z"/>
      </svg>
      Add Cart
    </button>
  </div>
  <div class="border shadow h-96 p-2">
    <div><img src="https://www.mjtoysinc.com/wp-content/uploads/2023/12/31500-MJS67.jpg" alt=""></div>
    <p class="h-[20px] text-[11px]">SKU: JLCP7463-24</p>
    <p class="h-[70px] text-sky-700">Johnny Lightning 1:64 1980 Toyota land Cruiser</p>
    <p class="h-[30px] py-1 mt-1 font-bold text-base text-sky-700">$45.00</p>
    <button type="button" class="mt-2 text-white bg-sky-700 hover:bg-sky-900 px-4 py-1 rounded inline-flex items-center">
      <svg class="w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 21">
        <path d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z"/>
      </svg>
      Add Cart
    </button>
  </div>
  <div class="border shadow h-96 p-2">
    <div><img src="https://www.mjtoysinc.com/wp-content/uploads/2023/12/31500-MJS66-1.jpg" alt=""></div>
    <p class="h-[20px] text-[11px]">SKU: JLCP7463-24</p>
    <p class="h-[70px] text-sky-700">Johnny Lightning 1:64 1980 Toyota land Cruiser</p>
    <p class="h-[30px] py-1 mt-1 font-bold text-base text-sky-700">$45.00</p>
    <button type="button" class="mt-2 text-white bg-sky-700 hover:bg-sky-900 px-4 py-1 rounded inline-flex items-center">
      <svg class="w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 21">
        <path d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z"/>
      </svg>
      Add Cart
    </button>
  </div>
  <div class="border shadow h-96 p-2">
    <div><img src="https://www.mjtoysinc.com/wp-content/uploads/2023/11/HKF56.jpg" alt=""></div>
    <p class="h-[20px] text-[11px]">SKU: JLCP7463-24</p>
    <p class="h-[70px] text-sky-700">Johnny Lightning 1:64 1980 Toyota land Cruiser</p>
    <p class="h-[30px] py-1 mt-1 font-bold text-base text-sky-700">$45.00</p>
    <button type="button" class="mt-2 text-white bg-sky-700 hover:bg-sky-900 px-4 py-1 rounded inline-flex items-center">
      <svg class="w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 21">
        <path d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z"/>
      </svg>
      Add Cart
    </button>
  </div>
  
</div> --}}