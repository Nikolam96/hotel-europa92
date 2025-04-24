<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Create Reservation') }}
        </h2>
    </x-slot>

    <div class="mx-auto max-w-2xl px-10">
        <div class="py-6">
            <form action="{{ route('reservation.store') }}" method="POST" class="mt-4" id="demo-form">
                @csrf
                <div class="mb-4 pt-6">
                    <label for="room" class="block text-sm font-medium text-gray-700">Select Room</label>
                    {{-- Select a room --}}
                    <select name="room_id" id="room" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                        required>
                        <option value="" disabled selected>Select a room</option>
                        @foreach ($rooms as $room)
                            <option value="{{ $room->id }}" @if (isset($selected) && $selected == $room->id) selected @endif>
                                <span class="font-bold">{{ $room->name }}</span> -
                                ${{ number_format($room->price, 2) }} /
                                night
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    {{-- Name --}}
                    <x-input-label label="Name" name="name" type="text" placeholder="Nikola Mitic" />
                    {{-- Email --}}
                    <x-input-label label="Email" name="email" type="email" placeholder="example@example.com" />
                    {{-- Phone --}}
                    <x-input-label label="Phone" name="phone" type="tel" placeholder="040-560-266" />
                    {{-- Start Date --}}
                    <x-input-label label="Start Date" name="startDate" type="date" min="{{ now()->toDateString() }}"
                        value="{{ old('startDate') }}" />
                    {{-- End Date --}}
                    <x-input-label label="End Date" name="endDate" type="date" min="{{ now()->toDateString() }}"
                        value="{{ old('endDate') }}" />
                    {{-- Note --}}
                    <div class="mb-4">
                        <label for="note" class="block text-sm font-medium text-gray-700">Note</label>
                        <textarea placeholder="Write something you want us to do for you!" name="note" id="note" rows="6"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('note') }}</textarea>
                    </div>
                    {{-- Submit --}}
                    <div class="mx-auto mb-4">
                        <button data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}" data-callback='onSubmit'
                            data-action='submit'
                            class="g-recaptcha max-w-md rounded-md bg-green-600 px-4 py-2 text-white hover:bg-green-700">
                            Reserve Now
                        </button>
                        {{-- Chapta Error --}}
                        @error('g-recaptcha-response')
                            <p class="text-md mt-1 text-red-600">{{ __($message) }}</p>
                        @enderror
                        {{-- Reservation Error --}}
                        @error('reservation')
                            <p class="text-md mt-1 text-red-600">{{ __($message) }}</p>
                        @enderror
                    </div>
            </form>
        </div>
    </div>

    <script>
        const startDateInput = document.getElementById('startDate');
        const endDateInput = document.getElementById('endDate');

        startDateInput.addEventListener('change', function() {
            const startDate = new Date(startDateInput.value);

            startDate.setDate(startDate.getDate() + 1);
            const endDate = startDate.toISOString().split('T')[0];
            endDateInput.setAttribute('min', endDate);
        });

        function onSubmit(token) {
            const form = document.getElementById("demo-form");

            if (form.checkValidity()) {
                return form.submit();
            }
            form.reportValidity();

        }
    </script>
</x-app-layout>
