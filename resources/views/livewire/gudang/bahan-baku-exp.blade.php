<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Input Bahan Baku Jadi') }}
    </h2>
</x-slot>

<div class="py-2">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

            <div class="flex space-x-2 justify-center grid-cols-4">

                @foreach ($stock_bahan_tersedia as $stocks)
                    <div class="border-t border-gray-200 bg-white shadow-lg mx-auto w-96 max-w-full text-sm pointer-events-auto bg-clip-padding rounded-lg block"
                        id="static-example" role="alert" aria-live="assertive" aria-atomic="true"
                        data-mdb-autohide="false">
                        <div
                            class=" bg-white flex justify-between items-center py-2 px-3 bg-clip-padding border-b border-gray-200 rounded-t-lg">
                            <p class="font-bold text-gray-500 text-lg">{{ $stocks->default_stock->bahan_baku }}</p>
                            <div class="flex items-center">
                                <p class="text-gray-600 text-xs">
                                    @if (empty($stocks->updated_at))
                                        {{ $stocks->created_at }}
                                    @else
                                        {{ $stocks->updated_at }}
                                    @endif
                                </p>
                                <button type="button"
                                    class=" btn-close box-content w-4 h-4 ml-2 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                                    data-mdb-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>
                        <div class="p-3 bg-white rounded-b-lg break-words text-gray-700 text-lg">
                            Jumlah Stock <span class="text-indigo-500">{{ $stocks->jumlah_stock }}</span> Dus
                        </div>
                    </div>
                @endforeach
            </div>
            <br>
            <div class="py-4 px-6 border-t-2 border-b-2 border-gray-400 grid grid-cols-2 gap-2">
                <div class="max-w-md">
                    <form
                        class="bg-white outline-1 border-1 border-indigo-500 hover:outline-indigo-700 shadow-md rounded px-8 pt-6 pb-8 mb-4">
                        <div class=" text-center">
                            Masukkan Jumlah Produk Jadi Hari Ini
                        </div>
                        <div>
                            <x-jet-input type="text" wire:model='produk_jadi' class="block w-full"
                                wire:model='produk_jadi' value="{{ __('') }}" />
                            <x-jet-button type='button' wire:click.prevent='Proses' class="bg-indigo-500 hover:bg-indigo-500">
                                Proses</x-jet-button>
                            @error('produk_jadi')
                                <span>{{ $message }}</span>
                            @enderror
                            <p class="text-xs text-gray-500 capitalize">Masukkan Jumlah Stock Yang DiPakai</p>
                        </div>
                    </form>
                </div>
                <div class="max-w-xl ">

                    <ol class="border-l md:border-l-0 md:border-t border-gray-300 md:flex md:justify-around md:gap-2">
                        <li>
                            <div class="flex md:block flex-start items-center pt-2 md:pt-0">
                                <div class="bg-gray-300 w-2 h-2 rounded-full -ml-1 md:ml-0 mr-3 md:mr-0 md:-mt-1"></div>
                                <p class="text-gray-500 text-sm mt-2">01.07.2021</p>
                            </div>
                            <div class="mt-0.5 ml-4 md:ml-0 pb-5">
                                <h4 class="text-gray-800 font-semibold text-xl mb-1.5">Dus</h4>
                                <h4>{{ $DUS_dus }}</h4>
                            </div>
                        </li>
                        <li>
                            <div class="flex md:block flex-start items-center pt-2 md:pt-0">
                                <div class="bg-gray-300 w-2 h-2 rounded-full -ml-1 md:ml-0 mr-3 md:mr-0 md:-mt-1"></div>
                                <p class="text-gray-500 text-sm mt-2">13.09.2021</p>
                            </div>
                            <div class="mt-0.5 ml-4 md:ml-0 pb-5">
                                <h4 class="text-gray-800 font-semibold text-xl mb-1.5">Pipet</h4>
                                <h4>{{ $DUS_pipet }}</h4>
                            </div>
                        </li>
                        <li>
                            <div class="flex md:block flex-start items-center pt-2 md:pt-0">
                                <div class="bg-gray-300 w-2 h-2 rounded-full -ml-1 md:ml-0 mr-3 md:mr-0 md:-mt-1"></div>
                                <p class="text-gray-500 text-sm mt-2">25.11.2021</p>
                            </div>
                            <div class="mt-0.5 ml-4 md:ml-0 pb-5">
                                <h4 class="text-gray-800 font-semibold text-xl mb-1.5">Cup</h4>
                                <h4>{{ $DUS_cup }}</h4>
                            </div>
                        </li>
                        <li>
                            <div class="flex md:block flex-start items-center pt-2 md:pt-0">
                                <div class="bg-gray-300 w-2 h-2 rounded-full -ml-1 md:ml-0 mr-3 md:mr-0 md:-mt-1"></div>
                                <p class="text-gray-500 text-sm mt-2">25.11.2021</p>
                            </div>
                            <div class="mt-0.5 ml-4 md:ml-0 pb-5">
                                <h4 class="text-gray-800 font-semibold text-xl mb-1.5">Penutup</h4>
                                <h4>{{ $DUS_penutup }}</h4>
                            </div>
                        </li>
                        <li>
                            <div class="flex md:block flex-start items-center pt-2 md:pt-0">
                                <div class="bg-gray-300 w-2 h-2 rounded-full -ml-1 md:ml-0 mr-3 md:mr-0 md:-mt-1"></div>
                                <p class="text-gray-500 text-sm mt-2">25.11.2021</p>
                            </div>
                            <div class="mt-0.5 ml-4 md:ml-0 pb-5">
                                <h4 class="text-gray-800 font-semibold text-xl mb-1.5">Lakban</h4>
                                <h4>{{ $DUS_lakban }}</h4>
                            </div>
                        </li>
                    </ol>
                </div>
            </div>
            <br>
            <div class="block justify-center items-center px-2 md:justify-start">
                <div class="flex space-x-2 justify-center grid-cols-5 gap-2">
                    <div class="border-t border-gray-200 bg-white shadow-lg mx-auto w-96 max-w-full text-sm pointer-events-auto bg-clip-padding rounded-lg block"
                        id="static-example" role="alert" aria-live="assertive" aria-atomic="true"
                        data-mdb-autohide="false">
                        <div
                            class=" bg-white flex justify-around items-center py-2 px-3 bg-clip-padding border-b border-gray-200 rounded-t-lg">
                            <p class="font-bold text-gray-500 text-lg">Dus</p>
                            <div class="flex items-center">
                            </div>
                        </div>
                        <div class="p-3 bg-white rounded-b-lg break-words text-gray-700 text-lg">
                            <x-jet-input type='number' wire:change='Ceks' wire:model='dus' class="block mt-1 w-full"
                                value="" />
                            @error('dus')
                                <span>{{ $message }}</span>
                            @enderror
                            <p class="text-xs text-gray-500 capitalize">Masukkan Jumlah Stock Yang DiPakai</p>
                        </div>
                    </div>
                    <div class="border-t border-gray-200 bg-white shadow-lg mx-auto w-96 max-w-full text-sm pointer-events-auto bg-clip-padding rounded-lg block"
                        id="static-example" role="alert" aria-live="assertive" aria-atomic="true"
                        data-mdb-autohide="false">
                        <div
                            class=" bg-white flex justify-around items-center py-2 px-3 bg-clip-padding border-b border-gray-200 rounded-t-lg">
                            <p class="font-bold text-gray-500 text-lg">Pipet</p>
                            <div class="flex items-center">
                            </div>
                        </div>
                        <div class="p-3 bg-white rounded-b-lg break-words text-gray-700 text-lg">
                            <x-jet-input type='number' wire:change='Ceks' wire:model='pipet' class="block mt-1 w-full"
                                value="" />
                            @error('pipet')
                                <span>{{ $message }}</span>
                            @enderror
                            <p class="text-xs text-gray-500 capitalize">Masukkan Jumlah Stock Yang DiPakai</p>
                        </div>
                    </div>
                    <div class="border-t border-gray-200 bg-white shadow-lg mx-auto w-96 max-w-full text-sm pointer-events-auto bg-clip-padding rounded-lg block"
                        id="static-example" role="alert" aria-live="assertive" aria-atomic="true"
                        data-mdb-autohide="false">
                        <div
                            class=" bg-white flex justify-around items-center py-2 px-3 bg-clip-padding border-b border-gray-200 rounded-t-lg">
                            <p class="font-bold text-gray-500 text-lg">Cup</p>
                            <div class="flex items-center">
                            </div>
                        </div>
                        <div class="p-3 bg-white rounded-b-lg break-words text-gray-700 text-lg">
                            <x-jet-input type='number' wire:change='Ceks' wire:model='cup' class="block mt-1 w-full"
                                value="" />
                            @error('cup')
                                <span>{{ $message }}</span>
                            @enderror
                            <p class="text-xs text-gray-500 capitalize">Masukkan Jumlah Stock Yang DiPakai</p>
                        </div>
                    </div>
                    <div class="border-t border-gray-200 bg-white shadow-lg mx-auto w-96 max-w-full text-sm pointer-events-auto bg-clip-padding rounded-lg block"
                        id="static-example" role="alert" aria-live="assertive" aria-atomic="true"
                        data-mdb-autohide="false">
                        <div
                            class=" bg-white flex justify-around items-center py-2 px-3 bg-clip-padding border-b border-gray-200 rounded-t-lg">
                            <p class="font-bold text-gray-500 text-lg">Penutup</p>
                            <div class="flex items-center">
                            </div>
                        </div>
                        <div class="p-3 bg-white rounded-b-lg break-words text-gray-700 text-lg">
                            <x-jet-input type='number' wire:change='Ceks' wire:model='penutup' class="block mt-1 w-full"
                                value="" />
                            @error('penutup')
                                <span>{{ $message }}</span>
                            @enderror
                            <p class="text-xs text-gray-500 capitalize">Masukkan Jumlah Stock Yang DiPakai</p>
                        </div>
                    </div>
                    <div class="border-t border-gray-200 bg-white shadow-lg mx-auto w-96 max-w-full text-sm pointer-events-auto bg-clip-padding rounded-lg block"
                        id="static-example" role="alert" aria-live="assertive" aria-atomic="true"
                        data-mdb-autohide="false">
                        <div
                            class=" bg-white flex justify-around items-center py-2 px-3 bg-clip-padding border-b border-gray-200 rounded-t-lg">
                            <p class="font-bold text-gray-500 text-lg">Lakban</p>
                            <div class="flex items-center">
                            </div>
                        </div>
                        <div class="p-3 bg-white rounded-b-lg break-words text-gray-700 text-lg">
                            <x-jet-input type='number' wire:change='Ceks' wire:model='lakban' class="block mt-1 w-full"
                                value="" />
                            @error('lakban')
                                <span>{{ $message }}</span>
                            @enderror
                            <p class="text-xs text-gray-500 capitalize">Masukkan Jumlah Stock Yang DiPakai</p>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center py-4">

                    @if (session()->has('message'))
                        <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
                            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <path
                                    d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
                            </svg>
                            <p>{{ session('message') }}</p>
                        </div>
                    @else
                        <x-jet-button type="button" wire:click='Update' class="w-[24rem] h-12 justify-center">Proses
                        </x-jet-button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Add Item Modal -->
