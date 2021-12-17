<h4><strong class="mb-3">Todas as Apostas</strong></h4>
<div class="row">
    @if (isset($apostas))
        @foreach ($apostas as $aposta)

            <div class="col-lg-12">
                
                <div class="row">

                    @foreach ($aposta->partidas()->get() as $partida)
                    
                        @if ($aposta->partida_id == $partida->id)

                            <p class="col-lg-3 my-1">
                                <strong>{{ $partida->rodada != NULL ? $partida->rodada . ' rodada' : $partida->fase }} | {{ $partida->campeonato }}</strong>
                                <strong>{{ date('d/m/Y', strtotime($partida->partida_data)) }} | {{ $partida->partida_horario }}</strong>
                            </p>

                            <div class="col-lg-3 my-0">
                                <div class="row">
                                    <img src="{{ $partida->clubesMandante()->first()->url_escudo }}" alt="{{ $partida->clubesMandante()->first()->nome }}" style="width: 4.4rem;" class="col-lg-3 float-center pt-1 pb-1">
                                    <h1 class="col-lg-2 text-center">{{ $aposta->placar_usuario_mandante }}</h1>
                                    <h5 class="col-lg-2 text-center" style="vertical-align: middle; font-size: 2rem;">x</h5>
                                    <h1 class="col-lg-2 text-center">{{ $aposta->placar_usuario_visitante }}</h1>
                                    <img src="{{ $partida->clubesVisitante()->first()->url_escudo }}" alt="{{ $partida->clubesVisitante()->first()->nome }}" style="width: 4.4rem;" class="col-lg-3 float-center pt-1 pb-1">
                                </div>
                            </div>

                            <div class="col-lg-2 my-0">
                                <strong>Apostador:</strong>
                                <p style="font-size: .7rem;">{{ $aposta->usuarios()->first()->name }} | {{ $aposta->usuarios()->first()->cpf }}</p>
                            </div>

                            <div class="col-1">
                                <strong>Valor:</strong>
                                R$ <p style="font-size: .7" class="valor_aposta">{{ $aposta->valor_aposta }}</p>
                            </div>

                            <p class="col-lg-2 ml-7">
                                @if ($aposta->valida == 1)
                                    <i class="bi bi-check-circle-fill" style="color: green; font-size: 1.7rem;" title="Aposta válida"></i>
                                @else
                                    <a data-bs-toggle="modal" data-bs-target="#modalValidarAposta{{ $aposta->id }}" title="Validar Aposta"><i class="bi bi-check2-square" style="font-size: 1.7rem; color: black;"></i></a>
                                @endif

                                <a href="{{ route('apostas.vizualizar', $aposta->id) }}" title="Visualizar Aposta"><i class="bi bi-clipboard-data" style="font-size: 1.7rem; color: black;"></i></a>
                                
                                @if ($aposta->vencido == 1)
                                    <i class="ml-3 bi bi-award-fill" style="color: black; font-size: 1.3rem;" title="Aposta vencedora"></i>
                                @endif
                                
                                {{-- Modal de validar aposta --}}
                                <div class="modal fade" id="modalValidarAposta{{ $aposta->id }}" tabindex="-1" aria-labelledby="modalValidarApostaLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalValidarApostaLabel">APOSTA: <br>{{ $aposta->id }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Apostador: </strong>{{ $aposta->usuarios()->first()->name }} | {{ $aposta->usuarios()->first()->cpf }}</p><br>
                                                Deseja validar esta aposta ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                <form method="POST" action="{{ route('validarAposta', $aposta->id) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary" name="valida" value="true">Sim</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </p>

                        @else
                            
                        @endif

                    @endforeach
                    
                </div>
                <hr class="my-1">
            </div>
        @endforeach
    @endif
</div>

<script>

    $(document).ready(function () {
        $(".valor_aposta").mask("00,00", { reverse: true });
    });

</script>