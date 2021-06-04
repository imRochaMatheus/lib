@extends('layouts.partials.master')
@section('conteudo')
    @if($tipo == 'devolucao')
        <form id="gerar-relatorio-form" class="col-md-6 cadastro" action="{{ route('auth.on.livro.consultar') }}" method="POST">
    @elseif($tipo == 'emprestimo')
        <form id="gerar-relatorio-form" class="col-md-6 cadastro" action="{{ route('auth.on.pdf') }}" method="POST">
    @elseif($tipo == 'livro')
        <form id="gerar-relatorio-form" class="col-md-6 cadastro" action="{{ route('auth.on.livro.pdf') }}" method="POST">
    @endif
        @csrf

        <div class="row">
            <div class="col-md-6 form-group">
                <label for="dataInicial">Data inicial:</label>
                <input type="date" class="form-control" id="dataInicial" name="dataInicial" required>
                </select>
            </div>
        
            <div class="col-md-6 form-group">
                <label for="ano">Data Final</label>
                <input type="date" class="form-control" id="dataFinal" name="dataFinal" required>     
            </div>
        </div>
        
        <button type="submit" class="btn btn-block">GERAR RELATÓRIO</button>        
    </form>
@endsection