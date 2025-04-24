<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Rooms') }}
        </h2>
    </x-slot>

    <div class="mx-8 py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            {{-- No Rooms --}}
            @if ($rooms->isEmpty())
                <h1 class="mt-6 text-center text-lg text-gray-700 dark:text-gray-300">{{ __('No Rooms') }}</h1>
            @else
                <div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($rooms as $room)
                        {{-- Card --}}
                        <div
                            class="overflow-hidden rounded-2xl bg-white shadow-md transition-all duration-300 hover:scale-105 hover:shadow-xl dark:bg-gray-700">
                            <a href="{{ route('room.show', ['room' => $room->id]) }}">
                                {{-- Image --}}
                                <img class="h-48 w-full object-cover" src="{{ $room->image }}" alt="{{ $room->name }}">
                                <div class="p-4">
                                    {{-- Name --}}
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ __($room->name) }}
                                    </h3>
                                    {{-- Description --}}
                                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-300">
                                        {{ __($room->short_description) }}
                                    </p>
                                    <div class="mt-4">
                                        {{-- Price --}}
                                        <span class="text-lg font-semibold text-indigo-600 dark:text-indigo-300">
                                            ${{ $room->price }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
            <div class="mt-8">{{ $rooms->links() }}</div>

        </div>
    </div>
</x-app-layout>
