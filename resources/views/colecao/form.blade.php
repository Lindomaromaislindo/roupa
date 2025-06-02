@extends('base')
@section('titulo', 'Formulário Coleção')
@section('conteudo')

<div class="card shadow p-4 mb-4 border-success">
    <h3 class="text-success mb-4">Formulário Coleção</h3>

    @php
        if (!empty($dado->id)) {
            $action = route('colecao.update', $dado->id);
        } else {
            $action = route('colecao.store');
        }
    @endphp

    <form action="{{ $action }}" method="post" class="row g-3">
        @csrf

        @if (!empty($dado->id))
            @method('put')
        @endif

        <div class="col-md-6">
            <label for="nome_colecao" class="form-label">Nome da Coleção</label>
            <input
                type="text"
                name="nome_colecao"
                id="nome_colecao"
                value="{{ old('nome_colecao', $dado->nome_colecao ?? '') }}"
                class="form-control border-primary"
                placeholder="Digite o nome da coleção"
                required
            >
        </div>

        <div class="col-md-6">
            <label for="data_lancamento" class="form-label">Data de Lançamento</label>
            <input
                type="date"
                name="data_lancamento"
                id="data_lancamento"
                value="{{ old('data_lancamento', isset($dado->data_lancamento) ? \Carbon\Carbon::parse($dado->data_lancamento)->format('Y-m-d') : '') }}"
                class="form-control border-success"
                required
            >
        </div>

        <div class="col-md-6">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea
                name="descricao"
                id="descricao"
                rows="4"
                class="form-control border-success"
                placeholder="Descreva a coleção"
                required
            >{{ old('descricao', $dado->descricao ?? '') }}</textarea>
        </div>

        <div class="col-12 mt-4">
            <button type="submit" class="btn btn-success me-2">Salvar</button>
            <a href="{{ url('cliente') }}" class="btn btn-outline-success">Voltar</a>
        </div>
    </form>
</div>

@stop
