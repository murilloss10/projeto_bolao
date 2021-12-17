<h4><strong class="mb-3">Todas as Partidas</strong></h4>
<div class="row">
    @if (isset($partidas))
        @foreach ($partidas as $partida)    
            <div class="col-lg-12">
                <div class="row">
                    <p class="col-lg-4"><strong>{{ date('d/m/Y', strtotime($partida->partida_data)) }} | {{ $partida->partida_horario }}</strong></p>
                    <p class="col-lg-8">{{ $partida->local }} | {{ mb_strimwidth($partida->campeonato, 0, 14, ".") }}
                        @if ($partida->rodada == NULL)
                            @if ($partida->fase != NULL)
                                 | {{ mb_strimwidth($partida->fase, 0, 13, ".") }}
                            @endif
                        @elseif($partida->fase == NULL)
                            @if ($partida->rodada != NULL)
                                 | {{ $partida->rodada }} Rodada
                            @endif
                        @else
                            
                        @endif
                    </p>

                    <div class="col-lg-1">
                        <h4>{{ $partida->clubesMandante()->first()->abreviacao }}</h4>
                    </div>
                    <div class="col-lg-2">
                        <img src="{{ $partida->clubesMandante()->first()->url_escudo }}" alt="{{ $partida->clubesMandante()->first()->nome }}" style="width: 2rem;" class="float-right">
                    </div>

                    <div class="col-lg-1">
                        @if ($partida->placar_oficial_mandante == NULL && $partida->placar_oficial_mandante != 0)
                            <h4></h4>
                        @else
                            <h4>{{ $partida->placar_oficial_mandante }}</h4>
                        @endif
                    </div>

                    <h5 class="col-lg-1 text-center">X</h5>
                    
                    <div class="col-lg-1">
                        @if ($partida->placar_oficial_visitante == NULL && $partida->placar_oficial_visitante != 0)
                            <h4></h4>
                        @else
                            <h4>{{ $partida->placar_oficial_visitante }}</h4>
                        @endif
                    </div>

                    <div class="col-lg-1">
                        <h4>{{ $partida->clubesVisitante()->first()->abreviacao }}</h4>
                    </div>
                    <div class="col-lg-2">
                        <img src="{{ $partida->clubesVisitante()->first()->url_escudo }}" alt="{{ $partida->clubesVisitante()->first()->nome }}" style="width: 2rem;" class="float-right">
                    </div>

                    <p class="col-lg-1 ml-7">
                        <a href="{{ route('partidas.formEditar', $partida->id) }}" title="Editar"><i class="bi bi-pencil-square" style="font-size: 1.5rem; color: black;"></i></a>
                    </p>
                    <p class="col-lg-1">
                        <a href="{{ route('partidas.formPlacar', $partida->id) }}" title="Alterar Placar"><i class="bi bi-calendar-minus" style="font-size: 1.5rem; color: black;"></i></a>
                    </p>
                </div>
                <hr class="my-4">
            </div>
        @endforeach
    @endif
</div>