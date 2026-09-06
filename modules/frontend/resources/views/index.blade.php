@extends('frontend::layouts.frontend')

@section('title', 'AdsRock — Advertise & Earn on One Platform')

@section('content')

{{-- ===== Hero ===== --}}
<section id="home" class="relative overflow-hidden pt-16">
    {{-- Background glows --}}
    <div class="pointer-events-none absolute inset-0">
        <div class="absolute -top-40 left-1/2 h-[500px] w-[900px] -translate-x-1/2 rounded-full bg-cyan-500/20 blur-[120px]"></div>
        <div class="absolute right-0 top-40 h-72 w-72 rounded-full bg-blue-600/20 blur-[100px]"></div>
        <div class="absolute bottom-0 left-0 h-72 w-72 rounded-full bg-fuchsia-600/10 blur-[100px]"></div>
    </div>

    <div class="relative mx-auto max-w-7xl px-4 pb-20 pt-20 text-center sm:px-6 lg:px-8 lg:pt-28">
        <span class="inline-flex items-center gap-2 rounded-full border border-cyan-400/30 bg-cyan-400/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-wider text-cyan-300">
            <span class="h-2 w-2 animate-pulse rounded-full bg-cyan-400"></span>
            The Largest Ad Network
        </span>

        <h1 class="mx-auto mt-6 max-w-4xl text-4xl font-extrabold leading-tight tracking-tight text-white sm:text-5xl lg:text-6xl">
            Advertise. Earn.
            <span class="bg-gradient-to-r from-cyan-400 via-blue-400 to-fuchsia-400 bg-clip-text text-transparent">One Platform, Dual Success!</span>
        </h1>

        <p class="mx-auto mt-6 max-w-2xl text-lg leading-relaxed text-slate-400">
            Craft compelling ads, maximize publisher earnings — a seamless, win-win platform for advertisers and publishers.
        </p>

        <div class="mt-10 flex flex-col items-center justify-center gap-4 sm:flex-row">
            <a href="#" class="w-full rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 px-8 py-3.5 text-sm font-semibold text-white shadow-xl shadow-cyan-500/30 transition hover:opacity-90 sm:w-auto">
                Become an Advertiser
            </a>
            <a href="#" class="w-full rounded-xl border border-white/15 bg-white/5 px-8 py-3.5 text-sm font-semibold text-white backdrop-blur transition hover:border-cyan-400/50 hover:text-cyan-300 sm:w-auto">
                Become a Publisher
            </a>
        </div>

        {{-- Hero stats --}}
        <div class="mx-auto mt-16 grid max-w-4xl grid-cols-2 gap-6 sm:grid-cols-4">
            <div class="rounded-2xl border border-white/10 bg-white/5 p-6 backdrop-blur">
                <p class="text-3xl font-extrabold text-white">80M+</p>
                <p class="mt-1 text-sm text-slate-400">Connected People</p>
            </div>
            <div class="rounded-2xl border border-white/10 bg-white/5 p-6 backdrop-blur">
                <p class="text-3xl font-extrabold text-white">120+</p>
                <p class="mt-1 text-sm text-slate-400">Countries Covered</p>
            </div>
            <div class="rounded-2xl border border-white/10 bg-white/5 p-6 backdrop-blur">
                <p class="text-3xl font-extrabold text-white">99.9%</p>
                <p class="mt-1 text-sm text-slate-400">Uptime Guarantee</p>
            </div>
            <div class="rounded-2xl border border-white/10 bg-white/5 p-6 backdrop-blur">
                <p class="text-3xl font-extrabold text-white">24/7</p>
                <p class="mt-1 text-sm text-slate-400">Expert Support</p>
            </div>
        </div>
    </div>
</section>

