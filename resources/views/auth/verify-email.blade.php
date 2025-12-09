<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 px-4">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-6 sm:p-8 border border-amber-100">
            <div class="mb-4 text-sm text-gray-700">
                {{ __('Ačiū, kad prisiregistravote! Prieš pradėdami, patvirtinkite savo el. pašto adresą paspausdami nuorodą, kurią ką tik atsiuntėme. Jei negavote laiško, galime atsiųsti naują nuorodą.') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ __('Nauja patvirtinimo nuoroda buvo išsiųsta į el. pašto adresą, kurį nurodėte registracijos metu.') }}
                </div>
            @endif

            <div class="mt-4 flex flex-col sm:flex-row items-center justify-between gap-3">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <x-primary-button>
                        {{ __('Siųsti patvirtinimo laišką dar kartą') }}
                    </x-primary-button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        type="submit"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500"
                    >
                        {{ __('Atsijungti') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
