<h4><strong class="mb-3">Alterar Placar</strong></h4>

<form method="POST" action="{{ route('partidas.alterarPlacar') }}">

    @csrf

    <div class="row mt-4">

        <input type="text" name="id" value="{{ $partida_placar->id }}" hidden>
        <h2 class="mb-10">{{ $partida_placar->campeonato }} - 
            @if (isset($partida_placar->rodada))
                {{ $partida_placar->rodada }} Rodada</h2>
            @else
                {{ $partida_placar->fase }}</h2>
            @endif
        @foreach ($clubes as $clube)
            @if ($partida_placar->clube_casa_id == $clube->id)
                <div class="col-lg-1">
                    <h1>{{ $clube->abreviacao }}</h1>
                </div>
                <div class="col-lg-2">
                    <img src="{{ $clube->url_escudo }}" alt="{{ $clube->nome }}" style="width: 2.6rem;" class="float-right">
                </div>
                <div class="col-lg-2">
                    <input type="number" class="form-control" name="placar_oficial_mandante" id="placar_oficial_mandante" value="{{ $partida_placar->placar_oficial_mandante }}" style="font-size: 1.5rem;" min="0">
                </div>
            @endif
            @if ($partida_placar->clube_visitante_id == $clube->id)
                <div class="col-lg-1">
                    <h1>{{ $clube->abreviacao }}</h1>
                </div>
                <div class="col-lg-2">
                    <img src="{{ $clube->url_escudo }}" alt="{{ $clube->nome }}" style="width: 2.6rem;" class="float-right">
                </div>
                <div class="col-lg-2">
                    <input type="number" class="form-control" name="placar_oficial_visitante" id="placar_oficial_visitante" value="{{ $partida_placar->placar_oficial_visitante }}" style="font-size: 1.5rem;" min="0">
                </div>
            @endif
        @endforeach

    </div>

    <button type="submit" class="btn btn-primary mt-3">Salvar</button>

</form>


<script>

    $(document).ready(function () {
        $("#placar_oficial_mandante").mask("00", { reverse: true });
        $("#placar_oficial_visitante").mask("00", { reverse: true });
    });

</script>