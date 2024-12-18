@extends("layouts.app")
@section("title", "Usuários")
@section("content")

<div class="">

    @if(session()->has('success'))
        <span class="flex justify-center bg-green-200 text-green-700 text-sm m-2 py-1 rounded">{{ session()->get('success') }}</span>
    @endif

    <div class="flex justify-between items-center border py-1 px-2">
        <span class="font-semibold">USUÁRIOS[{{ Auth::user()->count() }}]</span>
        <div class="text-white">
            <a href="{{ route('usersfilter', 3) }}" class="bg-gray-700 text-xs py-1 px-2 rounded">Geral</a>
            <a href="{{ route('usersfilter', 2) }}" class="bg-green-600 text-xs py-1 px-1 rounded">Clientes</a>
            <a href="{{ route('usersfilter', 1) }}" class="bg-sky-600 text-xs py-1 px-1 rounded">Admin</a>
            <a href="{{ route('usersfilter', 0) }}" class="bg-gray-500 text-xs py-1 px-1 rounded">inAtivos</a>
            <button class="bg-sky-600 text-white text-xs py-1 px-1 rounded" onclick="openForm()">Novo Usuário ▼</button>
        </div>
    </div>
    <hr class="mt-0.5 border">
    {{-- INCLUIR NOVO USUÁRIO --}}
    <form action="{{ route('userscreate') }}" method="POST" id="open" class="text-xs hidden">
        @csrf
        <div class="flex items-center mt-3 px-2 space-x-2">
            <div class="w-full">
                <label for="name"><span class="font-semibold">:Nome</span></label>
                <input class="w-full py-1 border border-blue-200 focus:border-blue-100 rounded text-xs text-blue-900 placeholder-gray-300" type="text" name="name" id="name" value="{{ old('name') }}" placeholder=" nome do usuário" required>
                @error('name')
                    <div class="absolute text-red-400">Digite o nome do Usuário</div>
                @enderror
            </div>
            <div class="w-full">
                <label for="email"><span class="font-semibold">:E-mail</span></label>
                <input class="w-full py-1 border border-blue-200 focus:border-blue-100 rounded text-blue-900 placeholder-gray-300 " type="email" name="email" id="email" value="{{ old('email') }}" placeholder=" email do usuário" required>
                @error('email')
                    <div class="absolute text-red-400">Digite o Email do Usuário</div>
                @enderror
            </div>
            <div class="w-full">
                <label for="password"><span class="font-semibold">:Senha</span></label>
                <input class="w-full py-1 border border-blue-200 focus:border-blue-100 rounded text-blue-900 placeholder-gray-300" type="password" name="password"  id="password" value="{{ old('password') }}" placeholder=" senha do usuário" required>
                @error('password')
                    <div class="absolute text-red-400">Digite a Senha do Usuário</div>
                @enderror
            </div>
            <div class="w-full">
                <label for="type"><span class="font-semibold">:Tipo</span></label>
                <select name="type" id="type" class="w-full py-1 border border-blue-200 focus:border-blue-100 rounded text-blue-900" required>
                    <option value="{{ 0 }}">Admin</option>
                    {{-- <option value="{{ 1 }}">Cliente</option> --}}
                </select>
            </div>
        </div>
        <div class="px-2">
            <button type="submit" class="w-full px-2 py-1 mt-3 text-center text-white bg-sky-700 rounded hover:bg-sky-800">Salvar Novo Usuário</button>
        </div>
    </form>

    {{-- LISTA TABELAS --}}
    <div class="relative overflow-x-auto shadow sm:rounded">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-600 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400 border-b-4">
                <tr>
                    <th scope="col" class="px-2">
                        #
                    </th>
                    <th scope="col" class="px-2">
                        Usuário
                    </th>
                    <th scope="col" class="px-2">
                        Email
                    </th>
                    <th scope="col" class="px-2">
                        Tipo
                    </th>
                    <th scope="col" class="px-2">
                        Status
                    </th>
                    <th scope="col" class="px-2">
                        Ações
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr class="{{ $user->is_active == 1 ? 'text-green-700' : 'text-gray-300' }} text-xs odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th scope="row" class="px-2 py-1">
                            {{-- <span>{{ $user->id }}</span> --}}
                            <span>{{ $loop->iteration }}]</span>
                        </th>
                        <td class="px-2 py-1">
                            <span>{{ $user->name }}</span>
                        </td>
                        <td class="px-2 py-1">
                            <span>{{ $user->email }}</span>
                        </td>
                        <td class="px-2 py-1">
                            <span>{{ $user->type == 0 ? 'Admin' : 'Cliente' }}</span>
                        </td>
                        <td class="px-2 py-1">
                            <span class="py-1 px-2 mr-2 rounded hover:fonte-bold">{{ $user->is_active == 1 ? "Ativo" : "inAtivo" }}</span>
                        </td>
                        <td class="px-2 flex">

                            @if ($user->is_active == 1)
                                <a href="{{ route('usersedit', $user->id) }}" class="bg-yellow-300 py-1 px-2 mr-2 rounded text-blue-600 hover:fonte-bold">Edit</a>
                            @else
                                <span class="bg-gray-300 py-1 px-2 mr-2 rounded text-gray-400 hover:fonte-bold" disabled>Edit</span>
                            @endif

                            <div class="flex items-center">
                                <a href="{{ route('usersactive', $user->id) }}" onclick="return confirm('Tem Certeza que Deseja (DES)ATIVAR')" class="flex items-center {{ $user->is_active == 1 ? 'bg-red-600 px-1' : 'bg-gray-400 px-1' }} rounded-full text-gray-50 hover:fonte-bold"><span class="flex items-center">{{ $user->is_active == 1 ? 'x' : '>' }}</span></a>
                            </div>

                        </td>
                    </tr>
                @empty
                    <tr><td>Lista Vazia</td></tr>
                @endforelse
                </tr>
            </tbody>
        </table>
    </div>


</div>

@endsection

<script>
    function openForm() {
      document.querySelector('#open').classList.toggle('hidden')
    }
    openForm()
</script>

{{-- CUSTOM SELECT --}}
{{-- <div class="inline-block relative w-64">
    <select class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
      <option>Really long option that will likely overlap the chevron</option>
      <option>Option 2</option>
      <option>Option 3</option>
    </select>
    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
      <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
    </div>
</div> --}}
