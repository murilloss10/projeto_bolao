<h4><strong class="mb-3">Todos os Clubes</strong></h4>
<table class="table table-responsive">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>Abreviação</th>
            <th>Escudo</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($clubes))
            @foreach ($clubes as $clube)
                <tr>
                    <td>
                        @if ($clube->deleted_at == NULL)
                            {{ $clube->id }}    
                        @else
                            <s>{{ $clube->id }}</s>
                        @endif
                    </td>
                    <td>
                        @if ($clube->deleted_at == NULL)
                            {{ $clube->nome }}    
                        @else
                            <s>{{ $clube->nome }}</s>
                        @endif
                    </td>
                    <td>
                        @if ($clube->deleted_at == NULL)
                            {{ $clube->abreviacao }}    
                        @else
                            <s>{{ $clube->abreviacao }}</s>
                        @endif
                    </td>
                    <td><img src="{{ $clube->url_escudo }}" alt="Escudo {{ $clube->nome }}" title="{{ $clube->nome }}" style="width: 20px"></td>
                    <td>
                        <a href="{{ route('clubes.formEditar', $clube->id) }}">Editar</a>
                        @if ($clube->deleted_at == NULL)
                            <a href="{{ route('clubes.excluir', $clube->id) }}">Excluir</a>
                        @else
                            <a href="{{ route('clubes.restaurar', $clube->id) }}">Ativar</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        @else
            
        @endif
    </tbody>
</table>