<section class="py-20 bg-gray-600">
    <div class="container max-w-6xl mx-auto">
        <h2 class="text-4xl font-bold tracking-tight text-center shadow-lg shadow-white ring-white decoration-white underline">Stock Yang Tersedia</h2>
        <p class="mt-2 text-lg text-center text-gray-200">{{$carbon}}</p>
        <div class="grid grid-cols-4 gap-8 mt-10 sm:grid-cols-8 lg:grid-cols-12 sm:px-8 xl:px-0">

            @foreach ($Stock as $stocks)
                <div
                    class="relative flex flex-col items-center justify-between col-span-4 px-8 py-12 space-y-4 overflow-hidden bg-gray-100 sm:rounded-xl">
                    <div class="p-3 text-white bg-blue-500 rounded-full">
                        <img class="w-10 h-10 rounded-full" src="{{asset('img/flame-858.png')}}" alt="">
                    </div>
                    <h4 class="text-xl font-medium text-gray-700">{{$stocks->default_stock->bahan_baku}}</h4>
                    <p class="text-base text-center text-gray-500">Jumlah Stock Yang Tersedia Saat Ini.
                         <br> <span class="font-bold">{{number_format($stocks->jumlah_stock, 0,2)}}</span></p>
                </div>
            @endforeach
        </div>
    </div>
</section>
