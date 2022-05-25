<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ $table }}, {{ $table }}, {{ $linkID }}
    </h2>
</x-slot>

<div class="py-2">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden  sm:rounded-lg bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="w-full">
                <form enctype="multipart/form-data">
                    @csrf
                    {{-- @method('PUT') --}}
                    @if ($table == 'Produk')
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                kode Stock Produk
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                wire:model.defer='item1' type="text" placeholder="Username">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                Tanggal Stock Produk
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                wire:model.defer='item2' type="date" placeholder="Tanggal" value="{{ $item2 }}">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                Jumlah Stock Produk Yang Tersedia
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                wire:model.defer='item3' type="number" placeholder="Jumlah Stock Yang tersedia"
                                value="{{ $item3 }}">
                        </div>
                    @elseif ($table == 'Customer')
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                Nama Customer
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="nm_customer" wire:model.defer='item1' type="text" placeholder="Username">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                Nomor Telpon
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="no_telpon" wire:model.defer='item2' type="text" placeholder="Nomor TelponF">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                Alamat
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="alamat" wire:model.defer='item3' type="text" placeholder="Alamat">
                        </div>
                    @elseif ($table == 'Supplier')
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                Nama Supplier
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="nm_customer" wire:model.defer='item1' type="text" placeholder="Username">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                Nomor Telpon
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="no_telpon" wire:model.defer='item2' type="text" placeholder="Nomor TelponF">
                        </div>
                    @elseif ($table == 'Barang-Masuk')
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                Kode Barang Keluar
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="nm_customer" wire:model.defer='item1' type="text" readonly>
                        </div>
                        <div>
                            <x-jet-label for="" value="{{ __('Supplier') }}" />
                            <select id="supplier"
                                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                                wire:model='supplier' name="gender" wire:change='getBahan'>
                                <option value="{{ $item3 }}">{{ $item3 }}</option>
                                @if (!empty($sup))
                                    @foreach ($sup as $sups)
                                        <option value='{{ $sups->id }}'>{{ $sups->supplier }}</option>
                                    @endforeach
                                @else
                                @endif
                            </select>
                            @error('supplier')
                                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-row justify-around items-center">
                            <div>
                                <x-jet-label for="" value="{{ __('Bahan Baku') }}" />
                                <select id="supplier"
                                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 rounded shadow focus:outline-none focus:shadow-outline"
                                    wire:model.defer='bahan' name="bahan" wire:change='getData'>
                                    <option value="{{ $item4 }}">{{ $item2 }}</option>
                                    @if (!empty($getBB))
                                        @foreach ($getBB as $bbs)
                                            <option value='{{ $bbs->default_stock_id }}'>
                                                {{ $bbs->default_stock->bahan_baku }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('bahan')
                                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <x-jet-label for="" value="{{ __('Harga') }}" />
                                @if (empty($hargaB))
                                    <x-jet-input name='KBM' wire:model='harga' class="block mt-2 w-full" type='text'
                                        readonly />
                                @else
                                    <x-jet-input name='KBM' wire:model='hargaB' class="block mt-2 w-full" type='text'
                                        readonly />
                                @endif
                            </div>
                        </div>
                        <div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                    Jumlah
                                </label>
                                <input
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    wire:model.defer='jumlah' type='text'>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                    Tanggal Transaksi
                                </label>
                                <input
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="nm_customer" wire:model.defer='item7' type="date">
                            </div>
                        </div>
                    @elseif ($table == 'Barang-Keluar')
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                Kode Barang Keluar
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="nm_customer" wire:model.defer='item1' type="text" readonly>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                Kode Produk
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="nm_customer" wire:model.defer='item2' type="text" readonly>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                Alamat/Tujuan
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="nm_customer" wire:model.defer='item3' type="text">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                Tanggal Transaksi
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="nm_customer" wire:model.defer='item5' type="date">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                Customer
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                wire:model.defer='item4' type="text">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                Jumlah
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="nm_customer" wire:model.defer='jumlah'>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                Sub_total
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="nm_customer" wire:model.defer='sub_total' type="number" readonly>
                        </div>
                    @elseif ($table == 'bahan-baku')
                        <div>

                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                for="default_size">Default size</label>
                            <input
                                class="block mb-5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                type="file" wire:model='photo'>
                            @error('photo')
                                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                            @enderror
                            @if (!$photo)
                                Photo Preview:
                                <img class="w-28 h-28" src="{{ $photo->temporaryUrl() }}">
                            @else
                                <img class="w-28 h-28" src="{{ asset('storage/upload' . $photo) }}"
                                    alt='gambar'>
                            @endif


                        </div>
                        <div>
                            <x-jet-label for="" value="{{ __('Bahan Baku') }}" />
                            <select id="supplier"
                                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 rounded shadow focus:outline-none focus:shadow-outline"
                                wire:model.defer='item10'>
                                <option value="{{ $item10 }}">{{ $item2 }}</option>
                                @foreach ($bb as $bbs)
                                    <option value='{{ $bbs->id }}'>
                                        {{ $bbs->bahan_baku }}</option>
                                @endforeach
                            </select>
                            @error('bahan')
                                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                Isi
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="nm_customer" wire:model.defer='item3' type="number">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                Harga
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="nm_customer" wire:model.defer='item4' type="number">
                        </div>
                    @endif
                    <div class="flex items-start justify-start">
                        <x-jet-button
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="button" wire:click='edit({{ $linkID }})'>
                            Edit
                        </x-jet-button>
                        <a href="{{ url()->previous() }}">
                            <x-jet-danger-button type="button">
                                Kembali
                            </x-jet-danger-button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
