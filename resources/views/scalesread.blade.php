@extends('layouts.app')
@section('title', 'Escalas')
@section('content')

@if (session()->has('success'))
    <span class="flex justify-center bg-green-200 text-green-700 text-xs m-2 py-1 rounded">{{ session()->get('success') }}</span>
@endif
<div class="flex justify-between items-center border py-1 px-2">
    <span class="font-semibold">ESCALAS</span>
    {{-- <div class="text-white">
        <a href="{{ route('productsfilter', 2) }}" class="bg-gray-700 text-xs py-1 px-2 rounded">Geral</a>
        <a href="{{ route('productsfilter', 1) }}" class="bg-green-600 text-xs py-1 px-1 rounded">Ativos</a>
        <a href="{{ route('productsfilter', 0) }}" class="bg-gray-500 text-xs py-1 px-1 rounded">inAtivos</a> --}}
        <button class="bg-sky-600 text-white text-xs py-1 px-1 rounded" onclick="openForm()">Nova Escala ▼</button>
    {{-- </div> --}}
</div>
<hr class="mt-0.5 border">

{{-- INCLUIR NOVA ESCALA --}}
{{-- <form action="{{ route('scalescreate') }}" method="POST" id="open" class="text-xs"> --}}
<form action="{{ route('scalescreate') }}" method="POST" id="open" class="text-xs hidden">
    @csrf
    <div class="m-2 py-3 bg-blue-50 border border-blue-200 rounded shadow-md">
        <div class="flex items-center px-2 space-x-2">

            <div class="w-full">
                <label for="scale_name"><span class="font-semibold">:Escala [1:64]</span></label>
                <input
                    class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900 placeholder-gray-300"
                    type="text" name="scale_name" id="scale_name" value="{{ old('scale_name') }}" maxlength="4"
                    placeholder=" formato 1:64 não use barra '/ '">
                @error('scale_name')
                    <div class="absolute text-red-400">Digite uma Escala</div>
                @enderror
            </div>
            <div class="w-full">
                <label for="slug"><span class="font-semibold">:Slug</span></label>
                <input
                    class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900 placeholder-gray-300"
                    type="text" name="slug" id="slug" value="{{ old('slug') }}"
                    placeholder=" nome do slug">
                @error('slug')
                    <div class="absolute text-red-400">Digite o Slug da Escala</div>
                @enderror
            </div>
            <div class="w-full">
                <label for="is_active"><span class="font-semibold">:Status</span></label>
                <select name="is_active" id="is_active"
                    class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs text-blue-900"
                    required>
                    <option value="{{ 1 }}">Ativo</option>
                    <option value="{{ 0 }}">Inativo</option>
                </select>
            </div>

        </div>
    </div>
    <div class="px-2">
        <button type="submit" class="w-full px-2 py-1 text-center text-white rounded shadow-md bg-sky-700 hover:bg-sky-800" onclick="charValidation()">Salvar Nova Escala</button>
    </div>
</form>

{{-- LISTA/EDIT PRODUTOS --}}

<div class="border-y border-blue-200 text-center text-xs mt-4 py-1 mb-2">
    <span class="font-semibold text-blue-500">LISTAGEM DAS ESCALAS</span>
</div>

