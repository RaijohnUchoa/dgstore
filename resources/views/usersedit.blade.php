@extends("layouts.app")
@section("title", "Usuários")
@section("content")

<div class="">

    <div class="flex justify-between items-center border py-1 px-2">
        <span class="font-bold">EDITANDO USUÁRIO[{{ $user->name }}]</span>
        <a href="{{ route('usersread') }}" class="py-1 px-3 mb-1 text-xs text-center text-white bg-red-600 rounded">Voltar</a>
    </div>
    <hr class="mt-0.5 border">

    {{-- ALTERAR USUÁRIO --}}
    <form action="{{ route('usersupdate', $user->id) }}" method="POST" id="open" class="text-xs">
        @csrf
        @method('PUT')
        <div class="flex items-center mt-3 px-2 space-x-2">
            <div class="w-full">
                <label for="name"><span class="font-semibold">:Nome</span></label>
                <input class="w-full py-1 border border-blue-200 focus:border-blue-100 rounded text-xs text-blue-900 placeholder-gray-300" type="text" name="name" id="name" value="{{ $user->name }}" placeholder=" alterar nome do usuário" required>
                @error('name')
                    <div class="absolute text-red-400">Digite o nome do Usuário</div>
                @enderror
            </div>
            <div class="w-full">
                <label for="email"><span class="font-semibold">:E-mail</span></label>
                <input class="w-full py-1 border border-blue-200 focus:border-blue-100 rounded text-blue-900 placeholder-gray-300" type="email" name="email" id="email" value="{{ $user->email }}" required>
                @error('email')
                    <div class="absolute text-red-400">Digite o nome do Usuário</div>
                @enderror
            </div>
            <div class="w-full">
                <label for="password"><span class="font-semibold">:Senha</span></label>
                {{-- <input class="w-full py-1 border border-blue-200 focus:border-blue-100 rounded text-blue-900 placeholder-gray-300" type="password" name="password" id="password" value="{{ Str::limit($user->password, 10) }}" required> --}}
                <input class="w-full py-1 border border-blue-200 focus:border-blue-100 rounded text-blue-900 placeholder-gray-300" type="text" name="password" id="password" value="{{ Str::replace( ':', "", substr( now(), 11, 8) ) }}">
                @error('password')
                    <div class="absolute text-red-400">Digite o nome do Usuário</div>
                @enderror
            </div>
            <div class="w-full">
                <label for="type"><span class="font-semibold">:Tipo</span></label>
                <select name="type" id="type" class="w-full py-1 border border-blue-200 focus:border-blue-100 rounded text-blue-900" required>
                    <option value="{{ $user->type }}">{{ $user->type == 1 ? "Cliente" : "Admin"}}</option>
                    <option value="{{ 1 }}">Cliente</option>
                    <option value="{{ 0 }}">Admin</option>
                </select>
            </div>
        </div>
        <div class="px-2">
            <button type="submit" class="w-full px-2 py-1 mt-3 text-center text-white bg-sky-700 rounded hover:bg-sky-800">Salvar Edição Usuário</button>
        </div>
    </form>

</div>

@endsection

