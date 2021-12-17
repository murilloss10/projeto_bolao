<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gerenciar Clubes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg pl-3 pr-3">

                <div class="row">

                    <div class="p-6 bg-white border-b border-gray-200 col-lg-6">
                        @include('clubes.tabela_clubes')
                    </div>
    
    
                    <div class="p-6 bg-white border-b border-gray-200 col-lg-6">
    
                        @if (isset($message_))
                            <p>{{ $message_ }}</p>
                        @endif
    
                        @if (isset($clube))
                            @include('clubes.form_editar_clube')
                        @else
                            @include('clubes.form_criar_clube')
                        @endif
                        
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>