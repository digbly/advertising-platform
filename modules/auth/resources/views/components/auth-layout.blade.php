@props([
    'title' => '',
    'subtitle' => '',
])

<x-auth::layouts.master>
    <div class="flex min-h-screen">
        {{-- ===== Brand panel (desktop) ===== --}}
        <div class="relative hidden w-1/2 overflow-hidden lg:flex lg:flex-col lg:justify-between">
            {{-- Background --}}
            <div class="absolute inset-0 bg-gradient-to-br from-cyan-500 via-blue-600 to-indigo-900"></div>
            <div class="absolute -left-24 -top-24 h-96 w-96 rounded-full bg-cyan-400/30 blur-3xl"></div>
            <div class="absolute -bottom-32 -right-16 h-[28rem] w-[28rem] rounded-full bg-blue-400/30 blur-3xl"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_1px_1px,rgba(255,255,255,0.15)_1px,transparent_0)] [background-size:24px_24px]"></div>

            {{-- Content --}}
            <div class="relative z-10 p-12">
                <x-auth::brand />
            </div>

            <div class="relative z-10 p-12">
                <h2 class="max-w-md text-3xl font-extrabold leading-tight text-white">
                    Connect advertisers with high-quality publishers.
                </h2>
                <p class="mt-4 max-w-md text-sm leading-relaxed text-white/80">
                    Reach a broader audience by publishing your ads across a variety of trusted websites, or monetize your traffic by hosting quality campaigns.
                </p>

                <div class="mt-10 grid max-w-md grid-cols-3 gap-6">
                    <div>
                        <p class="text-2xl font-extrabold text-white">10k+</p>
                        <p class="mt-1 text-xs text-white/70">Publishers</p>
                    </div>
                    <div>
                        <p class="text-2xl font-extrabold text-white">2.5M</p>
                        <p class="mt-1 text-xs text-white/70">Daily Impressions</p>
                    </div>
                    <div>
                        <p class="text-2xl font-extrabold text-white">98%</p>
                        <p class="mt-1 text-xs text-white/70">Satisfaction</p>
                    </div>
                </div>
            </div>

            <div class="relative z-10 p-12">
                <p class="text-xs text-white/60">&copy; {{ date('Y') }} {{ config('app.name', 'AdsRock') }}. All rights reserved.</p>
            </div>
        </div>

        {{-- ===== Form panel ===== --}}
        <div class="relative flex w-full items-center justify-center px-4 py-12 sm:px-6 lg:w-1/2 lg:px-12">
            {{-- Mobile brand --}}
            <div class="absolute left-6 top-6 lg:hidden">
                <x-auth::brand />
            </div>

            <div class="w-full max-w-md">
                <div class="auth-card">
                    <div class="mb-8">
                        <h1 class="text-2xl font-extrabold text-white">{{ $title }}</h1>
                        @if ($subtitle)
                            <p class="mt-2 text-sm text-slate-400">{{ $subtitle }}</p>
                        @endif
                    </div>

                    {{ $slot }}
                </div>

                {{ $footer ?? '' }}
            </div>
        </div>
    </div>
</x-auth::layouts.master>
