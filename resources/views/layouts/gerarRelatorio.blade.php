@extends('layouts.partials.master')
@section('conteudo')
    @if($tipo == 'devolucao')
        <form id="gerar-relatorio-form" class="col-md-6 cadastro" action="{{ route('auth.on.livro.consultar') }}" method="POST">
    @elseif($tipo == 'emprestimo')
        <form id="gerar-relatorio-form" class="col-md-6 cadastro" action="{{ route('auth.on.pdf') }}" method="POST">
    @elseif($tipo == 'livro')
        <form id="gerar-relatorio-form" class="col-md-6 cadastro" action="{{ route('auth.on.livro.relatorio') }}" method="POST">
    @endif
        @csrf

        <div class="row">
            <div class="col-md-6 form-group">
                <label for="mes">Mês:</label>
                <select class="form-control" id="mes" name="mes" required>
                    <option value="1" selected>Janeiro</option>
                    <option value="2">Fevereiro</option>
                    <option value="3">Março</option>
                    <option value="4">Abril</option>
                    <option value="5">Maio</option>
                    <option value="6">Junho</option>
                    <option value="7">Julho</option>
                    <option value="8">Agosto</option>
                    <option value="9">Setembro</option>
                    <option value="10">Outubro</option>
                    <option value="11">Novembro</option>
                    <option value="12">Dezembro</option>
                </select>
            </div>
        
            <div class="col-md-6 form-group">
                <label for="ano">Ano:</label>
                <select class="form-control" id="ano" name="ano" required>
                    @for ($i = date('Y'); $i >= 2021; $i--)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
        </div>
        
        <button type="submit" class="btn btn-block">GERAR RELATÓRIO</button>        
    </form>
@endsection