@extends('base')
@section('titulo', 'Listagem de Coleções')
@section('conteudo')

<div class="card shadow p-4 mb-4 border-primary">
    <h3 class="text-success mb-4">Listagem de Coleções</h3>

    <form action="{{ route('colecao.search') }}" method="post" class="row g-3 mb-4">
        @csrf
        <div class="col-md-4">
            <label for="tipo" class="form-label">Buscar por</label>
            <select name="tipo" id="tipo" class="form-select border-success">
                <option value="nome_colecao">Nome</option>
                <option value="descricao">Descrição</option>
            </select>
        </div>

        <div class="col-md-5">
            <label for="valor" class="form-label">Valor</label>
            <input
                type="text"
                name="valor"
                id="valor"
                placeholder="Digite o valor"
                value="{{ old('valor') }}"
                class="form-control border-success"
            >
        </div>

        <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-success me-2">Buscar</button>
            <a href="{{ route('colecao.create') }}" class="btn btn-outline-success">Nova Coleção</a>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-success">
                <tr>
                    <th>ID</th>
                    <th>Nome da Coleção</th>
                    <th>Descrição</th>
                    <th>Data de Lançamento</th>
                    <th class="text-center">Editar</th>
                    <th class="text-center">Excluir</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($colecao as $colecao)
                    <tr>
                        <td>{{ $colecao->id }}</td>
                        <td>{{ $colecao->nome_colecao }}</td>
                        <td>{{ $colecao->descricao }}</td>
                        <td>{{ \Carbon\Carbon::parse($colecao->data_lancamento)->format('d/m/Y') }}</td>
                        <td class="text-center">
                            <a href="{{ route('colecao.edit', $colecao->id) }}" class="btn btn-sm btn-outline-success">Editar</a>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('colecao.destroy', $colecao->id) }}" method="post" onsubmit="return confirm('Deseja remover esta coleção?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Remover</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Nenhuma coleção encontrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@stop
