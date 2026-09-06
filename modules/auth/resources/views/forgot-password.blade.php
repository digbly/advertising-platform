<x-auth::auth-layout
    title="Forgot your password?"
    subtitle="Enter your email and we'll send you a link to reset it."
>
    @if (session('status'))
        <div class="mb-5 rounded-xl border border-emerald-500/30 bg-emerald-500/10 p-4 text-sm text-emerald-300">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('auth.forgot-password') }}" class="space-y-5">
        @csrf

        @if ($errors->any())
            <div class="rounded-xl border border-rose-500/30 bg-rose-500/10 p-4 text-sm text-rose-300">
                <ul class="list-inside list-disc space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <x-auth::input
            label="Email"
            name="email"
            type="email"
            value="{{ old('email') }}"
            placeholder="you@example.com"
            autocomplete="email"
            required
            autofocus
            :error="$errors->first('email')"
            icon='<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>'
        />

        <x-auth::button>Send reset link</x-auth::button>
    </form>

    <x-slot name="footer">
        <p class="mt-6 text-center text-sm text-slate-400">
            Remembered it?
            <a href="{{ route('auth.login') }}" class="font-semibold text-cyan-400 transition hover:text-cyan-300">Back to sign in</a>
        </p>
    </x-slot>
</x-auth::auth-layout>
