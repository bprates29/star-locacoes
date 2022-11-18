<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-app-logo />
            </a>
        </x-slot>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Nome')" />

                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- CPF -->
            <div class="mt-4">
                <x-input-label for="cpf" :value="__('CPF')" />

                <x-text-input data-inputmask="'mask': '999.999.999-99'" id="cpf" class="block mt-1 w-full" type="text" name="cpf" :value="old('cpf')" />

                <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
            </div>

            <!-- Telefone -->
            <div class="mt-4">
                <x-input-label for="telefone" :value="__('Telefone')" />

                <x-text-input data-inputmask="'mask': '(99)99999-9999'" id="telefone" class="block mt-1 w-full" type="tel" name="telefone" :value="old('telefone')"
                              placeholder="(xx)xxxxx-xxxx" required />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Telefone -->
            <div class="mt-4">
                <x-input-label for="pix" :value="__('Pix')" />

                <x-text-input id="pix" class="block mt-1 w-full" type="text" name="pix" :value="old('pix')" />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Senha')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirme a Senha')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Já tem login?') }}
                </a>

                <x-primary-button class="ml-4">
                    {{ __('Registrar') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>


