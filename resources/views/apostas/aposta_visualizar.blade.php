<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Visualizar Aposta') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg pl-3 pr-3">

                <div class="row p-4">

                    <div class="col-lg-8">
                        @if ($aposta->vencido == 1 && $aposta->valida == 1)
                            <center class="mb-5">
                                <h1><strong>Parabéns! Sua aposta foi certeira!</strong></h1>
                            </center>
                        @endif

                        {{-- verificar se o usuário conectado é admin --}}
                        <div class="col-lg-4">
                            @if ($aposta->valida == 0)
                                <form method="POST" action="{{ route('validarAposta', $aposta->id) }}">
                                    
                                    @csrf
                                    <center>
                                        <button type="submit" class="btn btn-primary" name="valida" value="true">Validar Aposta</button>
                                    </center>

                                </form>
                            @else
                                
                            @endif
                        </div>
    
                        <h5 class="mt-5"><strong>Apostador: </strong>{{ $aposta->usuarios()->first()->name }}</h5>
                        <h5><strong>CPF: </strong>{{ $aposta->usuarios()->first()->cpf }}</h5>
                        <h5 class="pt-4"><strong>Dados da aposta</strong></h5>
                        <h5>
                            {{ $aposta->partidas()->first()->campeonato }} | 
                            @if ($aposta->partidas()->first()->rodada != NULL)
                                {{ $aposta->partidas()->first()->rodada }} rodada
                            @else
                                {{ $aposta->partidas()->first()->fase }}
                            @endif
                        </h5>
                        <h5>{{ date('d/m/Y', strtotime($partida->partida_data)) }} | {{ $partida->partida_horario }}</h5>
                        <h5>{{ $partida->clubesMandante()->first()->nome }} {{ $aposta->placar_usuario_mandante }} X {{ $aposta->placar_usuario_visitante }} {{ $partida->clubesVisitante()->first()->nome }}</h5>
                        <h5 class="pt-2 "><strong class="mr-2">Valor: </strong> R$ {{ str_replace('.', ',', $aposta->valor_aposta) }}</h5>
    
                        <div class="p-6 bg-white col-lg-6">
                            <img src="{{ route('apostas.qrCodeLink', $aposta->id) }}" alt="QR Code">
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>


<script>

    $(document).ready(function () {
        $(".valor_aposta").mask("00,00", { reverse: true });
    });

</script>