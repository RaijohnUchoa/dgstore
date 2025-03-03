@extends("layouts.app")
@section("title", "Informações")
@section("content")

<div class="flex justify-between items-center border py-1 px-2">
    <span class="font-semibold">INFORMAÇÕES</span>
    <a href="{{ url('/') }}" class="py-1 px-3 mb-1 text-xs text-center text-white bg-red-600 rounded">Voltar</a>
</div>

<div class="text-center mt-6">
    <span class="border-y font-semibold">SOBRE NÓS</span>
    <p>O Diecast Garage Sale é um dos representantes e fornecedo de Miniaturas de Veículos reconhecido por seus clientes colecionadores!</p>
    <p>Sempre com sa mais belas miniaturas a oferecer aos mais diletos colecionadores, apresentando as novidades do mundo Diecast.</p>
</div>

<div class="text-center my-6">
    <span class="border-y font-semibold">CONTATO</span>
    <p>Atendemos no horário comercial via WhatsApp: 19 99248-7667</p>
    <p>email: raijohn.uchoa@gmail.com</p>
    <p>Facebook: <a class="underline text-blue-600" href="https://www.facebook.com/diecastgaragesale">https://www.facebook.com/diecastgaragesale</p></a>
    <p>Instagram: <a href="#">@diecast_garage_sale</p></a>
</div>

@endsection
