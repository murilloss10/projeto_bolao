<form method="POST" action="{{ route('perfil.criar') }}">
                        
    @csrf

    <div class="mb-3 mt-4">
        {{-- <input type="text" class="form-control" id="inputId" value="{{ $user_id }}" name="user_id" hidden> --}}
    </div>
    <div class="mb-3">
        <label for="inputNome" class="form-label">Nome</label>
        {{-- <input type="text" class="form-control" id="inputNome" value="{{ $usuario_nome }}" disabled> --}}
    </div>
    <div class="mb-3">
        <label for="inputSobrenome" class="form-label">Sobrenome</label>
        <input type="text" class="form-control" id="inputSobrenome" value="" name="sobrenome">
        @error('sobrenome')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="inputEmail" class="form-label">Email</label>
        {{-- <input type="email" class="form-control" id="inputEmail" value="{{ $usuario_email }}" disabled> --}}
    </div>
    <div class="mb-3">
        <label for="inputCpf" class="form-label">CPF</label>
        <input type="text" class="form-control" id="inputCpf" value="" name="cpf">
        @error('cpf')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>

</form>