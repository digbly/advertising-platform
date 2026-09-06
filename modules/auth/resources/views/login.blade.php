<x-auth::auth-layout
    title="Welcome back"
    subtitle="Sign in to your account to continue."
>
    <form method="POST" action="{{ route('auth.login') }}" class="space-y-5">
        @csrf

        {{-- Global error --}}
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

        <div>
            <div class="mb-1.5 flex items-center justify-between">
                <label for="password" class="auth-label !mb-0">Password</label>
                <a href="{{ route('auth.forgot-password') }}" class="text-xs font-medium text-cyan-400 transition hover:text-cyan-300">Forgot password?</a>
            </div>
            <div class="relative">
                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-500">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
                </span>
                <input
                    id="password"
                    name="password"
                    type="password"
                    placeholder="••••••••"
                    autocomplete="current-password"
                    required
                    class="auth-input auth-input-icon auth-input-toggle {{ $errors->has('password') ? 'border-rose-500/50 focus:border-rose-400 focus:ring-rose-400/20' : '' }}"
                >
                <button type="button" data-password-toggle="password" class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-500 transition hover:text-slate-300" aria-label="Toggle password visibility">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </button>
            </div>
            @error('password')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <label class="flex cursor-pointer items-center gap-2 text-sm text-slate-300">
                <input type="checkbox" name="remember" value="1" class="h-4 w-4 rounded border-white/20 bg-white/5 text-cyan-500 focus:ring-cyan-400/30" {{ old('remember') ? 'checked' : '' }}>
                Remember me
            </label>
        </div>

        <x-auth::button>Sign in</x-auth::button>
    </form>

    <x-slot name="footer">
        <p class="mt-6 text-center text-sm text-slate-400">
            Don't have an account?
            <a href="{{ route('auth.register') }}" class="font-semibold text-cyan-400 transition hover:text-cyan-300">Create one</a>
        </p>
    </x-slot>
</x-auth::auth-layout>
