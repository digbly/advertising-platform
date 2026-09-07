@extends('admin::layouts.admin')

@section('title', __('admin.settings.page_title') . ' - ' . config('app.name'))

@section('page-title', __('admin.settings.page_title'))

@section('content')
    {{-- Page header --}}
    <div class="mb-6">
        <h2 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ __('admin.settings.page_title') }}</h2>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('admin.settings.page_description') }}</p>
    </div>

    {{-- Success message --}}
    @if (session('success'))
        <div class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-700 dark:border-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300">
            {{ session('success') }}
        </div>
    @endif

    {{-- Validation errors --}}
    @if ($errors->any())
        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700 dark:border-red-800 dark:bg-red-900/30 dark:text-red-300">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.settings.update') }}">
        @csrf
        @method('PUT')

        {{-- General --}}
        <x-admin::settings.card title="General">
            <x-admin::settings.field
                name="site_title"
                label="Site Title"
                description="The title of the website."
            >
                <x-admin::input name="site_title" id="site_title" :value="$values['site_title'] ?? ''" required />
            </x-admin::settings.field>

            <x-admin::settings.field
                name="site_name"
                label="Site Name"
                description="The display name of the website."
            >
                <x-admin::input name="site_name" id="site_name" :value="$values['site_name'] ?? ''" required />
            </x-admin::settings.field>

            <x-admin::settings.field
                name="site_description"
                label="Site Description"
                description="A short description of the website."
            >
                <x-admin::input name="site_description" id="site_description" :value="$values['site_description'] ?? ''" />
            </x-admin::settings.field>
        </x-admin::settings.card>

        {{-- Save button --}}
        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.dashboard') }}"
                class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 dark:hover:bg-gray-800">
                {{ __('admin.settings.cancel') }}
            </a>
            <button type="submit"
                class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition-colors hover:bg-indigo-500">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
                {{ __('admin.settings.save') }}
            </button>
        </div>
    </form>
@endsection
