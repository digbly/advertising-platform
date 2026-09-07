@props([
    'label' => null,
    'description' => null,
    'name' => null,
    'for' => null,
])

<div class="px-6 py-5">
    <div class="flex flex-col gap-1 sm:flex-row sm:items-start sm:justify-between">
        <div class="min-w-0 flex-1">
            @if ($label)
                <label for="{{ $for ?? $name }}" class="block text-sm font-medium text-gray-900 dark:text-white">{{ $label }}</label>
            @endif
            @if ($description)
                <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">{{ $description }}</p>
            @endif
        </div>

        <div class="mt-2 w-full sm:mt-0 sm:ml-6 sm:w-96">
            {{ $slot }}

            @if ($name)
                @error($name)
                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            @endif
        </div>
    </div>
</div>
