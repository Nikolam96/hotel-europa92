@props(['label', 'name', 'type' => 'text', 'required' => true])

<div class="mb-4">
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
        {{ __($label) }}
    </label>

    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ old($name) }}"
        @if ($required) required @endif
        {{ $attributes->merge([
            'class' => 'mt-1 block w-full rounded-md shadow-sm ' . ($errors->has($name) ? 'border-red-500' : 'border-gray-300'),
        ]) }}>

    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ __($message) }}</p>
    @enderror
</div>
