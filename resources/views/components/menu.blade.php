<style>
    li:hover ul#submenu {
        display: block;
    }
</style>
<nav class="dropdownhover flex justify-center h-[35px] bg-gray-800 text-sm rounded">
    <ul class="flex items-center">
        <li class="relative px-4 hover:text-white">
            <a href="{{ url('/') }}">Todos Produtos</a>
        </li>
        <li class="relative px-4 hover:text-white">
            <a href="{{ route('productsfiltersale') }}">
                Ofertas
            </a>
        </li>
        <li class="relative px-4 hover:text-white">
            <a class="flex items-center" href="">
                Marcas
                <svg class="w-3 h-3 ml-1.5 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="3.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
            </a>
            <ul id="submenu" class="z-10 hidden absolute bg-gray-800 text-xs rounded pt-2">
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
            <a href="{{ route('productsfiltersale') }}">
                Reservas
            </a>
        </li>
        <li class="relative px-4 hover:text-white"><a href="">Exclusivos</a></li>
    </ul>
</nav>
