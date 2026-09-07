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
        <div class="mb-6 rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-800">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">General</h3>
            </div>
            <div class="divide-y divide-gray-100 dark:divide-gray-800">

                {{-- Site Title --}}
                <div class="px-6 py-5">
                    <div class="flex flex-col gap-1 sm:flex-row sm:items-start sm:justify-between">
                        <div class="min-w-0 flex-1">
                            <label for="site_title" class="block text-sm font-medium text-gray-900 dark:text-white">Site Title</label>
                            <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">The title of the website.</p>
                        </div>
                        <div class="mt-2 w-full sm:mt-0 sm:ml-6 sm:w-96">
                            <input type="text" id="site_title" name="site_title"
                                value="{{ old('site_title', $values['site_title'] ?? '') }}"
                                required
                                class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm transition-colors placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:placeholder:text-gray-500 dark:focus:border-indigo-400" />
                            @error('site_title')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Site Name --}}
                <div class="px-6 py-5">
                    <div class="flex flex-col gap-1 sm:flex-row sm:items-start sm:justify-between">
                        <div class="min-w-0 flex-1">
                            <label for="site_name" class="block text-sm font-medium text-gray-900 dark:text-white">Site Name</label>
                            <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">The display name of the website.</p>
                        </div>
                        <div class="mt-2 w-full sm:mt-0 sm:ml-6 sm:w-96">
                            <input type="text" id="site_name" name="site_name"
                                value="{{ old('site_name', $values['site_name'] ?? '') }}"
                                required
                                class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm transition-colors placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:placeholder:text-gray-500 dark:focus:border-indigo-400" />
                            @error('site_name')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Site Description --}}
                <div class="px-6 py-5">
                    <div class="flex flex-col gap-1 sm:flex-row sm:items-start sm:justify-between">
                        <div class="min-w-0 flex-1">
                            <label for="site_description" class="block text-sm font-medium text-gray-900 dark:text-white">Site Description</label>
                            <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">A short description of the website.</p>
                        </div>
                        <div class="mt-2 w-full sm:mt-0 sm:ml-6 sm:w-96">
                            <input type="text" id="site_description" name="site_description"
                                value="{{ old('site_description', $values['site_description'] ?? '') }}"
                                class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm transition-colors placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:placeholder:text-gray-500 dark:focus:border-indigo-400" />
                            @error('site_description')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

            </div>
        </div>

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
