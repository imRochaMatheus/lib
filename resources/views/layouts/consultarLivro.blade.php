@extends('layouts.partials.master')
@section('conteudo')
    <form id="buscar-livro-form" class="col-md-6 cadastro" action="{{ route('auth.on.livro.consultar') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-12">
                <label for="codigo">Código do Livro:</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="codigo" id="codigo" autocomplete="off" aria-describedby="codigo-error" value="{{ old('codigo') }}" required>
                    <div class="input-group-append">
                        <button class="btn search-button" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </div>
                <small id="codigo-error" class="form-text">{{ $errors->has('codigo') ? $errors->first('codigo') : ''}}</small>
            </div>
        </div>
    </form>
@endsection