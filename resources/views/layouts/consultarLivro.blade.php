
@extends('layouts.partials.master')
@section('conteudo')

    <div class="col-md-12">
        <div class="row">
            <form id="buscar-livro-form" class="col-md-6 offset-md-3 mb-4 cadastro" action="{{ route('auth.on.livro.consultar') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="codigo-livro">Código do Livro:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="codigo" id="codigo-livro" autocomplete="off" aria-describedby="codigo-error" value="{{ old('codigo') }}" >
                            <div class="input-group-append">
                                <button class="btn search-button" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                        <small id="codigo-error" class="form-text">{{ $errors->has('codigo') ? $errors->first('codigo') : ''}}</small>
                    </div>
                </div>

                @if(isset($acesso) && $acesso != 3)
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('auth.on.livro.cadastrar') }}" class="btn novo-exemplar" role="button">
                                <i class="fas fa-plus"></i> <strong>Novo Livro</strong>
                            </a>
                        </div>
                    </div>
                @endif
            </form>
        </div>

        <div class="row table-responsive">
            <table id="livro-table" class="col-md-12 table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Título</th>
                        <th scope="col">Autor</th>
                        <th scope="col">Editora</th>
                        <th scope="col">Edição</th>
                        <th scope="col">Volume</th>
                        <th scope="col">Páginas</th>
                        <th scope="col">Empréstimos</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($livros) && count($livros) > 0)
                        @foreach ($livros as $livro)
                            <tr>
                                <td>{{$livro->codigo}}</td>
                                <td>{{$livro->titulo}}</td>
                                <td>{{$livro->autor}}</td>
                                <td>{{$livro->editora}}</td>
                                <td>{{$livro->edicao}}</td>
                                <td>{{$livro->volume}}</td>
                                <td>{{$livro->numero_de_paginas}}</td>
                                <td>{{$livro->numero_de_emprestimos}}</td>
                                <td class="action">
                                    <ul>
                                        <li data-toggle="tooltip" title="Ver mais">
                                            <a 
                                                href="#"
                                                class="btn btn-link"
                                                role="button"
                                                aria-disabled="true"
                                                data-toggle="modal"
                                                data-target="#modal-ver-mais"
                                                data-codigo="{{$livro->codigo}}"
                                                data-emprestimos="{{$livro->numero_de_emprestimos}}"
                                                data-nome="{{$livro->titulo}}"
                                                data-autor="{{$livro->autor}}"
                                                data-editora="{{$livro->editora}}"
                                                data-edicao="{{$livro->edicao}}"
                                                data-volume="{{$livro->volume}}"
                                                data-paginas="{{$livro->numero_de_paginas}}"
                                                data-descricao="{{$livro->descricao}}"
                                                data-foto="{{asset($livro->foto)}}"
                                            >
                                                <i class="fas fa-search-plus"></i>
                                            </a>
                                        </li>
                                        <li data-toggle="tooltip" title="Visualizar comentários">
                                            <a 
                                                href="#"
                                                class="btn btn-link"
                                                role="button"
                                                aria-disabled="true"
                                                data-toggle="modal"
                                                data-target="#modal-visualizar-comentarios"
                                                data-comentarios="{{ $livro->comentario }}"
                                            >
                                                <i class="far fa-comments"></i>
                                            </a>
                                        </li>
                                        @if(isset($acesso))
                                            @if($acesso == 1)
                                                <li data-toggle="tooltip" title="Editar">
                                                    <a 
                                                        href="#"
                                                        class="btn btn-link"
                                                        role="button"
                                                        aria-disabled="true"
                                                        data-toggle="modal"
                                                        data-target="#modal-editar"
                                                        data-codigo="{{$livro->codigo}}"
                                                        data-emprestimos="{{$livro->numero_de_emprestimos}}"
                                                        data-nome="{{$livro->titulo}}"
                                                        data-autor="{{$livro->autor}}"
                                                        data-editora="{{$livro->editora}}"
                                                        data-edicao="{{$livro->edicao}}"
                                                        data-volume="{{$livro->volume}}"
                                                        data-paginas="{{$livro->numero_de_paginas}}"
                                                        data-descricao="{{$livro->descricao}}"
                                                    >
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </li>
                                            @elseif($acesso == 3)
                                                <li data-toggle="tooltip" title="Comentar">
                                                    <a 
                                                        href="#"
                                                        class="btn btn-link"
                                                        role="button"
                                                        aria-disabled="true"
                                                        data-toggle="modal"
                                                        data-target="#modal-comentar"
                                                        data-codigo="{{$livro->codigo}}"
                                                    >
                                                        <i class="far fa-comment"></i>
                                                    </a>
                                                </li>
                                            @endif
                                        @endif
                                    </ul>
                                </td>
                            </tr>                        
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9">Nenhum registro encontrado</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <div class="modal fade" id="modal-ver-mais" tabindex="-1" role="dialog" aria-labelledby="modal-ver-mais" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <img class="book-img" src="" width="140">
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>
                                                <span class="label">Código:</span>
                                                <br>
                                                <span class="codigo"></span>
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <span class="label">Empréstimos:</span>
                                                <br>
                                                <span class="emprestimos"></span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>
                                                <span class="label">Nome:</span>
                                                <br>
                                                <span class="nome"></span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>
                                                <span class="label">Autor:</span>
                                                <br>
                                                <span class="autor"></span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p>
                                        <span class="label">Editora:</span>
                                        <br>
                                        <span class="editora"></span>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <p>
                                        <span class="label">Edição:</span>
                                        <br>
                                        <span class="edicao"></span>
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <span class="label">Volume:</span>
                                        <br>
                                        <span class="volume"></span>
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <span class="label">Páginas:</span>
                                        <br>
                                        <span class="paginas"></span>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p>
                                        <span class="label">Descrição:</span>
                                        <br>
                                        <span class="descricao"></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-editar" tabindex="-1" role="dialog" aria-labelledby="modal-editar" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Editar Livro</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <form id="editar-livro-form" class="col-md-12 cadastro" action="{{ route('auth.on.livro.editar') }}" method="POST">
                                    @csrf
                            
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label for="codigo" hidden>Código:</label>
                                        </div>
                                        <div class="col-md-5 from-group">
                                            <label for="n_exemplares" hidden>Nº de Exemplares:</label>
                                        </div>
                                    </div>
                            
                                    <div class="row">
                                        <div class="col-md-5 form-group">
                                            <input type="text" class="form-control" name="codigo" id="codigo" autocomplete="off" aria-describedby="codigo-error" value="{{ old('codigo') }}" hidden>
                                            <small id="codigo-error" class="form-text">{{ $errors->has('codigo') ? $errors->first('codigo') : ''}}</small>
                                        </div>
                                        <div class="col-md-4 from-group">
                                            <input type="number" min="1" class="form-control" name="n_exemplares" id="n_exemplares" autocomplete="off" aria-describedby="n_exemplares-error" value="{{ old('n_exemplares') }}" hidden>
                                            <small id="n_exemplares-error" class="form-text">{{ $errors->has('n_exemplares') ? $errors->first('n_exemplares') : ''}}</small>
                                        </div>
                                    </div>
                            
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label for="titulo">Título:</label>
                                            <input type="text" class="form-control" name="titulo" id="titulo" autocomplete="off" aria-describedby="titulo-error" value="{{ old('titulo') }}" required>
                                            <small id="titulo-error" class="form-text">{{ $errors->has('titulo') ? $errors->first('titulo') : ''}}</small>
                                        </div>
                                    </div>
                            
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="autor">Autor:</label>
                                            <input type="text" class="form-control" name="autor" id="autor" aria-describedby="autor-error" value="{{ old('autor') }}" required>
                                            <small id="autor-error" class="form-text">{{ $errors->has('autor') ? $errors->first('autor') : ''}}</small>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="editora">Editora:</label>
                                            <input type="text" class="form-control" name="editora" id="editora" aria-describedby="editora-error" value="{{ old('editora') }}" required>
                                            <small id="editora-error" class="form-text">{{ $errors->has('editora') ? $errors->first('editora') : ''}}</small>
                                        </div>
                                    </div>
                            
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <label for="edicao">Edição:</label>
                                            <input type="number" min="1" class="form-control" name="edicao" id="edicao" aria-describedby="edicao-error" value="{{ old('edicao') }}" required>
                                            <small id="edicao-error" class="form-text">{{ $errors->has('edicao') ? $errors->first('edicao') : ''}}</small>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="volume">Volume:</label>
                                            <input type="number" min="1" class="form-control" name="volume" id="volume" aria-describedby="volume-error" value="{{ old('volume') }}" required>
                                            <small id="volume-error" class="form-text">{{ $errors->has('volume') ? $errors->first('volume') : ''}}</small>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="numero_de_paginas">Nº de páginas:</label>
                                            <input type="number" min="1" class="form-control" name="numero_de_paginas" id="numero_de_paginas" aria-describedby="paginas-error" value="{{ old('numero_de_paginas') }}" required>
                                            <small id="paginas-error" class="form-text">{{ $errors->has('numero_de_paginas') ? $errors->first('numero_de_paginas') : ''}}</small>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label for="descricao">Descrição:</label>
                                            <textarea class="form-control" name="descricao" id="descricao" aria-describedby="descricao-error" value="{{ old('descricao') }}" required></textarea>
                                            <small id="descricao-error" class="form-text">{{ $errors->has('descricao') ? $errors->first('descricao') : ''}}</small>
                                        </div>
                                    </div>
                            
                                    <button type="submit" class="btn btn-block mt-4">EDITAR</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-comentar" tabindex="-1" role="dialog" aria-labelledby="modal-comentar" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <form id="comentar-livro-form" class="col-md-12 cadastro" method="POST" action="{{ route('auth.on.livro.comentar') }}">
                                    @csrf

                                    <input type="hidden" name="codigo">
                            
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label for="comentario">Comentário:</label>
                                            <textarea class="form-control" name="comentario" id="comentario" maxlength="256" aria-describedby="comentario-error" value="{{ old('comentario') }}" required></textarea>
                                            <small id="comentario-error" class="form-text">{{ $errors->has('comentario') ? $errors->first('comentario') : ''}}</small>
                                        </div>
                                    </div>   
                            
                                    <button type="submit" class="btn btn-block mt-4">COMENTAR</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-visualizar-comentarios" tabindex="-1" role="dialog" aria-labelledby="modal-visualizar-comentarios" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container-fluid">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/consultar.css') }}">
