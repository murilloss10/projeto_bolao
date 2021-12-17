<h4><strong class="mb-3">Editar Clube</strong></h4>

<form method="POST" action="{{ route('clubes.editar') }}">
                        
    @csrf

    <input type="text" name="id" value="{{ $clube->id }}" hidden>
    <div class="row mt-4">
        <div class="mb-3 col-lg-8">
            <label for="inputNome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="inputNome" name="nome" value="{{ $clube->nome }}">
            @error('nome')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 col-lg-4">
            <label for="inputAbreviacao" class="form-label">Abreviação</label>
            <input type="text" class="form-control" id="inputAbreviacao" name="abreviacao" value="{{ $clube->abreviacao }}" maxlength="3">
            @error('abreviacao')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 col-lg-12">
            <label for="inputUrlEscudo" class="form-label">URL Escudo</label>
            <input type="text" class="form-control" id="inputUrlEscudo" name="url_escudo" value="{{ $clube->url_escudo }}">
            @error('url_escudo')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>

</form>