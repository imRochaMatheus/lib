@extends('layouts.partials.master')
@section('conteudo')
    <form id="cadastro-livro-form" class="col-md-6 cadastro" action="{{route('livro')}}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-4">
                <label for="codigo">Código:</label>
                <input type="text" class="form-control" name="codigo" id="codigo" autocomplete="off" aria-describedby="codigo-error" value="{{ old('codigo') }}" required>
                <small id="codigo-error" class="form-text">{{ $errors->has('codigo') ? $errors->first('codigo') : ''}}</small>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label for="titulo">Título:</label>
                <input type="text" class="form-control" name="titulo" id="titulo" autocomplete="off" aria-describedby="titulo-error" value="{{ old('titulo') }}" required>
                <small id="titulo-error" class="form-text">{{ $errors->has('titulo') ? $errors->first('titulo') : ''}}</small>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="autor">Autor:</label>
                <input type="text" class="form-control" name="autor" id="autor" aria-describedby="autor-error" value="{{ old('autor') }}" required>
                <small id="autor-error" class="form-text">{{ $errors->has('autor') ? $errors->first('autor') : ''}}</small>
            </div>
            <div class="col-md-6">
                <label for="editora">Editora:</label>
                <input type="text" class="form-control" name="editora" id="editora" aria-describedby="editora-error" value="{{ old('editora') }}" required>
                <small id="editora-error" class="form-text">{{ $errors->has('editora') ? $errors->first('editora') : ''}}</small>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <label for="edicao">Edição:</label>
                <input type="number" min="1" class="form-control" name="edicao" id="edicao" aria-describedby="edicao-error" value="{{ old('edicao') }}" required>
                <small id="edicao-error" class="form-text">{{ $errors->has('edicao') ? $errors->first('edicao') : ''}}</small>
            </div>
            <div class="col-md-4">
                <label for="volume">Volume:</label>
                <input type="number" min="1" class="form-control" name="volume" id="volume" aria-describedby="volume-error" value="{{ old('volume') }}" required>
                <small id="volume-error" class="form-text">{{ $errors->has('volume') ? $errors->first('volume') : ''}}</small>
            </div>
            <div class="col-md-4">
                <label for="numero_de_paginas">Nº de páginas:</label>
                <input type="number" min="1" class="form-control" name="numero_de_paginas" id="numero_de_paginas" aria-describedby="paginas-error" value="{{ old('numero_de_paginas') }}" required>
                <small id="paginas-error" class="form-text">{{ $errors->has('numero_de_paginas') ? $errors->first('numero_de_paginas') : ''}}</small>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <label for="descricao">Descrição:</label>
                <textarea class="form-control" name="descricao" id="descricao" placeholder="Uma breve descrição..." aria-describedby="descricao-error" value="{{ old('descricao') }}" required></textarea>
                <small id="descricao-error" class="form-text">{{ $errors->has('descricao') ? $errors->first('descricao') : ''}}</small>
            </div>
        </div>

        <button type="submit" class="btn btn-block mt-4">CADASTRAR</button>
    </form>
@endsection