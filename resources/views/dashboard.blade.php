<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Acompanhamentos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="mb-4 text-3xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-6xl"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">
                            Bem-vindo!</span><br>
                        Escolha uma das opçoes do menu!</h1>
                    <x-responsive-nav-link :href="route('user.carros')" :active="request()->routeIs('user.carros')">
                        {{ __('Clique aqui para consultar os repasses e as revisões do seu carro') }}
                    </x-responsive-nav-link>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
