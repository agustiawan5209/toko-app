@extends('layouts.toko')
@section('Content')
    @include('Toko.StockPage')

    <!-- Section 1 -->

    <!-- Section 1 -->
    <section class="px-2 py-32 md:px-0 bg-gray-200">
        <div class="container items-center max-w-6xl px-8 mx-auto xl:px-5">
            <div class="flex flex-wrap items-center sm:-mx-3">
                <div class="w-full md:w-1/2 md:px-3">
                    <div
                        class="w-full pb-6 space-y-6 sm:max-w-md lg:max-w-lg md:space-y-4 lg:space-y-8 xl:space-y-9 sm:pr-5 lg:pr-0 md:pb-0">
                        <h1
                            class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl md:text-4xl lg:text-5xl xl:text-6xl">
                            <span class="block xl:inline">Produk</span>
                            <span class="block text-indigo-600 xl:inline">HAUDz CV.THAHIRA</span>
                        </h1>
                        <p class="mx-auto text-base text-gray-500 sm:max-w-md lg:text-xl md:max-w-3xl">HAUDH CV.THAHIRA
                            Merupakan Perusahaan Yang Memproduksi Air Mineral</p>
                    </div>
                </div>
                <div class="w-full md:w-1/2">
                    <div class="w-full h-auto overflow-hidden rounded-md shadow-xl sm:rounded-xl">
                        <img src="https://cdn.devdojo.com/images/november2020/hero-image.jpeg" class="">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Section 2 -->
    {{-- <section class="flex items-center justify-center py-10 text-white bg-white sm:py-16 md:py-24 lg:py-32">
    <div class="relative max-w-3xl px-10 text-center text-white auto lg:px-0">
        <div class="flex flex-col w-full md:flex-row">

            <!-- Top Text -->
            <div class="flex justify-between">
                <h1 class="relative flex flex-col text-6xl font-extrabold text-left text-black">
                    Crafting
                    <span>Powerful</span>
                    <span>Experiences</span>
                </h1>
            </div>
            <!-- Right Image -->
            <div class="relative top-0 right-0 h-64 mt-12 md:-mt-16 md:absolute md:h-96">
                <img src="https://cdn.devdojo.com/images/december2020/designs3d.png" class="object-cover mt-3 mr-5 h-80 lg:h-96">
            </div>
        </div>

        <!-- Separator -->
        <div class="my-16 border-b border-gray-300 lg:my-24"></div>

        <!-- Bottom Text -->
        <h2 class="text-left text-gray-500 xl:text-xl">
            Building beautiful designs for your next project. We've unlocked the secret to converting visitors into customers. Download our re-usable and extandable components today.
        </h2>
    </div>
</section> --}}
@endsection
@section('footer')
    <!-- Section 1 -->
    <section class="text-gray-700 bg-white body-font">
        <div class="container flex flex-col items-center px-8 py-8 mx-auto max-w-7xl sm:flex-row">
            <a href="#_" class="text-xl font-black leading-none text-gray-900 select-none logo">CV. THAHIRA<span
                    class="text-indigo-600">.</span></a>
            <p class="mt-4 text-sm text-gray-500 sm:ml-4 sm:pl-4 sm:border-l sm:border-gray-200 sm:mt-0">Jl. Poros Bulukumba-Sinjai No.km 174, Bulo Lohe, Kec. Rilau Ale, Kabupaten Bulukumba, Sulawesi Selatan 92552
            </p>
            <span class="inline-flex justify-center items-center mt-4 space-x-5 sm:ml-auto sm:mt-0 sm:justify-start">
                <p class="flex items-center justify-center md:justify-start mb-4">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="phone"
                      class="w-4 mr-4" role="img" xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 512 512">
                      <path fill="currentColor"
                        d="M493.4 24.6l-104-24c-11.3-2.6-22.9 3.3-27.5 13.9l-48 112c-4.2 9.8-1.4 21.3 6.9 28l60.6 49.6c-36 76.7-98.9 140.5-177.2 177.2l-49.6-60.6c-6.8-8.3-18.2-11.1-28-6.9l-112 48C3.9 366.5-2 378.1.6 389.4l24 104C27.1 504.2 36.7 512 48 512c256.1 0 464-207.5 464-464 0-11.2-7.7-20.9-18.6-23.4z">
                      </path>
                    </svg>
                    0813-5091-8252
                  </p>
            </span>
        </div>
    </section>
@endsection
