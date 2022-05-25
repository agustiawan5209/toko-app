<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 lg:pb-6">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg sm:pb-1 pb-6 lg:pb-6 ">
                <livewire:master.dashboard />
            </div>
        </div>
    </div>
</x-app-layout>
