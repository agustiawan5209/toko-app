<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Produk') }}

    </h2>
</x-slot>

<div class="py-2">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            @if (session()->has('message'))
            <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                <p>{{session('message')}}</p>
              </div>
            @endif
            {{-- Modal Insert Item --}}
            <div class="p-4">
                <x-jet-button wire:click="addingItem" wire:loading.attr="disabled">
                    {{ __('Add Item') }}
                </x-jet-button>

                <!-- Add Item Modal -->
                <x-jet-dialog-modal wire:model="addItem">
                    <form>
                        @csrf
                        <x-slot name="title">
                            {{ __('Tambahlan Produk') }}
                        </x-slot>

                        <x-slot name="content">
                            <div class="rounded-md shadow-sm -space-y-px">
                                <div class="grid gap-6">
                                    <div class="col-span-12">
                                        <label for="first_name" class="block text-sm font-medium text-gray-700">Kode Produk</label>
                                        <input type="text"   class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required auto-complete="current-kodeProduk" placeholder="kode" value="{{ $kodeProduk }}">
                                        <x-jet-button wire:click.prevent="autoCode()">
                                            Buat Kode
                                        </x-jet-button>
                                        @error('kodeProduk') <span class="text-red-500">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="col-span-12">
                                        <label for="email_address" class="block text-sm font-medium text-gray-700">Tanggal Produk</label>
                                        <input type="date" name="tgl_Produk" wire:model='tgl_Produk' id="tgl_Produk" required autocomplete="current-tgl_Produk" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $tgl_Produk}}">
                                        @error('tgl_Produk') <span class="text-red-500">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-span-12">
                                    <label for="email_address" class="block text-sm font-medium text-gray-700">Jumlah Produk</label>
                                    <input type="number" name="tgl_Produk" wire:model='jmlh_produk' id="tgl_Produk" required autocomplete="current-tgl_Produk" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $tgl_Produk}}">
                                    @error('jmlh_produk') <span class="text-red-500">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </x-slot>

                        <x-slot name="footer">
                            <x-jet-danger-button wire:click="$toggle('addItem')" wire:loading.attr="disabled">
                                {{ __('Cancel') }}
                                </x-jet-button>
                                <x-jet-button wire:click.prevent="Saved()" name="simpan" type="button">
                                    {{ __('Tambah Data') }}
                                </x-jet-button>
                        </x-slot>
                    </form>
                </x-jet-dialog-modal>
                <span x-data="{ userSaved: @entangle('userSaved') }" >
                    <x-jet-action-message class="mr-3 text-red-600" on="saved" x-show='userSaved'>
                        <div class="bg-red-100 border border-red-400 w-40 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Berhasil</strong>
                            <span class="block sm:inline">Disimpan</span>
                            <span class="absolute top-0 bottom-0 right-0 px-4 py-3" wire:click.prevent="closeFlash()">
                              <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                            </span>
                          </div>
                    </x-jet-action-message>
                </span>
            </div>
            {{-- Datatable livewire --}}
            <section>
                <livewire:produk-table />
            </section>

        </div>
    </div>
</div>

