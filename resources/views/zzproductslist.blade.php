@extends("layouts.app")
@section("title", "Produtos")
@section("content")

<div class="">
    
  @forelse ($productslist as $product)


    <div class="py-1 w-full gap-3 flex-wrap flex justify-center items-center">

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


        {{-- <div class="w-60 bg-white rounded transform transition-all hover:-translate-y-2 duration-300 shadow-lg hover:shadow-2xl">
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
        </div> --}}

    </div>
        
  @empty
      <tr><td>Lista Vazia</td></tr>
  @endforelse



</div>

@endsection

{{-- <script>
    function openForm() {
      document.querySelector('#open').classList.toggle('hidden')
    }
    openForm()
</script> --}}