{{-- ===== Crafting Digital Success / Stats ===== --}}
<section class="relative border-y border-white/10 bg-slate-900/40 py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid items-center gap-12 lg:grid-cols-2">
            <div>
                <span class="text-sm font-semibold uppercase tracking-wider text-cyan-400">Crafting Digital Success</span>
                <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                    Drive More Traffic and Product Sales
                </h2>
                <p class="mt-4 text-lg leading-relaxed text-slate-400">
                    Crafting Digital Success is about using effective digital ad strategies to boost your business. Our platform helps you reach the right audience, increase engagement, and maximize your online impact.
                </p>
                <a href="#pricing" class="mt-8 inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-cyan-500/30 transition hover:opacity-90">
                    Explore Plans
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                </a>
            </div>

            {{-- Counters --}}
            <div class="grid grid-cols-2 gap-6">
                <div class="rounded-2xl border border-white/10 bg-slate-950/60 p-8 text-center">
                    <p class="text-4xl font-extrabold text-cyan-400">50K+</p>
                    <p class="mt-2 text-sm text-slate-400">Total Publishers</p>
                </div>
                <div class="rounded-2xl border border-white/10 bg-slate-950/60 p-8 text-center">
                    <p class="text-4xl font-extrabold text-blue-400">30K+</p>
                    <p class="mt-2 text-sm text-slate-400">Total Advertisers</p>
                </div>
                <div class="rounded-2xl border border-white/10 bg-slate-950/60 p-8 text-center">
                    <p class="text-4xl font-extrabold text-fuchsia-400">120M+</p>
                    <p class="mt-2 text-sm text-slate-400">Total Clicks</p>
                </div>
                <div class="rounded-2xl border border-white/10 bg-slate-950/60 p-8 text-center">
                    <p class="text-4xl font-extrabold text-emerald-400">1.5B+</p>
                    <p class="mt-2 text-sm text-slate-400">Total Impressions</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== Benefits ===== --}}