@forelse ($scales as $scale)

    <div class="border-b px-2 {{ $scale->is_active == 1 ? 'text-blue-900' : 'text-gray-300' }} text-xs odd:bg-gray-75 even:bg-white">
                
        {{-- FORMULÁRIO ALTERAR NA LISTAGEM --}}
        <form action="{{ route('scalesupdate', $scale->id) }}" method="POST" id="open" class="text-xs">
            @csrf
            @method('PUT')

            <div class="flex items-center space-x-2">
                
                <div class="w-full">
                    <label for="slug"><span class="font-semibold">:Escala</span></label>
                    <input
                        class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs {{ $scale->is_active == 1 ? 'text-blue-900' : 'text-gray-300' }}"
                        type="text" name="scale_name" id="scale_name" 
                        value="{{ $scale->scale_name }}"
                        @disabled($scale->is_active == 1 ? false : true)>
                </div>
                
                <div class="w-full">
                    <label for="slug"><span class="font-semibold">:Slug</span></label>
                    <input 
                        class="w-full py-1 px-2 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs {{ $scale->is_active == 1 ? 'text-blue-900' : 'text-gray-300' }}"
                        type="text" name="slug" id="slug" 
                        value="{{ $scale->slug }}"
                        @disabled($scale->is_active == 1 ? false : true)>
                </div>
                
                <div class="w-full">
                    <label for="is_active"><span class="font-semibold">:Status</span></label>
                    <p class="w-full py-1 px-2 bg-gray-100 border border-blue-200 focus:outline-none focus:border-blue-500 rounded text-xs {{ $scale->is_active == 1 ? 'text-blue-900' : 'text-gray-300' }}">
                        {{ $scale->is_active == 1 ? "Ativo" : "Inativo" }}
                    </p>
                </div>

                @if ($scale->is_active == 1)
                    <button type="submit" class="mt-4" title="Atualizar">
                        <svg height="22px" viewBox="0 -960 960 960" width="22px" fill="#0284c7">
                            <path d="M482-160q-134 0-228-93t-94-227v-7l-64 64-56-56 160-160 160 160-56 56-64-64v7q0 100 70.5 170T482-240q26 0 51-6t49-18l60 60q-38 22-78 33t-82 11Zm278-161L600-481l56-56 64 64v-7q0-100-70.5-170T478-720q-26 0-51 6t-49 18l-60-60q38-22 78-33t82-11q134 0 228 93t94 227v7l64-64 56 56-160 160Z" />
                        </svg>
                    </button>
                    <a href="{{ route('scalesactive', [$scale->id, 'disable']) }}" onclick="return confirm('Tem Certeza que Deseja (DESATIVAR)?')" class="mt-4">
                        <span class="" title="Desativar">
                            <svg height="19px" viewBox="0 -960 960 960" width="19px" fill="#ef4444">
                                <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
                            </svg>
                        </span>
                    </a>
                @else
                    <a href="{{ route('scalesactive', [$scale->id, 'delete']) }}" onclick="return confirm('Tem Certeza que Deseja (DELETAR)?')" class="mt-4">
                        <span class="" title="Deletar">
                            <svg height="20px" viewBox="0 -960 960 960" width="20px" fill="#ef4444">
                                <path d="m376-300 104-104 104 104 56-56-104-104 104-104-56-56-104 104-104-104-56 56 104 104-104 104 56 56Zm-96 180q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520Zm-400 0v520-520Z"/>
                            </svg>
                        </span>
                    </a>
                    {{-- <span class="mt-4">
                        <svg height="22px" viewBox="0 -960 960 960" width="22px" fill="#d1d5db">
                            <path d="M482-160q-134 0-228-93t-94-227v-7l-64 64-56-56 160-160 160 160-56 56-64-64v7q0 100 70.5 170T482-240q26 0 51-6t49-18l60 60q-38 22-78 33t-82 11Zm278-161L600-481l56-56 64 64v-7q0-100-70.5-170T478-720q-26 0-51 6t-49 18l-60-60q38-22 78-33t82-11q134 0 228 93t94 227v7l64-64 56 56-160 160Z" />
                        </svg>
                    </span> --}}
                    <a href="{{ route('scalesactive', [$scale->id, 'enable']) }}" onclick="return confirm('Tem Certeza que Deseja (REATIVAR)?')" class="mt-4">
                        <span class="" title="Reativar">
                            <svg height="20px" viewBox="0 -960 960 960" width="20px" fill="#16a34a">
                                <path d="M440-320h80v-166l64 62 56-56-160-160-160 160 56 56 64-62v166ZM280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520Zm-400 0v520-520Z" />
                            </svg>
                        </span>
                    </a>
                @endif
            </div>
            
        </form>

    </div>

@empty
    <td>Lista Vazia</td>
@endforelse

@endsection

<script>
    function openForm() {
        document.querySelector('#open').classList.toggle('hidden')
    }
    openForm()
</script>

<script>


    // document.addEventListener('keydown', function(event) { //pega o evento de precionar uma tecla
    // if(event.keyCode != 46 && event.keyCode != 8){//verifica se a tecla precionada nao e um backspace e delete
    // var i = document.getElementById("scale_name").value.length; //aqui pega o tamanho do input
    // if (i === 1) //aqui faz a divisoes colocando um ponto no terceiro e setimo indice
    //   document.getElementById("scale_name").value = document.getElementById("scale_name").value + ":";
    // }
    // });
    // document.getElementById("scale_name").addEventListener("input", function() {
    // var i = document.getElementById("scale_name").value.length;
    // var str = document.getElementById("scale_name").value
    // if (isNaN(Number(str.charAt(i-1)))) {
    //     document.getElementById("scale_name").value = str.substr(0, i-1)
    // }
    // });
    
    document.addEventListener('keydown', function(event) { 
        if(event.keyCode != 46 && event.keyCode != 8) {
            var i = document.getElementById("scale_name").value.length;
            if (i === 1)
                document.getElementById("scale_name").value = document.getElementById("scale_name").value + ":";
        }
    });

    
</script>