@endpush

@push('scripts')
    <script type="text/javascript">
        $(function() {
            $('#modal-ver-mais').on('show.bs.modal', function (event) {
                let button = $(event.relatedTarget);
                let modal = $(this);

                let codigo = button.data('codigo');
                let exemplares = button.data('exemplares');
                let emprestimos = button.data('emprestimos');
                let nome = button.data('nome');
                let autor = button.data('autor');
                let editora = button.data('editora');
                let edicao = button.data('edicao');
                let volume = button.data('volume');
                let paginas = button.data('paginas');
                let descricao = button.data('descricao');
                let foto = button.data('foto');

                modal.find('.modal-title').text(`[${codigo}] ${nome}`);
                modal.find('.codigo').text(codigo);
                modal.find('.exemplares').text(exemplares);
                modal.find('.emprestimos').text(emprestimos);
                modal.find('.nome').text(nome);
                modal.find('.autor').text(autor);
                modal.find('.editora').text(editora);
                modal.find('.edicao').text(edicao + 'ª');
                modal.find('.volume').text(volume);
                modal.find('.paginas').text(paginas);
                modal.find('.descricao').text(descricao);
                modal.find('.book-img').attr('src', foto);
            });

            $('#modal-editar').on('show.bs.modal', function (event) {
                let button = $(event.relatedTarget);
                let modal = $(this);

                let codigo = button.data('codigo');
                let exemplares = button.data('exemplares');
                let nome = button.data('nome');
                let autor = button.data('autor');
                let editora = button.data('editora');
                let edicao = button.data('edicao');
                let volume = button.data('volume');
                let paginas = button.data('paginas');
                let descricao = button.data('descricao');

                modal.find('input[name="codigo"]').val(codigo);
                modal.find('input[name="n_exemplares"]').val(exemplares);
                modal.find('input[name="titulo"]').val(nome);
                modal.find('input[name="autor"]').val(autor);
                modal.find('input[name="editora"]').val(editora);
                modal.find('input[name="edicao"]').val(edicao);
                modal.find('input[name="volume"]').val(volume);
                modal.find('input[name="numero_de_paginas"]').val(paginas);
                modal.find('textarea[name="descricao"]').val(descricao);
            });

            $('#modal-comentar').on('show.bs.modal', function (event) {
                let button = $(event.relatedTarget);
                let modal = $(this);

                let codigo = button.data('codigo');

                modal.find('input[name="codigo"]').val(codigo);
            });

            $('#modal-visualizar-comentarios').on('show.bs.modal', function (event) {
                let button = $(event.relatedTarget);
                let modal = $(this);

                let comentarios = button.data('comentarios');

                let todosComentarios = '';
                if (comentarios.length === 0) {
                    todosComentarios += `
                        <div class="row">
                            <div class="col-md-12">
                                <blockquote>
                                    <p>
                                        Ainda não há comentários para esse livro.
                                    </p>
                                </blockquote>
                            </div>
                        </div>
                    `;
                }

                for(let i = 0; i < comentarios.length; i++) {
                    todosComentarios += `
                        <div class="row">
                            <div class="col-md-12">
                                <blockquote>
                                    <p class="mb-0">
                                        ${comentarios[i].comentario}
                                    </p>
                                    <footer class="blockquote-footer">${comentarios[i].nome}</footer>
                                </blockquote>
                            </div>
                        </div>
                    `;

                    if (i < comentarios.length - 1) {
                        todosComentarios += '<hr>'
                    }
                }

                modal.find('.container-fluid').html(todosComentarios);
            });
        });
    </script>
@endpush