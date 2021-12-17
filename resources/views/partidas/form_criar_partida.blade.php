<h4><strong class="mb-3">Adicionar Partida</strong></h4>

@if (isset($mensagem))
    <p>{{ $mensagem }}</p>
@endif

<form method="POST" action="{{ route('partidas.criar') }}">

    @csrf

    <div class="row mt-4">
        <div class="col-lg-6">
            <label for="inputCampeonato" class="form-label">Campeonato</label>
            <input type="text" class="form-control" name="campeonato" id="inputCampeonato" value="{{ old('campeonato') }}">
            @error('campeonato')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-lg-2">
            <label for="inputRodada" class="form-label">Rodada</label>
            <select class="form-control" name="rodada" id="inputRodada" value="{{ old('rodada') }}">
                <option value="">...</option>
                @for ($i = 1; $i <= 38; $i++)
                    <option value="{{ $i . 'ª' }}">{{ $i }}</option>
                @endfor
            </select>
            @error('rodada')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-lg-3">
            <label for="inputFase" class="form-label">Fase</label>
            <input type="text" class="form-control" name="fase" id="inputFase" value="{{ old('fase') }}">
            @error('fase')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-lg-5 pr-0">
            <label for="inputTMandante" class="form-label">Time Mandante</label>
            <select class="form-control" name="clube_casa_id" id="inputTMandante" value="{{ old('clube_casa_id') }}">
                <option value="">Selecione um time</option>
                @foreach ($clubes as $clube)
                    <option value="{{ $clube->id }}">{{ $clube->nome }}</option>
                @endforeach
            </select>
            @error('clube_casa_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-lg-1">
            <label for="inputX" class="form-label"></label>
            <h1 style="text-align: center;" id="inputX">X</h1>
        </div>
        <div class="col-lg-5 pl-0">
            <label for="inputTVisitante" class="form-label">Time Visitante</label>
            <select class="form-control" name="clube_visitante_id" id="inputTVisitante" value="{{ old('clube_visitante_id') }}">
                <option value="">Selecione um time</option>
                @foreach ($clubes as $clube)
                    <option value="{{ $clube->id }}">{{ $clube->nome }}</option>
                @endforeach
            </select>
            @error('clube_visitante_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-lg-4">
            <label for="inputPData" class="form-label">Data</label>
            <input type="date" class="form-control" name="partida_data" id="inputPData" value="{{ old('partida_data') }}">
            @error('partida_data')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-lg-2">
            <label for="inputPHorario" class="form-label">Horário</label>
            <input type="text" class="form-control" name="partida_horario" id="inputPHorario" value="{{ old('partida_horario') }}">
            @error('partida_horario')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-lg-5">
            <label for="inputPLocal" class="form-label">Local</label>
            <input type="text" class="form-control" name="local" id="inputLocal" value="{{ old('local') }}">
            @error('local')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Salvar</button>

</form>


<script>

    $(document).ready(function () {
        $("#inputPHorario").mask("00:00", { reverse: true });
    });

</script>