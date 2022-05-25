<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Barang Keluar') }}

    </h2>
</x-slot>

<div class="py-2">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            {{-- Modal --}}
            <div>
                <span x-data="{ userSaved: @entangle('userSaved') }">
                    <x-jet-action-message class="mr-3 text-red-600" on="submit" x-show='userSaved'>
                        <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert"
                            wire:click='CloseModal'>
                            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <path
                                    d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
                            </svg>
                            <p>{{ session('message') }}</p>
                        </div>
                    </x-jet-action-message>
                </span>
                <br>
                <x-jet-button wire:click="OpenModal" wire:loading.attr="disabled">
                    {{ __('Tambah Barang Keluar') }}
                </x-jet-button>

                <!-- Add Item Modal -->
                <x-jet-dialog-modal wire:model="addItem" maxWidth='md'>
                    <form>
                        @csrf
                        <x-slot name="title">
                            {{ __('Tambahkan Barang Keluar') }}
                        </x-slot>

                        <x-slot name="content">
                            <div>
                                <x-jet-label for="" value="{{ __('Kode-Barang Keluar') }}" />
                                <div class="flex flex-row justify-start items-center">
                                    <div>
                                        <x-jet-input name='KBK' class="block mt-2 w-full" type='text' wire:model='KBK' />
                                        @error('KBK')
                                            <span class="text-red-500 text-xs italic">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <x-jet-button type='button' class="block h-8" wire:click='generateKode'>
                                        Buat Kode
                                    </x-jet-button>
                                </div>
                            </div>
                            <div>
                                <x-jet-label for="" value="{{ __('Alamat') }}" />
                                <x-jet-input name='alamat' class="block mt-2 w-full" type='text' wire:model='alamat' />
                                @error('alamat')
                                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <x-jet-label for="" value="{{ __('Tanggal Keluar') }}" />
                                <x-jet-input name='tgl' class="block mt-2 w-full" type='date' wire:model='tgl' />
                                @error('tgl')
                                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <x-jet-label for="" value="{{ __('Customer') }}" />
                                <x-jet-input name='tgl' class="block mt-2 w-full" type='text' wire:model='customer' />
                                <p class="text-gray-400 text-sm font-serif">Kosongkan Jika Tidak Ada</p>
                                @error('customer')
                                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <x-jet-label for="" value="{{ __('Kode Produk') }}" />
                                <select id="supplier"
                                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                                    wire:model='kode_produk' name="gender">
                                    <option value="--">--Pilih--</option>
                                    @foreach ($produk as $produk)
                                        <option value='{{ $produk->id }}'>{{ $produk->kode_stock_produk }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-jet-label for="" value="{{ __('Jumlah Pembelian') }}" />
                                <x-jet-input name='KBM' class="block mt-2 w-full" wire:keyup="getTotal"
                                    wire:model='jumlah' type='text' />
                                @error('jumlah')
                                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <x-jet-label for="" value="{{ __('Sub_total') }}" />
                                <x-jet-input name='KBM' wire:model='sub_total' class="block mt-2 w-full" type='text' />
                            </div>
                        </x-slot>

                        <x-slot name="footer">
                            <x-jet-danger-button wire:click="CloseModal" wire:loading.attr="disabled">
                                {{ __('Cancel') }}
                            </x-jet-danger-button>
                            <x-jet-button type="button" wire:click.prevent='submit'>
                                {{ __('Tambah Data') }}
                            </x-jet-button>
                        </x-slot>
                    </form>
                </x-jet-dialog-modal>
            </div>
            <livewire:datatable.barang-keluar-table />
        </div>
    </div>
</div>
