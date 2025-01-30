<div class="p-2 text-gray-600">

    <div class="md:hidden ml-1">
        <button onclick="openClose()">
            <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8 p-1 border-2 border-gray-400 rounded-full">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>
    </div>

    <div class="md:flex hidden">
        <div class="font-semibold text-[15.5px]">
            <a href="#" class="flex lg:space-x-2 py-1">
                <div class="lg:flex hidden">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="min-w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
                    </svg>
                </div>
                <span class="md:flex items-center z-0 hidden">DASHBOARD</span>
            </a>
        </div>
    </div>

    <hr class="mt-1 border-gray-300">

    <div class="mt-3 text-xs lg:text-sm ml-2 md:ml-0">

        @if (Auth::check())

            @if (Auth::user()->type == 0)

                <ul>
                    <li class="hover:font-semibold">
                        <a href="{{ route('usersread') }}" class="flex lg:space-x-2 py-1">
                            <div id="iconUsers" class="">
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="min-w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                </svg>
                            </div>
                            <span id="openUsers" class="md:flex items-center hidden">Usuários</span>
                        </a>
                    </li>
                    <li class="hover:font-semibold">
                        <a href="{{ route('suppliersread') }}" class="flex lg:space-x-2 py-1">
                            <div id="iconSuppliers" class="">
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="min-w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                </svg>
                            </div>
                            <span id="openSuppliers" class="md:flex items-center hidden">Fornecedores</span>
                        </a>
                    </li>
                    <li class="hover:font-semibold">
                        <a href="{{ route('categoriesread') }}" class="flex lg:space-x-2 py-1">
                            <div id="iconCategories" class="">
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="min-w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75 2.25 12l4.179 2.25m0-4.5 5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0 4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0-5.571 3-5.571-3" />
                                </svg>
                            </div>
                            <span id="openCategories" class="md:flex items-center hidden">Categorias</span>
                        </a>
                    </li>
                    <li class="hover:font-semibold">
                        <a href="{{ route('brandsread') }}" class="flex lg:space-x-2 py-1">
                            <div id="iconBrands" class="">
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="min-w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.098 19.902a3.75 3.75 0 0 0 5.304 0l6.401-6.402M6.75 21A3.75 3.75 0 0 1 3 17.25V4.125C3 3.504 3.504 3 4.125 3h5.25c.621 0 1.125.504 1.125 1.125v4.072M6.75 21a3.75 3.75 0 0 0 3.75-3.75V8.197M6.75 21h13.125c.621 0 1.125-.504 1.125-1.125v-5.25c0-.621-.504-1.125-1.125-1.125h-4.072M10.5 8.197l2.88-2.88c.438-.439 1.15-.439 1.59 0l3.712 3.713c.44.44.44 1.152 0 1.59l-2.879 2.88M6.75 17.25h.008v.008H6.75v-.008Z" />
                                </svg>
                            </div>
                            <span id="openBrands" class="md:flex items-center hidden">Marcas</span>
                        </a>
                    </li>
                    <li class="hover:font-semibold">
                        <a href="{{ route('productsread') }}" class="flex lg:space-x-2 py-1">
                            <div id="iconProducts" class="">
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="min-w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                            </div>
                            <span id="openProducts" class="md:flex items-center hidden">Produtos</span>
                        </a>
                    </li>
                    <li class="hover:font-semibold">
                        <a href="#" class="flex lg:space-x-2 py-1">
                            <div id="iconSettings" class="">
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="min-w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </div>
                            <span id="openSettings" class="md:flex items-center hidden">Configurações</span>
                        </a>
                    </li>
                </ul>

            @else

                FILTROS CLIENTE

            @endif

        @else

            FILTROS VISITANTE

        @endif

    </div>

</div>
<script>
    function openClose() {
      document.querySelector("#openUsers").classList.toggle('hidden')
      document.querySelector("#iconUsers").classList.toggle('hidden')
      document.querySelector("#openSuppliers").classList.toggle('hidden')
      document.querySelector("#iconSuppliers").classList.toggle('hidden')
      document.querySelector("#openCategories").classList.toggle('hidden')
      document.querySelector("#iconCategories").classList.toggle('hidden')
      document.querySelector("#openBrands").classList.toggle('hidden')
      document.querySelector("#iconBrands").classList.toggle('hidden')
      document.querySelector("#openProducts").classList.toggle('hidden')
      document.querySelector("#iconProducts").classList.toggle('hidden')
      document.querySelector("#openSettings").classList.toggle('hidden')
      document.querySelector("#iconSettings").classList.toggle('hidden')
    }
    // openClose()
</script>
