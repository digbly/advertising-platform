<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'AdsRock'))</title>
    <meta name="description" content="@yield('meta_description', 'Advertise and earn on one platform. Connect advertisers with high-quality publishers to drive traffic and sales.')">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-slate-950 text-slate-200 antialiased">

    {{-- ===== Header / Navbar ===== --}}
    <header class="fixed inset-x-0 top-0 z-50 border-b border-white/10 bg-slate-950/80 backdrop-blur-md">
        <nav class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
            {{-- Brand --}}
            <a href="{{ route('frontend.home') }}" class="flex items-center gap-2">
                <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-gradient-to-br from-cyan-400 to-blue-600 text-lg font-extrabold text-white shadow-lg shadow-cyan-500/30">A</span>
                <span class="text-xl font-extrabold tracking-tight text-white">Ads<span class="text-cyan-400">Rock</span></span>
            </a>

            {{-- Desktop nav --}}
            <div class="hidden items-center gap-8 text-sm font-medium text-slate-300 lg:flex">
                <a href="#home" class="transition hover:text-cyan-400">Home</a>
                <a href="#benefits" class="transition hover:text-cyan-400">Benefits</a>
                <a href="#pricing" class="transition hover:text-cyan-400">Pricing</a>
                <a href="#how-it-works" class="transition hover:text-cyan-400">How It Works</a>
                <a href="#testimonials" class="transition hover:text-cyan-400">Testimonials</a>
                <a href="#faq" class="transition hover:text-cyan-400">FAQ</a>
            </div>

            {{-- Actions --}}
            <div class="hidden items-center gap-3 lg:flex">
                <a href="#" class="rounded-lg px-4 py-2 text-sm font-semibold text-slate-200 transition hover:text-cyan-400">Sign In</a>
                <a href="#" class="rounded-lg bg-gradient-to-r from-cyan-500 to-blue-600 px-5 py-2 text-sm font-semibold text-white shadow-lg shadow-cyan-500/30 transition hover:opacity-90">Get Started</a>
            </div>

            {{-- Mobile toggle --}}
            <button id="mobile-menu-btn" type="button" class="inline-flex items-center justify-center rounded-lg p-2 text-slate-300 hover:bg-white/10 lg:hidden" aria-label="Open menu">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                </svg>
            </button>
        </nav>

        {{-- Mobile menu --}}
        <div id="mobile-menu" class="hidden border-t border-white/10 bg-slate-950/95 px-4 pb-4 pt-2 lg:hidden">
            <div class="flex flex-col gap-1 text-sm font-medium text-slate-300">
                <a href="#home" class="rounded-lg px-3 py-2 hover:bg-white/10 hover:text-cyan-400">Home</a>
                <a href="#benefits" class="rounded-lg px-3 py-2 hover:bg-white/10 hover:text-cyan-400">Benefits</a>
                <a href="#pricing" class="rounded-lg px-3 py-2 hover:bg-white/10 hover:text-cyan-400">Pricing</a>
                <a href="#how-it-works" class="rounded-lg px-3 py-2 hover:bg-white/10 hover:text-cyan-400">How It Works</a>
                <a href="#testimonials" class="rounded-lg px-3 py-2 hover:bg-white/10 hover:text-cyan-400">Testimonials</a>
                <a href="#faq" class="rounded-lg px-3 py-2 hover:bg-white/10 hover:text-cyan-400">FAQ</a>
                <div class="mt-2 flex gap-3 border-t border-white/10 pt-3">
                    <a href="#" class="flex-1 rounded-lg border border-white/15 px-4 py-2 text-center font-semibold text-slate-200">Sign In</a>
                    <a href="#" class="flex-1 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-600 px-4 py-2 text-center font-semibold text-white">Get Started</a>
                </div>
            </div>
        </div>
    </header>

    {{-- ===== Main content ===== --}}
    <main>
        @yield('content')
    </main>

    {{-- ===== Footer ===== --}}
    <footer class="border-t border-white/10 bg-slate-950">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
            <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-4">
                {{-- Brand --}}
                <div class="lg:col-span-1">
                    <a href="{{ route('frontend.home') }}" class="flex items-center gap-2">
                        <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-gradient-to-br from-cyan-400 to-blue-600 text-lg font-extrabold text-white">A</span>
                        <span class="text-xl font-extrabold tracking-tight text-white">Ads<span class="text-cyan-400">Rock</span></span>
                    </a>
                    <p class="mt-4 text-sm leading-relaxed text-slate-400">
                        AdsRock helps you reach a broader audience by publishing your ads across a variety of websites.
                    </p>
                    <div class="mt-5 flex gap-3">
                        <a href="#" aria-label="Facebook" class="flex h-9 w-9 items-center justify-center rounded-lg bg-white/5 text-slate-300 transition hover:bg-cyan-500 hover:text-white">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12a10 10 0 10-11.56 9.88v-6.99H7.9V12h2.54V9.8c0-2.5 1.49-3.89 3.77-3.89 1.09 0 2.23.2 2.23.2v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56V12h2.78l-.44 2.89h-2.34v6.99A10 10 0 0022 12z"/></svg>
                        </a>
                        <a href="#" aria-label="Twitter" class="flex h-9 w-9 items-center justify-center rounded-lg bg-white/5 text-slate-300 transition hover:bg-cyan-500 hover:text-white">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.24 2.25h3.31l-7.23 8.26 8.5 11.24h-6.66l-5.21-6.82-5.97 6.82H1.67l7.73-8.84L1.25 2.25h6.83l4.71 6.23 5.45-6.23zm-1.16 17.52h1.83L7.08 4.13H5.12l11.96 15.64z"/></svg>
                        </a>
                        <a href="#" aria-label="LinkedIn" class="flex h-9 w-9 items-center justify-center rounded-lg bg-white/5 text-slate-300 transition hover:bg-cyan-500 hover:text-white">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.45 20.45h-3.55v-5.57c0-1.33-.03-3.04-1.85-3.04-1.85 0-2.14 1.45-2.14 2.94v5.67H9.36V9h3.41v1.56h.05c.48-.9 1.64-1.85 3.37-1.85 3.6 0 4.27 2.37 4.27 5.46v6.28zM5.34 7.43a2.06 2.06 0 110-4.12 2.06 2.06 0 010 4.12zM7.12 20.45H3.56V9h3.56v11.45z"/></svg>
                        </a>
                    </div>
                </div>

                {{-- Quick links --}}
                <div>
                    <h4 class="text-sm font-semibold uppercase tracking-wider text-white">Quick Links</h4>
                    <ul class="mt-4 space-y-3 text-sm text-slate-400">
                        <li><a href="#home" class="transition hover:text-cyan-400">Home</a></li>
                        <li><a href="#benefits" class="transition hover:text-cyan-400">Benefits</a></li>
                        <li><a href="#pricing" class="transition hover:text-cyan-400">Pricing</a></li>
                        <li><a href="#how-it-works" class="transition hover:text-cyan-400">How It Works</a></li>
                        <li><a href="#faq" class="transition hover:text-cyan-400">FAQ</a></li>
                    </ul>
                </div>

                {{-- Policy links --}}
                <div>
                    <h4 class="text-sm font-semibold uppercase tracking-wider text-white">Policy Links</h4>
                    <ul class="mt-4 space-y-3 text-sm text-slate-400">
                        <li><a href="#" class="transition hover:text-cyan-400">Privacy Policy</a></li>
                        <li><a href="#" class="transition hover:text-cyan-400">Terms of Service</a></li>
                        <li><a href="#" class="transition hover:text-cyan-400">Cookie Policy</a></li>
                        <li><a href="#" class="transition hover:text-cyan-400">Refund Policy</a></li>
                    </ul>
                </div>

                {{-- Newsletter --}}
                <div>
                    <h4 class="text-sm font-semibold uppercase tracking-wider text-white">Newsletter</h4>
                    <p class="mt-4 text-sm text-slate-400">Subscribe to get all the updates and news.</p>
                    <form class="mt-4 flex gap-2" onsubmit="event.preventDefault(); alert('Subscribed!');">
                        <input type="email" required placeholder="Your email" class="w-full rounded-lg border border-white/10 bg-white/5 px-4 py-2 text-sm text-white placeholder-slate-500 outline-none focus:border-cyan-400">
                        <button type="submit" class="shrink-0 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:opacity-90">Subscribe</button>
                    </form>
                </div>
            </div>

            <div class="mt-12 border-t border-white/10 pt-6 text-center text-sm text-slate-500">
                &copy; {{ date('Y') }} {{ config('app.name', 'AdsRock') }}. All Rights Reserved.
            </div>
        </div>
    </footer>

    {{-- Mobile menu toggle script --}}
    <script>
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        if (btn && menu) {
            btn.addEventListener('click', () => menu.classList.toggle('hidden'));
        }
    </script>
    @stack('scripts')
</body>
</html>
