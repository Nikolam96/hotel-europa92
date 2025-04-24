<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Room Details') }}
        </h2>
    </x-slot>

    <div class="mx-8 py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="rounded-lg bg-white p-6 shadow-lg">
                <div class="mb-6">
                    {{-- Image --}}
                    <img class="h-96 w-full rounded-lg object-cover" src="https://picsum.photos/800"
                        alt="{{ $room->name }}">
                </div>
                {{-- Name --}}
                <div class="mb-4">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $room->name }}</h1>
                </div>
                {{-- Description --}}
                <div class="mb-4">
                    <p class="text-lg text-gray-700 dark:text-gray-300">{{ $room->long_description }}</p>
                </div>
                {{-- Price --}}
                <div class="mb-4">
                    <span class="text-2xl font-semibold text-indigo-600 dark:text-indigo-400">
                        ${{ number_format($room->price, 2) }}
                    </span>
                </div>
                <div class="mt-6 space-x-3">
                    {{-- Back --}}
                    <a href="{{ route('room.index') }}"
                        class="text-indigo-600 hover:text-indigo-700 hover:underline dark:text-indigo-400 dark:hover:text-indigo-300">
                        &larr; Back
                    </a>
                    {{-- Reserve --}}
                    <a href="{{ route('reservation.create', ['id' => $room->id]) }}"
                        class="rounded-md bg-green-100 px-4 py-2 text-green-700 transition-all duration-300 hover:bg-green-200 hover:text-green-800 dark:text-green-400 dark:hover:text-green-300">
                        Reserve
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
