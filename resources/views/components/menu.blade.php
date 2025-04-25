<style>
    li:hover ul#submenubrands {
        display: block;
    }
</style>

<nav class="dropdownhover flex justify-center h-[35px] bg-gray-800 text-sm rounded">

    @if (Auth::check() and Auth::user()->type == 0)
        <div class="flex items-center font-semibold text-white text-[18px] tracking-[4px]">CADASTROS</div>
    @endif

    @if ($user == 'Visitante!' or Auth::user()->type > 0)

        <ul class="flex items-center">

            <li class="relative px-4 hover:text-white">
                <a href="{{ url('/') }}" class="{{ Request::is('/') || Request::is('register') || Request::is('login') || Request::is('logout') ? 'border-b-2 border-red-400 text-white rounded' : '' }}">Todos Produtos</a>
            </li>

            <li class="relative px-4 hover:text-white">
                <a href="{{ route('productsfiltersale') }}" class="{{ Request::is('productsfiltersale') ? 'border-b-2 border-red-400 text-white rounded' : '' }}">Ofertas</a>
            </li>

            <li class="relative px-4 hover:text-white">
                <span class="flex items-center cursor-pointer">
                    Marcas
                    <svg class="w-3 h-3 ml-1.5 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="3.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </span>
                <ul id="submenubrands" class="z-10 hidden absolute bg-gray-800 text-xs rounded pt-2">
                    @foreach ($brands as $brand)
                        <li class="relative border-t w-36 py-1 px-2 hover:bg-gray-500">
                            <a href="{{ route('productsfilterbrand', $brand->brand_name) }}" class="flex lg:space-x-2">
                                <span class="md:flex items-center hidden">{{ $brand->brand_name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>

            <li class="relative px-4 hover:text-white">
                <a href="{{ route('productsfilterpreorder') }}" class="{{ Request::is('productsfilterpreorder') ? 'border-b-2 border-red-400 text-white rounded' : '' }}">Pre-Order</a>
            </li>

            <li class="relative px-4 hover:text-white">
                <a href="{{ route('productsfilterfeatured') }}" class="{{ Request::is('productsfilterfeatured') ? 'border-b-2 border-red-400 text-white rounded' : '' }}">Exclusivos</a>
            </li>
            
        </ul>

    @endif
   
</nav>
