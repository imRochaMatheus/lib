@extends('layouts.partials.master')
@section('conteudo')
    <form id="emprestimo-form" class="col-md-6 cadastro" action="{{route('emprestimo')}}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-6 form-group">
                <label for="matricula">Matrícula:</label>
                <input type="text" class="form-control" name="matricula" id="matricula" autocomplete="on" aria-describedby="matricula-error" value="{{ old('matricula') }}" required>
                <small id="matriula-error" class="form-text">{{ $errors->has('matricula') ? $errors->first('matricula') : ''}}</small>
            </div>
            <div class="col-md-6 form-group">
                <label for="codigo">Código do Livro:</label>
                <input type="text" class="form-control" name="codigo" id="codigo" autocomplete="on" aria-describedby="codigo-error" value="{{ old('codigo') }}" required>
                <small id="codigo-error" class="form-text">{{ $errors->has('codigo') ? $errors->first('codigo') : ''}}</small>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 form-group">
                <label for="data_emprestimo">Data do empréstimo:</label>
                <input type="date" class="form-control" name="data_emprestimo" id="data_emprestimo" required>
            </div>
        </div>
        <button type="submit" class="btn btn-block mt-4">CADASTRAR</button>
    </form>
@stop






