<div class="flex items-center justify-center">
    @if ($status == 'Belum Selesai')
        <x-jet-button class="bg-red-500 hover:bg-red-600 whitespace-nowrap" wire:click="OpenModal">
            {{ $status }}
        </x-jet-button>
    @else
        <x-jet-button class="bg-green-500 hover:bg-green-600" wire:click="OpenModal">
            {{ $status }}
        </x-jet-button>
    @endif


</div>
<x-jet-confirmation-modal wire:model="confirmingUserChange" maxWidth='md'>
    <x-slot name="title">
        {{ $kode }}
    </x-slot>

    <x-slot name="content">
        Apakah Anda Ingin Mengubah Status Pemesanan?
        <div>
            <button type="button" wire:click='ChangeNot({{ $id }})' wire:loading.attr='disabled'
                class="inline-block px-5 py-2 mx-auto text-white bg-red-600 rounded-full hover:bg-red-700 md:mx-0">
                Belum Selesai
            </button>
            <button type="button" wire:click='ChangeYes({{ $id }})' wire:loading.attr='disabled'
                class="inline-block px-5 py-2 mx-auto text-white bg-blue-600 rounded-full hover:bg-blue-700 md:mx-0">
                Selesai
            </button>
        </div>
    </x-slot>

    <x-slot name="footer">
        <div class="flex-row justify-between rounded-md shadow-sm" role="group">
            <x-jet-button type="button" wire:click="$toggle('confirmingUserChange')" wire:loading.attr="disabled">
                Batalkan
            </x-jet-button>

        </div>
    </x-slot>
</x-jet-confirmation-modal>