<section id="benefits" class="py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <span class="text-sm font-semibold uppercase tracking-wider text-cyan-400">Benefit from AdsRock</span>
            <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-white sm:text-4xl">Win-Win for Everyone</h2>
            <p class="mt-4 text-lg text-slate-400">
                Our ad network ensures precise targeting, connecting advertisers with high-quality publishers to maximize engagement and drive exceptional results.
            </p>
        </div>

        <div class="mt-16 grid gap-8 lg:grid-cols-2">
            {{-- Advertiser --}}
            <div class="group relative overflow-hidden rounded-3xl border border-white/10 bg-gradient-to-br from-slate-900 to-slate-950 p-8 transition hover:border-cyan-400/40">
                <div class="absolute -right-10 -top-10 h-40 w-40 rounded-full bg-cyan-500/10 blur-2xl transition group-hover:bg-cyan-500/20"></div>
                <div class="flex items-center gap-4">
                    <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-cyan-400 to-blue-600 text-white shadow-lg shadow-cyan-500/30">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941"/></svg>
                    </span>
                    <h3 class="text-2xl font-bold text-white">Advertiser</h3>
                </div>
                <ul class="mt-6 space-y-4 text-slate-300">
                    <li class="flex items-start gap-3">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        High quality unique traffic covering all GEOs
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        Deeper targeting than other networks
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        Own ad server with full control
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        Premium service for brands
                    </li>
                </ul>
                <a href="#" class="mt-8 inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-cyan-500/30 transition hover:opacity-90">
                    Become an Advertiser
                </a>
            </div>

            {{-- Publisher --}}
            <div class="group relative overflow-hidden rounded-3xl border border-white/10 bg-gradient-to-br from-slate-900 to-slate-950 p-8 transition hover:border-fuchsia-400/40">
                <div class="absolute -right-10 -top-10 h-40 w-40 rounded-full bg-fuchsia-500/10 blur-2xl transition group-hover:bg-fuchsia-500/20"></div>
                <div class="flex items-center gap-4">
                    <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-fuchsia-500 to-purple-600 text-white shadow-lg shadow-fuchsia-500/30">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </span>
                    <h3 class="text-2xl font-bold text-white">Publisher</h3>
                </div>
                <ul class="mt-6 space-y-4 text-slate-300">
                    <li class="flex items-start gap-3">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-fuchsia-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        Monetize up to 30% more effective than before
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-fuchsia-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        Get paid via different withdrawal methods
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-fuchsia-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        Monetize web and mobile traffic
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-fuchsia-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        Clean ads only — no intrusive formats
                    </li>
                </ul>
                <a href="#" class="mt-8 inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-fuchsia-500 to-purple-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-fuchsia-500/30 transition hover:opacity-90">
                    Become a Publisher
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ===== Why Choose Us ===== --}}
<section class="border-y border-white/10 bg-slate-900/40 py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <span class="text-sm font-semibold uppercase tracking-wider text-cyan-400">Why Choose AdsRock</span>
            <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-white sm:text-4xl">Built on Trust &amp; Performance</h2>
            <p class="mt-4 text-lg text-slate-400">
                AdsRock is the place to post your advertisement and grow as a publisher — whether you are an individual, group, or organization.
            </p>
        </div>

        <div class="mt-16 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @php
                $features = [
                    ['icon' => 'shield', 'color' => 'from-cyan-400 to-blue-600', 'title' => 'Certified', 'desc' => 'We are a certified company operating a fully legal business in the legal field.'],
                    ['icon' => 'bolt', 'color' => 'from-amber-400 to-orange-600', 'title' => 'Quick Withdrawal', 'desc' => 'High maximum withdrawal limits, processed in seconds.'],
                    ['icon' => 'check', 'color' => 'from-emerald-400 to-teal-600', 'title' => 'Reliable', 'desc' => 'Highly reliable and trusted by thousands of people worldwide.'],
                    ['icon' => 'lock', 'color' => 'from-blue-400 to-indigo-600', 'title' => 'Secure', 'desc' => 'We constantly improve our system and level up our security.'],
                    ['icon' => 'trend', 'color' => 'from-fuchsia-400 to-purple-600', 'title' => 'Profitable', 'desc' => 'Easily get profit for adding members and withdraw within minutes.'],
                    ['icon' => 'support', 'color' => 'from-rose-400 to-red-600', 'title' => '24/7 Support', 'desc' => 'We are here for you with 24/7 customer support through email.'],
                ];
            @endphp
            @foreach ($features as $feature)
                <div class="group rounded-2xl border border-white/10 bg-slate-950/60 p-8 transition hover:-translate-y-1 hover:border-cyan-400/40">
                    <span class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br {{ $feature['color'] }} text-white shadow-lg">
                        @if ($feature['icon'] === 'shield')
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                        @elseif ($feature['icon'] === 'bolt')
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/></svg>
                        @elseif ($feature['icon'] === 'check')
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        @elseif ($feature['icon'] === 'lock')
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
                        @elseif ($feature['icon'] === 'trend')
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941"/></svg>
                        @elseif ($feature['icon'] === 'support')
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z"/></svg>
                        @endif
                    </span>
                    <h3 class="mt-5 text-lg font-bold text-white">{{ $feature['title'] }}</h3>
                    <p class="mt-2 text-sm leading-relaxed text-slate-400">{{ $feature['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== Pricing ===== --}}
<section id="pricing" class="py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <span class="text-sm font-semibold uppercase tracking-wider text-cyan-400">Smart Plan for Advertiser</span>
            <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-white sm:text-4xl">Flexible Plans, Maximum Value</h2>
            <p class="mt-4 text-lg text-slate-400">
                Maximize your revenue with AdsRock's Smart Plan. Our tailored solutions ensure optimal ad placements and higher earnings.
            </p>
        </div>

        <div class="mt-16 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @php
                $plans = [
                    ['name' => 'Budget', 'type' => 'Impression', 'credit' => '100', 'price' => '4.00', 'popular' => false],
                    ['name' => 'Basic', 'type' => 'Impression', 'credit' => '250', 'price' => '9.00', 'popular' => false],
                    ['name' => 'Silver', 'type' => 'Impression', 'credit' => '500', 'price' => '19.00', 'popular' => true],
                    ['name' => 'Gold', 'type' => 'Impression', 'credit' => '1,500', 'price' => '29.00', 'popular' => false],
                    ['name' => 'Diamond', 'type' => 'Click', 'credit' => '1,000', 'price' => '39.00', 'popular' => false],
                    ['name' => 'Platinum', 'type' => 'Click', 'credit' => '1,800', 'price' => '49.00', 'popular' => false],
                    ['name' => 'Super', 'type' => 'Impression', 'credit' => '5,000', 'price' => '59.00', 'popular' => false],
                    ['name' => 'Enterprise', 'type' => 'Click', 'credit' => '5,000', 'price' => '99.00', 'popular' => false],
                ];
            @endphp
            @foreach ($plans as $plan)
                <div class="relative flex flex-col rounded-2xl border border-white/10 bg-slate-900/60 p-6 transition hover:-translate-y-1 hover:border-cyan-400/40 {{ $plan['popular'] ? 'ring-2 ring-cyan-400/50' : '' }}">
                    @if ($plan['popular'])
                        <span class="absolute -top-3 left-1/2 -translate-x-1/2 rounded-full bg-gradient-to-r from-cyan-500 to-blue-600 px-4 py-1 text-xs font-bold uppercase tracking-wider text-white shadow-lg">Popular</span>
                    @endif
                    <h3 class="text-lg font-bold uppercase tracking-wide text-white">{{ $plan['name'] }}</h3>
                    <p class="mt-1 text-xs font-medium uppercase tracking-wider text-slate-500">Type: {{ $plan['type'] }}</p>
                    <p class="mt-2 text-sm text-slate-400">Credit: <span class="font-semibold text-slate-200">{{ $plan['credit'] }}</span></p>
                    <div class="mt-6 flex items-end gap-1">
                        <span class="text-2xl font-bold text-slate-400">$</span>
                        <span class="text-4xl font-extrabold text-white">{{ $plan['price'] }}</span>
                        <span class="mb-1 text-sm text-slate-500">USD</span>
                    </div>
                    <a href="#" class="mt-6 rounded-xl border border-white/15 bg-white/5 py-2.5 text-center text-sm font-semibold text-white transition hover:border-cyan-400/50 hover:bg-cyan-500/10 hover:text-cyan-300">
                        Purchase Now
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== How It Works ===== --}}
<section id="how-it-works" class="border-y border-white/10 bg-slate-900/40 py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <span class="text-sm font-semibold uppercase tracking-wider text-cyan-400">How AdsRock Works</span>
            <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-white sm:text-4xl">Start in Five Simple Steps</h2>
            <p class="mt-4 text-lg text-slate-400">
                AdsRock simplifies digital advertising by connecting advertisers with top publishers using advanced targeting.
            </p>
        </div>

        <div class="mt-16 grid gap-6 md:grid-cols-2 lg:grid-cols-5">
            @php
                $steps = [
                    ['num' => '01', 'title' => 'Signup', 'desc' => 'Start your journey by creating an account and unlocking a world of opportunities.'],
                    ['num' => '02', 'title' => 'Purchase Plan', 'desc' => 'Choose a plan that suits your advertising goals and budget.'],
                    ['num' => '03', 'title' => 'Setup Campaign', 'desc' => 'Define target audiences, budget, and scheduling to optimize reach.'],
                    ['num' => '04', 'title' => 'Publish Ads', 'desc' => 'Showcase your brand to the world with compelling ads.'],
                    ['num' => '05', 'title' => 'Track Performance', 'desc' => 'Monitor metrics in real-time and refine strategies for optimal results.'],
                ];
            @endphp
            @foreach ($steps as $step)
                <div class="relative rounded-2xl border border-white/10 bg-slate-950/60 p-6">
                    <span class="text-5xl font-extrabold text-white/10">{{ $step['num'] }}</span>
                    <h3 class="mt-3 text-lg font-bold text-white">{{ $step['title'] }}</h3>
                    <p class="mt-2 text-sm leading-relaxed text-slate-400">{{ $step['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== Testimonials ===== --}}
<section id="testimonials" class="py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <span class="text-sm font-semibold uppercase tracking-wider text-cyan-400">They Said It, We Believe It</span>
            <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-white sm:text-4xl">Authentic Voices, Genuine Results</h2>
            <p class="mt-4 text-lg text-slate-400">
                Dive deeper than data, feel the passion. Unleash your own potential — we believe in you.
            </p>
        </div>

        <div class="mt-16 grid gap-6 md:grid-cols-3">
            @php
                $testimonials = [
                    ['name' => 'Michael Smith', 'role' => 'Advertiser', 'quote' => 'The quality and attention to detail in this product are exceptional. It has exceeded all my expectations and provided great value for the money.', 'initials' => 'MS', 'color' => 'from-cyan-400 to-blue-600'],
                    ['name' => 'Sarah Johnson', 'role' => 'Publisher', 'quote' => 'Monetizing my traffic has never been easier. Withdrawals are instant and the support team is incredibly responsive. Highly recommended!', 'initials' => 'SJ', 'color' => 'from-fuchsia-400 to-purple-600'],
                    ['name' => 'David Chen', 'role' => 'Advertiser', 'quote' => 'The targeting options are unmatched. My campaigns reach exactly the right audience, and the ROI speaks for itself.', 'initials' => 'DC', 'color' => 'from-emerald-400 to-teal-600'],
                ];
            @endphp
            @foreach ($testimonials as $t)
                <div class="flex flex-col rounded-2xl border border-white/10 bg-slate-900/60 p-8">
                    <div class="flex gap-1 text-amber-400">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
                        @endfor
                    </div>
                    <p class="mt-5 flex-1 text-sm leading-relaxed text-slate-300">"{{ $t['quote'] }}"</p>
                    <div class="mt-6 flex items-center gap-3 border-t border-white/10 pt-5">
                        <span class="flex h-11 w-11 items-center justify-center rounded-full bg-gradient-to-br {{ $t['color'] }} text-sm font-bold text-white">{{ $t['initials'] }}</span>
                        <div>
                            <p class="text-sm font-semibold text-white">{{ $t['name'] }}</p>
                            <p class="text-xs text-slate-500">{{ $t['role'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== Blog ===== --}}
<section class="border-y border-white/10 bg-slate-900/40 py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <span class="text-sm font-semibold uppercase tracking-wider text-cyan-400">Our Latest Blog</span>
            <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-white sm:text-4xl">Stay Updated with Trends</h2>
            <p class="mt-4 text-lg text-slate-400">
                Explore expert insights, tips, and strategies to boost your campaigns.
            </p>
        </div>

        <div class="mt-16 grid gap-6 md:grid-cols-3">
            @php
                $posts = [
                    ['title' => 'How Small Businesses are Thriving with Our Ad Solutions', 'date' => '10 Jun 2024', 'excerpt' => 'Small businesses often face unique challenges in the competitive world of digital advertising, from limited budgets to the need for high-impact strategies.', 'tag' => 'Business'],
                    ['title' => 'The Power of Targeted Advertising, Reaching Your Audience Effectively', 'date' => '10 Jun 2024', 'excerpt' => 'In the competitive world of digital marketing, reaching the right audience with your advertising efforts is essential for maximizing impact.', 'tag' => 'Targeting'],
                    ['title' => 'Understanding Ad Analytics, Key Metrics for Success', 'date' => '10 Jun 2024', 'excerpt' => 'In the realm of digital advertising, understanding and analyzing ad performance is crucial for optimizing campaigns and achieving marketing goals.', 'tag' => 'Analytics'],
                ];
            @endphp
            @foreach ($posts as $post)
                <article class="group flex flex-col overflow-hidden rounded-2xl border border-white/10 bg-slate-950/60 transition hover:border-cyan-400/40">
                    <div class="flex h-40 items-center justify-center bg-gradient-to-br from-slate-800 to-slate-900">
                        <svg class="h-12 w-12 text-slate-600 transition group-hover:text-cyan-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
                    </div>
                    <div class="flex flex-1 flex-col p-6">
                        <div class="flex items-center gap-3 text-xs text-slate-500">
                            <span class="rounded-full bg-cyan-400/10 px-3 py-1 font-semibold text-cyan-400">{{ $post['tag'] }}</span>
                            <span>{{ $post['date'] }}</span>
                        </div>
                        <h3 class="mt-4 text-lg font-bold leading-snug text-white transition group-hover:text-cyan-300">{{ $post['title'] }}</h3>
                        <p class="mt-2 flex-1 text-sm leading-relaxed text-slate-400">{{ $post['excerpt'] }}</p>
                        <a href="#" class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-cyan-400 transition hover:text-cyan-300">
                            Read More
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== FAQ ===== --}}
<section id="faq" class="py-24">
    <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <span class="text-sm font-semibold uppercase tracking-wider text-cyan-400">Common Queries</span>
            <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-white sm:text-4xl">Frequently Asked Questions</h2>
            <p class="mt-4 text-lg text-slate-400">
                Find answers to common queries about AdsRock. Get the information you need quickly and easily.
            </p>
        </div>

        <div class="mt-12 space-y-4">
            @php
                $faqs = [
                    ['q' => 'How do I get started with AdsRock?', 'a' => 'Getting started is easy. Simply sign up on our platform, create your ad campaign, choose your target audience, and launch your ads. Our intuitive interface will guide you through each step.'],
                    ['q' => 'How do I track the performance of my ads?', 'a' => 'Our dashboard provides real-time analytics including impressions, clicks, CTR, and conversions. You can monitor performance metrics, analyze data, and refine your strategies for optimal results.'],
                    ['q' => 'What plans does AdsRock offer for advertisers?', 'a' => 'We offer flexible plans from Budget to Enterprise, covering both impression-based and click-based pricing. Choose the plan that best fits your advertising goals and budget.'],
                    ['q' => 'Is there support available if I encounter issues?', 'a' => 'Yes, AdsRock offers comprehensive support through our help center, FAQs, and customer service team to assist you with any questions or issues you may encounter.'],
                    ['q' => 'What payment options are available?', 'a' => 'We support multiple secure payment methods including major credit cards, PayPal, and bank transfers. Withdrawals for publishers are processed quickly with high limits.'],
                ];
            @endphp
            @foreach ($faqs as $index => $faq)
                <div class="overflow-hidden rounded-2xl border border-white/10 bg-slate-900/60">
                    <button type="button" class="faq-toggle flex w-full items-center justify-between gap-4 px-6 py-5 text-left" data-target="faq-{{ $index }}">
                        <span class="text-base font-semibold text-white">{{ $faq['q'] }}</span>
                        <svg class="faq-icon h-5 w-5 shrink-0 text-cyan-400 transition-transform" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                    </button>
                    <div id="faq-{{ $index }}" class="faq-answer hidden px-6 pb-5">
                        <p class="text-sm leading-relaxed text-slate-400">{{ $faq['a'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== CTA ===== --}}
<section class="relative overflow-hidden border-t border-white/10 py-24">
    <div class="pointer-events-none absolute inset-0">
        <div class="absolute left-1/2 top-1/2 h-72 w-[700px] -translate-x-1/2 -translate-y-1/2 rounded-full bg-cyan-500/20 blur-[120px]"></div>
    </div>
    <div class="relative mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">
        <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">Ready to Join the Largest Ad Network?</h2>
        <p class="mx-auto mt-4 max-w-2xl text-lg text-slate-400">
            Tap into AdsRock's extensive network to amplify your brand's reach. Connect with top publishers, engage your target audience, and watch your business grow.
        </p>
        <div class="mt-10 flex flex-col items-center justify-center gap-4 sm:flex-row">
            <a href="#" class="w-full rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 px-8 py-3.5 text-sm font-semibold text-white shadow-xl shadow-cyan-500/30 transition hover:opacity-90 sm:w-auto">
                Become a Publisher
            </a>
            <a href="#" class="w-full rounded-xl border border-white/15 bg-white/5 px-8 py-3.5 text-sm font-semibold text-white backdrop-blur transition hover:border-cyan-400/50 hover:text-cyan-300 sm:w-auto">
                Become an Advertiser
            </a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // FAQ accordion
    document.querySelectorAll('.faq-toggle').forEach((btn) => {
        btn.addEventListener('click', () => {
            const target = document.getElementById(btn.dataset.target);
            const icon = btn.querySelector('.faq-icon');
            const isHidden = target.classList.contains('hidden');
            // Close all
            document.querySelectorAll('.faq-answer').forEach((a) => a.classList.add('hidden'));
            document.querySelectorAll('.faq-icon').forEach((i) => i.classList.remove('rotate-180'));
            // Open clicked
            if (isHidden) {
                target.classList.remove('hidden');
                icon.classList.add('rotate-180');
            }
        });
    });
</script>
@endpush
