<h4><strong class="mb-3">Adicionar Aposta</strong></h4>

<form method="POST" action="{{ route('apostas.criar') }}">
                        
    @csrf

    <div class="row mt-4">
        <div class="mb-3 col-lg-8">
            <label for="inputPartida" class="form-label">Partida</label>
            <select class="form-control" name="partida_id" id="inputPartida">
                @foreach ($partidas as $partida)
                    <option value="{{ $partida->id }}">
                        {{ $partida->clubesMandante()->first()->abreviacao }}
                        x
                        {{ $partida->clubesVisitante()->first()->abreviacao }} 
                            | {{ $partida->campeonato }}
                            | {{ date('d/m/Y', strtotime($partida->partida_data)) }} 
                            | {{ $partida->partida_horario }}
                    </option>
                @endforeach
            </select>
            @error('partida_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 col-lg-4">
            <label for="inputUsuario" class="form-label">CPF do Usuário</label>
            <input type="text" class="form-control" id="inputUsuario" name="usuario_id">
            @error('usuario_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 col-lg-2">
            <label for="inputPlacarMandante" class="form-label">Placar Time Mandante</label>
            <input type="number" class="form-control" id="inputPlacarMandante" name="placar_usuario_mandante" min="0">
            @error('placar_usuario_mandante')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 col-lg-2">
            <label for="inputPlacarVisitante" class="form-label">Placar Time Visitante</label>
            <input type="number" class="form-control" id="inputPlacarVisitante" name="placar_usuario_visitante" min="0">
            @error('placar_usuario_visitante')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 col-lg-2">
            <label for="inputValorAposta" class="form-label">Valor da Aposta</label>
            <input type="text" class="form-control" id="inputValorAposta" name="valor_aposta" value="2,00" disabled>
            @error('valor_aposta')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-lg-2 mt-4">
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </div>

</form>


<script>

    $(document).ready(function () {
        $("#inputUsuario").mask("000.000.000-00", { reverse: true });
        $("#inputPlacarMandante").mask("00", { reverse: true });
        $("#inputPlacarVisitante").mask("00", { reverse: true });
    });

</script>