<h4><strong class="mb-3">Editar Partida</strong></h4>

<form method="POST" action="{{ route('partidas.editar') }}">

    @csrf

    <input type="text" name="id" value="{{ $partida_editar->id }}" hidden>
    <div class="row mt-4">
        <div class="col-lg-6">
            <label for="inputCampeonato" class="form-label">Campeonato</label>
            <input type="text" class="form-control" name="campeonato" id="inputCampeonato" value="{{ $partida_editar->campeonato }}">
            @error('campeonato')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-lg-2">
            <label for="inputRodada" class="form-label">Rodada</label>
            <select class="form-control" name="rodada" id="inputRodada">
                <option value="">...</option>
                @for ($i = 1; $i <= 38; $i++)
                    <option {{ $partida_editar->rodada == $i.'ª' ? "selected" : "" }} value="{{ $i . 'ª' }}">{{ $i }}</option>
                @endfor
            </select>
            @error('rodada')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-lg-3">
            <label for="inputFase" class="form-label">Fase</label>
            <input type="text" class="form-control" name="fase" id="inputFase" value="{{ $partida_editar->fase }}">
            @error('fase')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-lg-5 pr-0">
            <label for="inputTMandante" class="form-label">Time Mandante</label>
            <select class="form-control" name="clube_casa_id" id="inputTMandante">
                <option value="">Selecione um time</option>
                @foreach ($clubes as $clube)
                    <option {{ $partida_editar->clube_casa_id == $clube->id ? "selected" : "" }} value="{{ $clube->id }}">{{ $clube->nome }}</option>
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
                    <option {{ $partida_editar->clube_visitante_id == $clube->id ? "selected" : "" }} value="{{ $clube->id }}">{{ $clube->nome }}</option>
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
            <input type="date" class="form-control" name="partida_data" id="inputPData" value="{{ $partida_editar->partida_data }}">
            @error('partida_data')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-lg-2">
            <label for="inputPHorario" class="form-label">Horário</label>
            <input type="text" class="form-control" name="partida_horario" id="inputPHorario" value="{{ $partida_editar->partida_horario }}">
            @error('partida_horario')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-lg-5">
            <label for="inputPLocal" class="form-label">Local</label>
            <input type="text" class="form-control" name="local" id="inputLocal" value="{{ $partida_editar->local }}">
            @error('local')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-lg-4">
            <label for="inputValida" class="form-label">Partida Válida</label>
            <select class="form-control" name="valida" id="inputValida">
                <option {{ $partida_editar->valida == true ? "selected" : "" }} value="Sim">Sim</option>
                <option {{ $partida_editar->valida == false ? "selected" : "" }} value="Não">Não</option>
            </select>
        </div>
        <div class="col-lg-3 mt-3">
            <button type="submit" class="btn btn-primary mt-3">Salvar</button>
        </div>
    </div>


</form>



<script>

    $(document).ready(function () {
        $("#inputPHorario").mask("00:00", { reverse: true });
    });

</script>