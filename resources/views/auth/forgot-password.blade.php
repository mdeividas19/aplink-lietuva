{{-- resources/views/auth/forgot-password.blade.php --}}
<x-guest-layout>
    <div
        class="relative min-h-screen bg-center bg-cover"
        style="background-image: url('{{ asset('/img/forgot-password-image.png') }}')"
    >
        <div class="absolute inset-0 bg-white/70"></div>

        <div class="relative z-10 flex items-center justify-center min-h-screen px-4">
            <div
                class="w-full max-w-md rounded-2xl bg-white backdrop-blur shadow-2xl ring-1 ring-amber-100/50 p-6 md:p-8"
            >
                {{-- Header --}}
                <div class="text-center mb-6">
                    <div
                        class="mx-auto mb-3 h-14 w-14 grid place-content-center rounded-2xl
                               bg-gradient-to-b from-amber-400 to-amber-600 text-white shadow-lg"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2a5 5 0 00-5 5v3H6a2 2 0 00-2 2v7a2 2 0 002 2h12a2 2 0 002-2v-7a2 2 0 00-2-2h-1V7a5 5 0 00-5-5zm3 8H9V7a3 3 0 016 0v3z"/>
                        </svg>
                    </div>

                    <h1 class="text-3xl font-bold text-forest-green-600">
                        Slaptažodžio atkūrimas
                    </h1>
                    <p class="mt-2 text-sm text-gray-700">
                        Įveskite savo el. paštą ir atsiųsime nuorodą slaptažodžio atstatymui.
                    </p>
                </div>

                {{-- Session status --}}
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="email" :value="__('El. paštas')" />
                        <x-text-input
                            id="email"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required
                            autofocus
                            class="mt-1 block w-full rounded-xl border-amber-300 focus:border-amber-500 focus:ring-amber-500"
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <button
                        type="submit"
                        class="w-full inline-flex items-center justify-center rounded-2xl px-4 py-3 font-semibold
                               text-white bg-gradient-to-r from-amber-400 to-amber-600
                               hover:from-amber-500 hover:to-amber-700 focus:outline-none focus:ring-4 focus:ring-amber-300 transition"
                    >
                        {{ __('Siųsti slaptažodžio atkūrimo nuorodą') }}
                    </button>

                    <div class="text-center">
                        <a href="{{ route('login') }}"
                           class="text-sm font-medium text-baltic-blue-700 hover:underline">
                            Grįžti į prisijungimą
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
