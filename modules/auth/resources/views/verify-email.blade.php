<x-auth::auth-layout
    title="Verify your email"
    subtitle="We've sent a verification link to your inbox."
>
    <div class="space-y-5">
        @if (session('status'))
            <div class="rounded-xl border border-emerald-500/30 bg-emerald-500/10 p-4 text-sm text-emerald-300">
                {{ session('status') }}
            </div>
        @endif

        <div class="flex items-start gap-3 rounded-xl border border-white/10 bg-white/5 p-4 text-sm text-slate-300">
            <svg class="mt-0.5 h-5 w-5 shrink-0 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
            <p>
                Before continuing, please check your email for a verification link.
                If you didn't receive the email, we can send you another.
            </p>
        </div>

        <form method="POST" action="{{ route('auth.verify-email.resend') }}" class="space-y-4">
            @csrf

            <x-auth::button>Resend verification email</x-auth::button>
        </form>
    </div>

    <x-slot name="footer">
        <p class="mt-6 text-center text-sm text-slate-400">
            <a href="{{ route('auth.login') }}" class="font-semibold text-cyan-400 transition hover:text-cyan-300">Back to sign in</a>
        </p>
    </x-slot>
</x-auth::auth-layout>
