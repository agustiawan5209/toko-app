<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Bahan Baku') }}
    </h2>
</x-slot>

<div class="py-2">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            @if (session()->has('message'))
                <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert" wire:click='closeAlert'>
                    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path
                            d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
                    </svg>
                    <p>{{ session('message') }}</p>
                </div>
            @endif
            {{-- Modal Insert Item --}}
            <div class="p-4">
                <x-jet-button wire:click="openModal" wire:loading.attr="disabled">
                    {{ __('Tambah Bahan Baku') }}
                </x-jet-button>

                <!-- Add Item Modal -->
                <x-jet-dialog-modal wire:model="modal" maxWidth='7xl'>
                    <form>
                        @csrf
                        <x-slot name="title">
                            {{ __('Tambahlan Produk') }}
                        </x-slot>

                        <x-slot name="content">
                            <div action="#" class="mx-auto  rounded-md flex flex-col sm:flex-row sm:justify-evenly">
                                <div class="p-6 flex flex-col border-2 bg-white rounded-lg  border-red-50">
                                    <div class="p-2 rounded">
                                        <div class="flex justify-center">
                                            <div class="mb-3 max-w-full">
                                                <label for="formFile"
                                                    class="form-label inline-block mb-2 text-gray-700">Masukkan
                                                    Gambar</label>
                                                <input
                                                    class="form-control
                                              block
                                              w-full
                                              px-3
                                              py-1.5
                                              text-base
                                              font-normal
                                              text-gray-700
                                              bg-white bg-clip-padding
                                              border border-solid border-gray-300
                                              rounded
                                              transition
                                              ease-in-out
                                              m-0
                                              focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                                    type="file" id="formFile" wire:model='gambar'
                                                    accept="image/png, image/gif, image/jpeg">
                                            </div>
                                            <div wire:loading wire:target="gambar">Uploading...</div>
                                            @error('gambar')
                                                <p class="text-red-500 text-xs italic">Mohon Di Isi.</p>
                                            @enderror
                                        </div>
                                        <x-jet-label for="input" value="{{ __('Bahan Baku') }}" />
                                        <select id="supplier"
                                            class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 rounded shadow focus:outline-none focus:shadow-outline"
                                            wire:model.lazy='bahan' name="bahan">
                                            <option value="--">--Pilih--</option>
                                            @foreach ($def as $defs)
                                                <option value='{{ $defs->id }}'>{{ $defs->bahan_baku }}</option>
                                            @endforeach
                                        </select>
                                        @error('bahan')
                                            <p class="text-red-500 text-xs italic">Mohon Di Isi.</p>
                                        @enderror
                                    </div>


                                    <div>
                                        <x-jet-label for="input" class="text-base">Isi Satu Dus
                                        </x-jet-label>
                                        <x-jet-input id="input" wire:model='isi' class="block mt-1 w-full" type="number"
                                            name="input" required autofocus />
                                        @error('isi')
                                            <p class="text-red-500 text-xs italic">Mohon Di Isi.</p>
                                        @enderror

                                    </div>
                                    <x-jet-label for="input" value="{{ __('Harga Satu Dus') }}" />
                                    <x-jet-input id="input" wire:model='harga' class="block mt-1 w-full" type="number"
                                        name="input" required autofocus  />
                                    @error('harga')
                                        <p class="text-red-500 text-xs italic">Mohon Di Isi.</p>
                                    @enderror
                                </div>

                                <!-- address start -->
                                <div class="p-6 border-2 bg-white rounded-lg  border-red-50">
                                    <div class="block p-6 rounded-lg shadow-lg bg-red-300 max-w-md">
                                        <h5 class="text-gray-900 text-xl leading-tight font-medium mb-2">Mohon
                                            Diperhatikan</h5>
                                        <p class="text-gray-700 mb-2 text-sm">
                                            Silahkan Pilih Bentuk Pengiriman Anda <br>
                                            Jika Dalam Satu Dus berisi 24 barang, atau <br>
                                            Jika Dalam Satu Dus berisi pcs maka silahkan isi berapa jumlah dalam 1 pcs
                                            <br>
                                            Contoh Input Dus : 1 Dus = 24 Gelas <br>
                                            Contoh Input Pcs : 1 Dus = 116 Pcs isi satu pcs = 460
                                        </p>
                                    </div>
                                </div>
                                <!-- address End -->
                            </div>
                        </x-slot>

                        <x-slot name="footer">
                            <x-jet-danger-button wire:click="$toggle('modal')" wire:loading.attr="disabled">
                                {{ __('Cancel') }}
                                </x-jet-button>
                                <x-jet-button wire:click.prevent="submit()" name="simpan" type="button">
                                    {{ __('Tambah Data') }}
                                </x-jet-button>
                        </x-slot>
                    </form>
                </x-jet-dialog-modal>
            </div>
            <livewire:datatable.bahanbaku-table>

            <h1></h1>
        </div>
    </div>
</div>
<!-- component -->

