@extends('layouts.partials.master')
@section('conteudo')
    <div class="col-md-12">
        <div class="row">
            <form id="buscar-emprestimo-form" class="col-md-6 offset-md-3 mb-4 cadastro" action="{{ route('auth.on.emprestimo.consultar') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="buscar-por">Buscar por:</label>
                        <select class="form-control" id="buscar-por" name="buscar-por" required>
                            <option value="1" selected>Matrícula</option>
                            <option value="2">Livro</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 form-group matricula">
                        <label for="matricula">Matrícula:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="matricula" id="matricula" autocomplete="off" aria-describedby="matricula-error" value="{{ old('matricula') }}">
                            <div class="input-group-append">
                                <button class="btn search-button" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                        <small id="matricula-error" class="form-text">{{ $errors->has('matricula') ? $errors->first('matricula') : ''}}</small>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 form-group codigo">
                        <label for="codigo">Código do Livro:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="codigo" id="codigo" autocomplete="off" aria-describedby="codigo-error" value="{{ old('codigo') }}">
                            <div class="input-group-append">
                                <button class="btn search-button" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                        <small id="codigo-error" class="form-text">{{ $errors->has('codigo') ? $errors->first('codigo') : ''}}</small>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ route('auth.on.emprestimo.realizar') }}" class="btn novo-emprestimo" role="button">
                            <i class="fas fa-plus"></i> <strong>Novo Empréstimo</strong>
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <div class="row table-responsive">
            <table id="emprestimo-table" class="col-md-12 table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Título</th>
                        <th scope="col">Autor</th>
                        <th scope="col">Empréstimo</th>
                        <th scope="col">Limite</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>123456</td>
                        <td>O Nome do Vento</td>
                        <td>Patrick Rothfuss</td>
                        <td>12/05/2021</td>
                        <td>19/05/2021</td>
                        <td class="status">
                            <i class="fas fa-circle text-success" data-toggle="tooltip" title="Devolvido"></i>
                        </td>
                        <td class="action">
                            @if(1 == 2)
                                <ul>
                                    <li>
                                        <a href="#" class="btn btn-link" role="button" aria-disabled="true" data-toggle="tooltip" title="Devolver">
                                            <i class="fas fa-reply"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="btn btn-link" role="button" aria-disabled="true" data-toggle="tooltip" title="Renovar">
                                            <i class="fas fa-exchange-alt"></i>
                                        </a>
                                    </li>
                                </ul>
                            @else
                                <ul>
                                    <li>
                                        <a href="#" class="btn btn-link disabled" role="button" aria-disabled="true" data-toggle="tooltip" title="Devolver">
                                            <i class="fas fa-reply"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="btn btn-link disabled" role="button" aria-disabled="true" data-toggle="tooltip" title="Renovar">
                                            <i class="fas fa-exchange-alt"></i>
                                        </a>
                                    </li>
                                </ul>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>123456</td>
                        <td>O Nome do Vento</td>
                        <td>Patrick Rothfuss</td>
                        <td>12/05/2021</td>
                        <td>19/05/2021</td>
                        <td class="status">
                            <i class="fas fa-circle text-danger" data-toggle="tooltip" title="Não Devolvido"></i>
                        </td>
                        <td class="action">
                            @if(2 == 2)
                                <ul>
                                    <li data-toggle="tooltip" title="Devolver">
                                        <a href="#" class="btn btn-link" role="button" aria-disabled="true" data-toggle="modal" data-target="#modal-devolver">
                                            <i class="fas fa-reply"></i>
                                        </a>
                                    </li>
                                    <li data-toggle="tooltip" title="Renovar">
                                        <a href="#" class="btn btn-link" role="button" aria-disabled="true" data-toggle="modal" data-target="#modal-renovar">
                                            <i class="fas fa-exchange-alt"></i>
                                        </a>
                                    </li>
                                </ul>
                            @else
                                <ul>
                                    <li>
                                        <a href="#" class="btn btn-link disabled" role="button" aria-disabled="true" data-toggle="tooltip" title="Devolver">
                                            <i class="fas fa-reply"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="btn btn-link disabled" role="button" aria-disabled="true" data-toggle="tooltip" title="Renovar">
                                            <i class="fas fa-exchange-alt"></i>
                                        </a>
                                    </li>
                                </ul>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="modal fade" id="modal-devolver" tabindex="-1" role="dialog" aria-labelledby="modal-devolver" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form method="POST">
                        <input type="hidden" id="id-livro" name="id-livro" value="1">
                        <div class="modal-header">
                            <h4 class="modal-title">Devolver Livro</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Deseja devolver o livro <span class="livro">[123456] O Nome do Vento</span>?
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn operacao-btn">Devolver</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-renovar" tabindex="-1" role="dialog" aria-labelledby="modal-renovar" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form method="POST">
                        <div class="modal-header">
                            <h4 class="modal-title">Renovar Livro</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Deseja renovar o livro <span class="livro">[123456] O Nome do Vento</span> por mais <strong>7 dias</strong>?
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn operacao-btn">Renovar</button>
                        </div>
                    </form>
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
            $('.matricula').show();
            $('.codigo').hide();

            $('#buscar-por').change(function() {
                if(this.value === '1') {
                    $('.matricula').show();
                    $('.codigo').hide();
                } else {
                    $('.matricula').hide();
                    $('.codigo').show();
                }
            });
        });
    </script>
@endpush