@props([
    'label' => '',
    'name' => '',
    'type' => 'text',
    'value' => '',
    'placeholder' => '',
    'autocomplete' => '',
    'required' => false,
    'autofocus' => false,
    'icon' => null,
    'error' => null,
])

<div>
    @if ($label)
        <label for="{{ $name }}" class="auth-label">{{ $label }}</label>
    @endif

    <div class="relative">
        @if ($icon)
            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-500">
                {!! $icon !!}
            </span>
        @endif

        <input
            id="{{ $name }}"
            name="{{ $name }}"
            type="{{ $type }}"
            value="{{ $value }}"
            placeholder="{{ $placeholder }}"
            autocomplete="{{ $autocomplete }}"
            @if ($required) required @endif
            @if ($autofocus) autofocus @endif
            @if ($error) aria-invalid="true" aria-describedby="{{ $name }}-error" @endif
            class="auth-input {{ $icon ? 'auth-input-icon' : '' }} {{ $error ? 'border-rose-500/50 focus:border-rose-400 focus:ring-rose-400/20' : '' }}"
        >
    </div>

    @if ($error)
        <p id="{{ $name }}-error" class="auth-error">{{ $error }}</p>
    @endif
</div>
