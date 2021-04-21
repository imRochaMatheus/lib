@include('layouts.partials.basico')
@section('conteudo')



<div class="container col-md-8 mt-5">
    <div class="card">
        <div class="card-header">
            <center>
                Cadastro de Livros
            </center>      
        </div>
        <div class="card-body">
            <form action="{{route('livro')}}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-8">
                        <label for="codigo">Código: </label>
                        <input type="text" class="form-control" name="codigo" placeholder="Código" id="codigo" autocomplete="off" required value = {{ old('codigo') }}>
                        {{ $errors->has('codigo') ? $errors->first('codigo') : ''}}
                    </div>
                    <div class="col-md-4">
                        <label for="titulo">Título:</label>
                        <input type="text" class="form-control" name="titulo"  autocomplete="off" placeholder="Título" id="titulo" required value = {{ old('titulo') }}>
                        {{ $errors->has('titulo') ? $errors->first('titulo') : ''}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <label for="autor">Autor: </label>
                        <input type="text" class="form-control" name="autor" placeholder="Autor" id="autor" required value = {{ old('autor') }}>
                        {{ $errors->has('autor') ? $errors->first('autor') : ''}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <label for="editora">Editora: </label>
                        <input type="text" class="form-control" name="editora" placeholder="editora" id="editora" required value = {{ old('editora') }}>
                        {{ $errors->has('editora') ? $errors->first('editora') : ''}}
                    </div>
                    <div class="col-md-4">
                        <label for="edicao">Edição:</label>
                        <input type="number" min="0" class="form-control" name="edicao" placeholder="Edição..." id="edicao" required value = {{ old('edicao') }}>
                        {{ $errors->has('edicao') ? $errors->first('edicao') : ''}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <label for="volume">Volume:</label>
                        <input type="number" class="form-control" name="volume" placeholder="Volume..." id="volume" value = {{ old('volume') }}>
                        {{ $errors->has('colume') ? $errors->first('volume') : ''}}
                    </div>
                    <div class="col-md-4">
                        <label for="numero_de_paginas">N° de páginas:</label>
                        <input type="number" min="0" class="form-control" name="numero_de_paginas" placeholder="Número de páginas" id="numero_de_paginas" required value = {{ old('numero_de_paginas') }}>
                        {{ $errors->has('numero_de_paginas') ? $errors->first('numero_de_paginas') : ''}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="descricao">Descrição:</label>
                        <textarea  class="form-control" name="descricao" autocomplete="off" placeholder="Uma breve descrição..." id="descricao" value = {{ old('descricao') }}></textarea>
                        {{ $errors->has('descricao') ? $errors->first('desricao') : ''}}
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-4">Cadastrar</button>
            </form>
        </div>
    </div>
</div>





