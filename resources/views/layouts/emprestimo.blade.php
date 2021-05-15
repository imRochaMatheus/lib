@extends('layouts.partials.master')
@section('conteudo')
    <form id="emprestimo-form" class="col-md-6 cadastro" action="{{ route('auth.on.emprestimo.realizar') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-6 form-group">
                <label for="matricula">Matrícula:</label>
                <input type="text" class="form-control" name="matricula" id="matricula" autocomplete="on" aria-describedby="matricula-error" value="{{ old('matricula') }}" required>
                <small id="matriula-error" class="form-text">{{ $errors->has('matricula') ? $errors->first('matricula') : ''}}</small>
            </div>
            <div class="col-md-6 form-group">
                <label for="data_emprestimo">Data do empréstimo:</label>
                <input type="date" class="form-control" name="data_emprestimo" id="data_emprestimo" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="codigo1">Código do Livro:</label>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <input type="text" class="form-control" name="codigo1" id="codigo1" autocomplete="on" aria-describedby="codigo1-error" value="{{ old('codigo1') }}" required>
                <small id="codigo1-error" class="form-text">{{ $errors->has('codigo1') ? $errors->first('codigo1') : ''}}</small>
            </div>
            <div class="col-md-6">
                <button type="button" class="btn btn-block adicionar-livro-button">
                    <i class="fas fa-plus"></i> Adicionar Livro
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 form-group livro2">
                <label for="codigo2">Código do Livro 2:</label>
                <input type="text" class="form-control" name="codigo2" id="codigo2" autocomplete="on" aria-describedby="codigo2-error" value="{{ old('codigo2') }}" required>
                <small id="codigo2-error" class="form-text">{{ $errors->has('codigo2') ? $errors->first('codigo2') : ''}}</small>
            </div>
            <div class="col-md-6 form-group livro3">
                <label for="codigo3">Código do Livro 3:</label>
                <input type="text" class="form-control" name="codigo3" id="codigo3" autocomplete="on" aria-describedby="codigo3-error" value="{{ old('codigo3') }}" required>
                <small id="codigo3-error" class="form-text">{{ $errors->has('codigo3') ? $errors->first('codigo3') : ''}}</small>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 form-group livro4">
                <label for="codigo2">Código do Livro 4:</label>
                <input type="text" class="form-control" name="codigo2" id="codigo2" autocomplete="on" aria-describedby="codigo2-error" value="{{ old('codigo2') }}" required>
                <small id="codigo2-error" class="form-text">{{ $errors->has('codigo2') ? $errors->first('codigo2') : ''}}</small>
            </div>
            <div class="col-md-6 form-group livro5">
                <label for="codigo3">Código do Livro 5:</label>
                <input type="text" class="form-control" name="codigo3" id="codigo3" autocomplete="on" aria-describedby="codigo3-error" value="{{ old('codigo3') }}" required>
                <small id="codigo3-error" class="form-text">{{ $errors->has('codigo3') ? $errors->first('codigo3') : ''}}</small>
            </div>
        </div>
        <button type="submit" class="btn btn-block mt-4">CADASTRAR</button>
    </form>
@stop

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/emprestimo.css') }}">
@endpush

@push('scripts')
    <script type="text/javascript">
        let livroInput = 2;
        $(function() {
            $('.adicionar-livro-button').click(function() {
                if(livroInput <= 5) {
                    if(!$('.livro' + livroInput).is(':visible')) {
                        $('.livro' + livroInput).show();
                        livroInput++;
                    }
                }
            });
        });
    </script>
@endpush






