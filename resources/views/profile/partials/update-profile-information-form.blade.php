<section>
    <header>
        <h2 class="text-xl font-bold text-forest-green-700">
            {{ __('Profilio informacija') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Atnaujinkite savo paskyros informaciją ir el. paštą.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Vardas')" class="text-forest-green-700"/>
            <x-text-input
                id="name" name="name" type="text"
                class="mt-1 block w-full rounded-xl border-amber-200 focus:border-amber-500 focus:ring-amber-500"
                :value="old('name', $user->name)" required autofocus autocomplete="name"
            />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('El. paštas')" class="text-forest-green-700"/>
            <x-text-input
                id="email" name="email" type="email"
                class="mt-1 block w-full rounded-xl border-amber-200 focus:border-amber-500 focus:ring-amber-500"
                :value="old('email', $user->email)" required autocomplete="username"
            />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3">
                    <p class="text-sm text-gray-700">
                        {{ __('Jūsų el. paštas yra nepatvirtintas.') }}
                        <button form="send-verification"
                            class="underline text-sm text-baltic-blue-700 hover:text-baltic-blue-800 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-400">
                            {{ __('Spustelėkite čia, jei norite iš naujo išsiųsti patvirtinimo el. laišką.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-forest-green-600">
                            {{ __('Nauja patvirtinimo nuoroda išsiųsta į jūsų el. pašto adresą.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="rounded-2xl bg-amber-500 hover:bg-amber-600 focus:ring-amber-300">
                {{ __('Išsaugoti') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition
                   x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm text-gray-600">
                    {{ __('Išsaugota.') }}
                </p>
            @endif
        </div>
    </form>
</section>
