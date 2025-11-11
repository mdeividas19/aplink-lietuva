<section>
    <header>
        <h2 class="text-xl font-bold text-forest-green-700">
            {{ __('Atnaujinkite slaptažodį') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Įsitikinkite, kad jūsų paskyra naudoja ilgą, atsitiktinį slaptažodį, kad išliktumėte saugūs.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Dabartinis slaptažodis')" class="text-forest-green-700"/>
            <x-text-input id="update_password_current_password" name="current_password" type="password"
                class="mt-1 block w-full rounded-xl border-amber-200 focus:border-amber-500 focus:ring-amber-500"
                autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('Naujas slaptažodis')" class="text-forest-green-700"/>
            <x-text-input id="update_password_password" name="password" type="password"
                class="mt-1 block w-full rounded-xl border-amber-200 focus:border-amber-500 focus:ring-amber-500"
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Patvirtinti slaptažodį')" class="text-forest-green-700"/>
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="mt-1 block w-full rounded-xl border-amber-200 focus:border-amber-500 focus:ring-amber-500"
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="rounded-2xl bg-amber-500 hover:bg-amber-600 focus:ring-amber-300">
                {{ __('Išsaugoti') }}
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition
                   x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm text-gray-600">
                    {{ __('Išsaugota.') }}
                </p>
            @endif
        </div>
    </form>
</section>
