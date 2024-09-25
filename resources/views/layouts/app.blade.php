<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield("title", "MyDGS")</title>
  @vite('resources/css/app.css')
</head>
<body>

  <div class="container m-auto max-w-[1280px] bg-gray-50 text-gray-300 shadow p-1 grid grid-cols-7 gap-1 select-none">
    {{-- NAVTOP --}}
    <div class="header col-span-7">
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
    <div class="slider flex justify-center items-center shadow py-6 col-span-7">
      <div class="w-[350px]">
        <img src="{{ asset("LogoDGS.png") }}" alt="LOGO"/>
        {{-- <img src="LogoDGS.png" alt="SLIDER"> --}}
      </div>
    </div>

    {{-- MENU PRINCIPAL --}}
    <div class="navmenu shadow col-span-7">
        <x-menu></x-menu>
    </div>
    {{-- SIDEBAR --}}
    <div class="sidebar border shadow col-span-1">
        <x-sidebar></x-sidebar>
    </div>
    {{-- MAIN --}}
    <div class="main h-screen border shadow bg-white text-gray-600 col-span-6">
        @yield('content')
    </div>

    {{-- <div class="main border shadow bg-white text-sm text-center p-2 col-span-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
      <div class="border shadow h-96 p-2">
        <div class="w-full object-cover zoomable"><img src="https://www.mjtoysinc.com/wp-content/uploads/2023/12/JLCP7463-24.jpg" alt=""></div>
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

    {{-- ANUNCIOS --}}
    <div class="news shadow h-[200px] col-span-7">
      NEWS
    </div>
    {{-- FOOTER --}}
    <div class="footer shadow flex  justify-center items-center text-center h-[100px] col-span-7">
      <x-footer></x-footer>
    </div>

  </div>

</body>
</html
