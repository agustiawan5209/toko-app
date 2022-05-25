<!-- This example requires Tailwind CSS v2.0+ -->
<div class="py-2">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Detail</h3>
                </div>
                <div class="border-t border-gray-200">
                    <dl>
                        @if (empty($arr['Image']))
                        <hr>
                        @else
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Foto</dt>
                            <dd class="mt-1 text-sm font-bold text-gray-900 sm:mt-0 sm:col-span-2">
                                <img class="object-contain h-24 w-24 hover:object-scale-down"
                                src="{{ asset('storage/upload/' . $arr['Image']) }}" alt=""></dd>
                        </div>
                        @endif
                        @foreach ($arr as $value => $key)
                            @if (empty($value))
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">{{ $value }}</dt>
                                </div>
                            @elseif(empty($key))
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dd class="mt-1 text-sm font-bold text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ $key }}</dd>
                                </div>
                            @elseif ($value && $key)
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">{{ $value }}</dt>
                                    <dd class="mt-1 text-sm font-bold text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ $key }}</dd>
                                </div>
                            @endif
                        @endforeach
                        <div>
                           <a href="{{url()->previous()}}">
                            <x-jet-button class=" static right-11">Kembali</x-jet-button>
                           </a>
                        </div>
                        </span>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
