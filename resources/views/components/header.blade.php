<nav class="bg-gray-800 text-sm rounded">

    <div class="flex justify-between px-2 h-[30px] select-none text-xs">

        <div class="w-4/12 relative flex" id="dropdownButton">
            <div class="flex items-center cursor-pointer hover:text-gray-50" onclick="toggleDropdown()">
                {{-- @if(session()->has('success'))
                    <span>{{ session()->get('success') }} {{ $user }}</span>
                @else
                    <span>Olá {{ $user }}</span>
                @endif --}}
                <svg height="18px" viewBox="0 -960 960 960" width="18px" fill="#f8fafc">
                    <path d="M185-80q-17 0-29.5-12.5T143-122v-105q0-90 56-159t144-88q-40 28-62 70.5T259-312v190q0 11 3 22t10 20h-87Zm147 0q-17 0-29.5-12.5T290-122v-190q0-70 49.5-119T459-480h189q70 0 119 49t49 119v64q0 70-49 119T648-80H332Zm148-484q-66 0-112-46t-46-112q0-66 46-112t112-46q66 0 112 46t46 112q0 66-46 112t-112 46Z"/>
                </svg>
                <span class="px-1">{{ $user }}</span>
                <svg class="w-3 h-3 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="3.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
            </div>
            @if (Auth::check())
                <div class="hidden absolute top-[31px] bg-gray-800 w-36 rounded" id="dropdown">
                    <div class="border-b cursor-pointer hover:text-gray-50 py-1 px-2">Minha Conta</div>
                    <div class="border-b cursor-pointer hover:text-gray-50 py-1 px-2">Minhas Compras</div>
                    <div class="border-b cursor-pointer hover:text-gray-50 py-1 px-2">Configurações</div>
                    <div class="border-b cursor-pointer hover:text-gray-50 py-1 px-2">
                        <a class="hover:text-gray-50" href="{{ route('logout') }}">
                            <span class="flex items-center">Sair
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
            @else
                <div class="hidden absolute top-[31px] bg-gray-800 text-xs w-36 rounded" id="dropdown">
                    <div class="border-b cursor-pointer hover:text-gray-50 p-1"><a href="{{ route('register') }}">Registre-se!</a></div>
                    <div class="border-b cursor-pointer hover:text-gray-50 p-1"><a href="#">Entre em Contato</a></div>
                </div>
            @endif
        </div>
        <div class="w-4/12 hidden md:flex justify-center items-center space-x-3 text-xs">
            @if (Auth::check())
                @if(Auth::user()->type == 0)
                    <span class="font-bold text-white tracking-widest bg-red-700 px-3 py-1 rounded text-sm">PAINEL DE CONTROLE</span>
                @else
                    <span>BUSCA...</span>
                @endif

            @else
                <a class="hover:text-gray-50 hover:border-y-2" href="#">Home</a>
                <a class="hover:text-gray-50 hover:border-y-2" href="#">Sobre</a>
                <a class="hover:text-gray-50 hover:border-y-2" href="#">Contato</a>
            @endif
        </div>
        <div class="w-4/12 hidden md:flex justify-end items-center">
            @if (Auth::check())
                <a class="hover:text-gray-50" href="{{ route('logout') }}">
                    <span class="flex items-center">Sair
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                        </svg>
                    </span>
                </a>
            @else
                <a class="hover:text-gray-50" href="{{ route('login') }}">
                    <span class="flex items-center">Entrar
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                        </svg>
                    </span>
                </a>
            @endif
        </div>
        <div class="md:hidden text-xl">
            <button class="mobile-menu-button hover:text-gray-50">&#9776</button>
        </div>

    </div>
    {{-- MOBILE --}}
    <div class="mobile-menu hidden md:hidden text-center">

        <a class="border-y block py-2 hover:text-gray-50" href="#">Home</a>
        <a class="border-b block py-2 hover:text-gray-50" href="#">Sobre</a>
        <a class="border-b block py-2 hover:text-gray-50" href="#">Contato</a>
        @if (Auth::check())
            <a class="block py-2 hover:text-gray-50" href="{{ route('logout') }}">
                <span class="flex items-center justify-center">Sair
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
                </span>
            </a>
        @else
            <a class="block py-2 hover:text-gray-50" href="{{ route('login') }}">
                <span class="flex items-center justify-center">Entrar
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                    </svg>
                </span>
            </a>
        @endif

    </div>

</nav>

<script>
    function toggleDropdown() {
        let dropdown = document.querySelector("#dropdownButton #dropdown");
        dropdown.classList.toggle("hidden");
    }

    const btn = document.querySelector('button.mobile-menu-button');
    const menu = document.querySelector('.mobile-menu');

    btn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });
</script>
