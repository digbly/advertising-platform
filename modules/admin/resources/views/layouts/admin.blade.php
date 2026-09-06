<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Admin'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['modules/admin/resources/assets/css/app.css', 'modules/admin/resources/assets/js/app.js'])
    @stack('styles')
</head>
<body class="h-full bg-gray-50 text-gray-900 antialiased dark:bg-gray-950 dark:text-gray-100">

    @php
        $user = auth()->user();
        $userName = $user->name ?? 'Admin';
        $userEmail = $user->email ?? 'admin@example.com';
        $userInitial = strtoupper(mb_substr($userName, 0, 1));

        $currentLocale = app()->getLocale();
        $navigation = [
            [
                'section' => __('admin.sidebar.overview'),
                'items' => [
                    ['label' => __('admin.sidebar.dashboard'), 'icon' => 'dashboard', 'route' => 'admin.dashboard', 'active' => request()->routeIs('admin.dashboard')],
                ],
            ],
            [
                'section' => __('admin.sidebar.management'),
                'items' => [
                    ['label' => __('admin.sidebar.contacts'), 'icon' => 'contact', 'route' => '#', 'active' => false],
                    ['label' => __('admin.sidebar.users'), 'icon' => 'users', 'route' => '#', 'active' => false],
                ],
            ],
            [
                'section' => __('admin.sidebar.system'),
                'items' => [
                    ['label' => __('admin.sidebar.settings'), 'icon' => 'settings', 'route' => '#', 'active' => false],
                ],
            ],
        ];

        $icons = [
            'dashboard' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/>',
            'contact' => '<path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>',
            'users' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>',
            'settings' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>',
            'search' => '<path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>',
            'bell' => '<path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>',
            'sun' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"/>',
            'moon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z"/>',
            'menu' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>',
            'chevron-left' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>',
            'chevron-down' => '<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>',
            'logout' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/>',
            'user' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>',
            'cog' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>',
            'logo' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/>',
        ];
    @endphp

    <div class="min-h-full">
        {{-- ===================== SIDEBAR ===================== --}}
        <aside id="sidebar"
            class="fixed inset-y-0 left-0 z-40 flex w-64 -translate-x-full flex-col border-r border-gray-200 bg-white transition-all duration-300 lg:translate-x-0 lg:w-64 dark:border-gray-800 dark:bg-gray-900">

            {{-- Brand --}}
            <div class="flex h-16 shrink-0 items-center gap-3 border-b border-gray-200 px-5 dark:border-gray-800">
                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-indigo-600 text-white">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                        {!! $icons['logo'] !!}
                    </svg>
                </span>
                <span class="sidebar-brand-text truncate text-lg font-bold tracking-tight text-gray-900 dark:text-white">
                    {{ config('app.name', 'Admin') }}
                </span>
            </div>

            {{-- Nav --}}
            <nav class="flex-1 space-y-6 overflow-y-auto px-3 py-5">
                @foreach ($navigation as $group)
                    <div>
                        <p class="sidebar-section-title mb-2 px-3 text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500">
                            {{ $group['section'] }}
                        </p>
                        <ul class="space-y-1">
                            @foreach ($group['items'] as $item)
                                <li>
                                    <a href="{{ $item['route'] === '#' ? '#' : route($item['route']) }}"
                                        @class([
                                            'sidebar-nav-link group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors',
                                            'bg-indigo-50 text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-300' => $item['active'],
                                            'text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-white' => !$item['active'],
                                        ])>
                                        <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                                            {!! $icons[$item['icon']] !!}
                                        </svg>
                                        <span class="sidebar-label truncate">{{ $item['label'] }}</span>
                                        @if ($item['active'])
                                            <span class="ml-auto h-1.5 w-1.5 rounded-full bg-indigo-500"></span>
                                        @endif
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </nav>

            {{-- Footer: collapse + user --}}
            <div class="shrink-0 border-t border-gray-200 p-3 dark:border-gray-800">
                <button id="sidebar-collapse" type="button"
                    class="sidebar-nav-link hidden w-full items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-gray-600 transition-colors hover:bg-gray-100 hover:text-gray-900 lg:flex dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-white">
                    <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                        {!! $icons['chevron-left'] !!}
                    </svg>
                    <span class="sidebar-label truncate">{{ __('admin.sidebar.collapse') }}</span>
                </button>
            </div>
        </aside>

        {{-- Overlay mobile --}}
        <div id="sidebar-overlay" class="fixed inset-0 z-30 hidden bg-gray-900/50 backdrop-blur-sm lg:hidden"></div>

        {{-- ===================== MAIN ===================== --}}
        <div id="main-content" class="flex min-h-full flex-col lg:pl-64">

            {{-- Topbar --}}
            <header class="sticky top-0 z-20 border-b border-gray-200 bg-white/80 backdrop-blur-md dark:border-gray-800 dark:bg-gray-900/80">
                <div class="flex h-16 items-center gap-3 px-4 sm:px-6">
                    {{-- Mobile menu --}}
                    <button id="sidebar-toggle" type="button"
                        class="inline-flex h-10 w-10 items-center justify-center rounded-lg text-gray-500 transition-colors hover:bg-gray-100 hover:text-gray-900 lg:hidden dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                            {!! $icons['menu'] !!}
                        </svg>
                    </button>

                    {{-- Page title --}}
                    <div class="hidden min-w-0 sm:block">
                        <h1 class="truncate text-base font-semibold text-gray-900 dark:text-white">
                            @yield('page-title', __('Dashboard'))
                        </h1>
                    </div>

                    {{-- Global search --}}
                    <div id="global-search-wrap" class="relative ml-auto w-full max-w-xs sm:max-w-sm">
                        <div class="relative">
                            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 dark:text-gray-500">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                                    {!! $icons['search'] !!}
                                </svg>
                            </span>
                            <input id="global-search" type="search" autocomplete="off" placeholder="{{ __('admin.search.placeholder') }}"
                                class="w-full rounded-lg border-0 bg-gray-100 py-2.5 pl-10 pr-14 text-sm text-gray-900 placeholder-gray-400 outline-none ring-1 ring-transparent transition focus:bg-white focus:ring-2 focus:ring-indigo-500 dark:bg-gray-800 dark:text-white dark:placeholder-gray-500 dark:focus:bg-gray-900" />
                            <kbd class="pointer-events-none absolute inset-y-0 right-0 hidden items-center pr-3 text-xs font-medium text-gray-400 sm:flex dark:text-gray-500">
                                Ctrl K
                            </kbd>
                        </div>

                        {{-- Search results --}}
                        <div id="search-results" data-dropdown-menu
                            class="absolute left-0 right-0 top-full z-30 mt-2 hidden max-h-80 overflow-y-auto rounded-xl border border-gray-200 bg-white p-2 shadow-lg dark:border-gray-700 dark:bg-gray-900">
                        </div>
                    </div>

                    {{-- Right actions --}}
                    <div class="flex items-center gap-1 sm:gap-2">
                        {{-- Theme toggle --}}
                        <button id="theme-toggle" type="button" data-theme-icon
                            class="inline-flex h-10 w-10 items-center justify-center rounded-lg text-gray-500 transition-colors hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white"
                            aria-label="{{ __('admin.topbar.switch_theme') }}">
                            <svg data-icon="sun" class="hidden h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                                {!! $icons['sun'] !!}
                            </svg>
                            <svg data-icon="moon" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                                {!! $icons['moon'] !!}
                            </svg>
                        </button>

                        {{-- Notifications --}}
                        <div class="relative">
                            <button type="button" data-dropdown="notifications-menu"
                                class="inline-flex h-10 w-10 items-center justify-center rounded-lg text-gray-500 transition-colors hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white"
                                aria-label="{{ __('admin.topbar.notifications') }}" aria-expanded="false">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                                    {!! $icons['bell'] !!}
                                </svg>
                                <span class="absolute right-2 top-2 flex h-2 w-2">
                                    <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-red-400 opacity-75"></span>
                                    <span class="relative inline-flex h-2 w-2 rounded-full bg-red-500"></span>
                                </span>
                            </button>

                            <div id="notifications-menu" data-dropdown-menu
                                class="absolute right-0 top-full z-30 mt-2 hidden w-80 rounded-xl border border-gray-200 bg-white shadow-lg dark:border-gray-700 dark:bg-gray-900">
                                <div class="flex items-center justify-between border-b border-gray-100 px-4 py-3 dark:border-gray-800">
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ __('admin.topbar.notifications') }}</p>
                                    <span class="rounded-full bg-indigo-50 px-2 py-0.5 text-xs font-medium text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-300">3</span>
                                </div>
                                <div class="max-h-72 overflow-y-auto p-2">
                                    @foreach ([
                                        ['title' => __('admin.notifications.new_contact'), 'desc' => __('admin.notifications.contact_desc'), 'time' => __('admin.notifications.time_2min')],
                                        ['title' => __('admin.notifications.new_user'), 'desc' => __('admin.notifications.user_desc'), 'time' => __('admin.notifications.time_1hour')],
                                        ['title' => __('admin.notifications.weekly_report'), 'desc' => __('admin.notifications.report_desc'), 'time' => __('admin.notifications.time_1day')],
                                    ] as $notif)
                                        <a href="#" class="flex gap-3 rounded-lg px-3 py-2.5 transition-colors hover:bg-gray-50 dark:hover:bg-gray-800">
                                            <span class="mt-1.5 h-2 w-2 shrink-0 rounded-full bg-indigo-500"></span>
                                            <span class="min-w-0">
                                                <span class="block truncate text-sm font-medium text-gray-900 dark:text-white">{{ $notif['title'] }}</span>
                                                <span class="block truncate text-xs text-gray-500 dark:text-gray-400">{{ $notif['desc'] }}</span>
                                                <span class="block text-xs text-gray-400 dark:text-gray-500">{{ $notif['time'] }}</span>
                                            </span>
                                        </a>
                                    @endforeach
                                </div>
                                <div class="border-t border-gray-100 p-2 dark:border-gray-800">
                                    <a href="#" class="block rounded-lg px-3 py-2 text-center text-sm font-medium text-indigo-600 transition-colors hover:bg-indigo-50 dark:text-indigo-400 dark:hover:bg-indigo-500/10">
                                        {{ __('admin.topbar.view_all') }}
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Language switcher --}}
                        <div class="relative">
                            <button type="button" data-dropdown="locale-menu"
                                class="inline-flex h-10 items-center gap-1.5 rounded-lg px-2.5 text-sm font-medium text-gray-600 transition-colors hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-white"
                                aria-expanded="false">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5a17.92 17.92 0 01-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418" />
                                </svg>
                                <span class="hidden sm:inline">{{ $currentLocale === 'vi' ? 'VI' : 'EN' }}</span>
                                <svg class="hidden h-3 w-3 sm:block" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                    {!! $icons['chevron-down'] !!}
                                </svg>
                            </button>

                            <div id="locale-menu" data-dropdown-menu
                                class="absolute right-0 top-full z-30 mt-2 hidden w-40 rounded-xl border border-gray-200 bg-white py-1.5 shadow-lg dark:border-gray-700 dark:bg-gray-900">
                                @foreach (['en' => 'English', 'vi' => 'Tiếng Việt'] as $code => $label)
                                    <a href="{{ route('locale.set', $code) }}"
                                        @class([
                                            'flex items-center gap-2 px-4 py-2 text-sm transition-colors',
                                            'font-semibold text-indigo-600 bg-indigo-50 dark:bg-indigo-500/10 dark:text-indigo-300' => $currentLocale === $code,
                                            'text-gray-700 hover:bg-gray-50 dark:text-gray-200 dark:hover:bg-gray-800' => $currentLocale !== $code,
                                        ])>
                                        @if ($currentLocale === $code)
                                            <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                            </svg>
                                        @else
                                            <span class="h-4 w-4 shrink-0"></span>
                                        @endif
                                        {{ $label }}
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        {{-- User menu --}}
                        <div class="relative">
                            <button type="button" data-dropdown="user-menu"
                                class="flex items-center gap-2 rounded-lg p-1.5 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800"
                                aria-expanded="false">
                                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-indigo-600 text-sm font-semibold text-white">
                                    {{ $userInitial }}
                                </span>
                                <span class="hidden text-left md:block">
                                    <span class="block max-w-[10rem] truncate text-sm font-medium text-gray-900 dark:text-white">{{ $userName }}</span>
                                    <span class="block max-w-[10rem] truncate text-xs text-gray-500 dark:text-gray-400">{{ $userEmail }}</span>
                                </span>
                                <svg class="hidden h-4 w-4 text-gray-400 md:block" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                    {!! $icons['chevron-down'] !!}
                                </svg>
                            </button>

                            <div id="user-menu" data-dropdown-menu
                                class="absolute right-0 top-full z-30 mt-2 hidden w-56 rounded-xl border border-gray-200 bg-white py-1.5 shadow-lg dark:border-gray-700 dark:bg-gray-900">
                                <div class="border-b border-gray-100 px-4 py-3 dark:border-gray-800">
                                    <p class="truncate text-sm font-semibold text-gray-900 dark:text-white">{{ $userName }}</p>
                                    <p class="truncate text-xs text-gray-500 dark:text-gray-400">{{ $userEmail }}</p>
                                </div>
                                <div class="py-1.5">
                                    <a href="#" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-50 dark:text-gray-200 dark:hover:bg-gray-800">
                                        <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">{!! $icons['user'] !!}</svg>
                                        {{ __('admin.user_menu.profile') }}
                                    </a>
                                    <a href="#" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-50 dark:text-gray-200 dark:hover:bg-gray-800">
                                        <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">{!! $icons['cog'] !!}</svg>
                                        {{ __('admin.user_menu.settings') }}
                                    </a>
                                </div>
                                <div class="border-t border-gray-100 py-1.5 dark:border-gray-800">
                                    @if (Route::has('logout'))
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="flex w-full items-center gap-3 px-4 py-2 text-sm text-red-600 transition-colors hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-500/10">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">{!! $icons['logout'] !!}</svg>
                                                {{ __('admin.user_menu.logout') }}
                                            </button>
                                        </form>
                                    @else
                                        <a href="#" class="flex w-full items-center gap-3 px-4 py-2 text-sm text-red-600 transition-colors hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-500/10">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">{!! $icons['logout'] !!}</svg>
                                            {{ __('admin.user_menu.logout') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Content --}}
            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                @yield('content')
            </main>

            {{-- Footer --}}
            <footer class="border-t border-gray-200 px-4 py-4 text-center text-xs text-gray-400 dark:border-gray-800 dark:text-gray-600">
                &copy; {{ date('Y') }} {{ config('app.name', 'Admin') }}. {{ __('admin.footer') }}
            </footer>
        </div>
    </div>

    {{-- Search index --}}
    @php
        $searchIndex = collect($navigation)
            ->flatMap(fn ($group) => $group['items'])
            ->map(fn ($item) => [
                'label' => $item['label'],
                'url' => $item['route'] === '#' ? '#' : route($item['route']),
                'keywords' => $item['label'],
                'icon' => '<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">' . $icons[$item['icon']] . '</svg>',
            ])
            ->values()
            ->all();

        $localeLabels = __('admin.lang');
    @endphp
    <script type="application/json" id="search-index">
        @json($searchIndex)
    </script>

    @stack('scripts')
</body>
</html>
