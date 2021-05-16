@extends('layouts.partials.master')
@section('conteudo')
    <div class="col-md-12">
        <div class="row">
            <form id="buscar-funcionario-form" class="col-md-6 offset-md-3 mb-4 cadastro" action="{{ route('auth.on.livro.consultar') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="matricula">Matrícula:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="matricula" id="matricula" autocomplete="off" aria-describedby="matricula-error" value="{{ old('matricula') }}" required>
                            <div class="input-group-append">
                                <button class="btn search-button" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                        <small id="matricula-error" class="form-text">{{ $errors->has('matricula') ? $errors->first('matricula') : ''}}</small>
                    </div>
                </div>
            </form>
        </div>

        <div class="row table-responsive">
            <table id="funcionario-table" class="col-md-12 table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Matrícula</th>
                        <th scope="col">Status</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Cargo</th>
                        <th scope="col">Nível de Acesso</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>216115518</td>
                        <td class="status">
                            <i class="fas fa-circle text-success" data-toggle="tooltip" title="Ativo"></i>
                        </td>
                        <td>Matheus Almeida da Rocha</td>
                        <td>Atendente</td>
                        <td>Administrador</td>
                        <td class="action">
                            <ul>
                                <li data-toggle="tooltip" title="Alterar Permissão">
                                    <a 
                                        href="#"
                                        class="btn btn-link"
                                        role="button"
                                        aria-disabled="true"
                                        data-toggle="modal"
                                        data-target="#modal-alterar-permissao"
                                        data-id-usuario="1"
                                    >
                                        <i class="fas fa-key"></i>
                                    </a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="modal fade" id="modal-alterar-permissao" tabindex="-1" role="dialog" aria-labelledby="modal-alterar-permissao" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Alterar Permissão</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <form id="alterar-permissao-form" class="col-md-12 cadastro" method="POST">
                                    @csrf

                                    <div class="col-md-5 form-group">
                                        <label for="acesso">Nível de Acesso:</label>
                                        <select class="form-control" id="acesso" name="acesso" required>
                                            <option value="1">Administrador</option>
                                            <option value="2">Funcionário</option>
                                            <option value="3">Estudante</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn operacao-btn">ALTERAR</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/consultar.css') }}">
@endpush