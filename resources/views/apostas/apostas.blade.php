<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gerenciar Partidas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg pl-3 pr-3">

                <div class="row">

                    <div class="p-6 bg-white border-b border-gray-200 col-lg-12">
                        
                        @include('apostas.form_adicionar_aposta')

                    </div>

                </div>

            </div>
        </div>


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-2">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg pl-3 pr-3">

                <div class="row">

                    <div class="p-6 bg-white border-b border-gray-200 col-lg-12">
                        
                        @include('apostas.tabela_apostas')

                    </div>

                </div>

            </div>
        </div>

    </div>
</x-app-layout>