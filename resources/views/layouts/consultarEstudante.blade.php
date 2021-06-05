@extends('layouts.partials.master')
@section('conteudo')
    <div class="col-md-12">
        <div class="row">
            <form id="buscar-funcionario-form" class="col-md-6 offset-md-3 mb-4 cadastro" action="{{ route('auth.on.estudante.consultar') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-12 form-group">
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
            </form>
        </div>

        <div class="row table-responsive">
            <table id="funcionario-table" class="col-md-12 table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Matrícula</th>
                        <th scope="col">Status</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Nível de Acesso</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($estudantes) && count($estudantes) > 0)
                        @foreach($estudantes as $estudante)
                            <tr>
                                <td>{{ $estudante->matricula }}</td>
                                @if($estudante->status)
                                    <td class="status">
                                        <i class="fas fa-circle text-success" data-toggle="tooltip" title="Ativo"></i>
                                    </td>
                                @else
                                    <td class="status">
                                        <i class="fas fa-circle text-danger" data-toggle="tooltip" title="Inativo"></i>
                                    </td>
                                @endif
                                <td>{{ $estudante->nome }}</td>
                                <td>{{ $estudante->nivel_de_acesso }}</td>
                                <td class="action">
                                    <ul>
                                        <li data-toggle="tooltip" title="Remover">
                                            <a 
                                                href="#"
                                                class="btn btn-link"
                                                role="button"
                                                aria-disabled="true"
                                                data-toggle="modal"
                                                data-target="#modal-remover"
                                                data-id-usuario="{{$estudante->id}}"
                                                data-nome-usuario="{{$estudante->nome}}"
                                            >
                                                <i class="fas fa-user-times"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">Nenhum registro encontrado</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <div class="modal fade" id="modal-remover" tabindex="-1" role="dialog" aria-labelledby="modal-remover" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Remover</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="remover-form" class="col-md-12 cadastro" action={{ route('auth.on.estudante.deletar') }} method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <input type="hidden" id="usuario_id" name="usuario_id">
                                </div>
                                <div class="row">
                                    <p>Deseja realmente remover o registro do(a) estudante <span class="estudante-nome"></span>?</p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn operacao-btn">Remover</button>
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
            $('#modal-remover').on('show.bs.modal', function (event) {
                let button = $(event.relatedTarget);
                let modal = $(this);

                let id = button.data('id-usuario');
                let nome = button.data('nome-usuario');

                modal.find('input[name="usuario_id"]').val(id);
                modal.find('.estudante-nome').text(nome);
            });
        });
    </script>
@endpush