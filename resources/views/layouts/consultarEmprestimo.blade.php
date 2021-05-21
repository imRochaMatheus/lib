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

                @if(isset($acesso) && $acesso != 3)
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('auth.on.emprestimo.realizar') }}" class="btn novo-emprestimo" role="button">
                                <i class="fas fa-plus"></i> <strong>Novo Empréstimo</strong>
                            </a>
                        </div>
                    </div>
                @endif
            </form>
        </div>

        <div class="row table-responsive">
            
            
        </div>

        <div class="modal fade" id="modal-devolver" tabindex="-1" role="dialog" aria-labelledby="modal-devolver" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id="devolver-form" action="{{ route('auth.on.emprestimo.devolver') }}" method="POST">
                        <input type="hidden" id="codigo_exemplar" name="codigo_exemplar">
                        <div class="modal-header">
                            <h4 class="modal-title">Devolver Livro</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Deseja devolver o livro <span class="livro"></span>?
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn operacao-btn">DEVOLVER</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-renovar" tabindex="-1" role="dialog" aria-labelledby="modal-renovar" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id="renovar-form" action="{{ route('auth.on.emprestimo.renovar') }}" method="POST">
                        <input type="hidden" id="codigo_exemplar" name="codigo_exemplar">
                        <div class="modal-header">
                            <h4 class="modal-title">Renovar Livro</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Deseja renovar o livro <span class="livro"></span> por mais <strong>7 dias</strong>?
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn operacao-btn">RENOVAR</button>
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

            $('#modal-devolver').on('show.bs.modal', function (event) {
                let button = $(event.relatedTarget);
                let modal = $(this);

                let codigo = button.data('codigo');
                let nome = button.data('nome');

                modal.find('.livro').text(`[${codigo}] ${nome}`);
                modal.find('input[name="codigo-exemplar"]').val(codigo);
            });

            $('#modal-renovar').on('show.bs.modal', function (event) {
                let button = $(event.relatedTarget);
                let modal = $(this);

                let codigo = button.data('codigo');
                let nome = button.data('nome');

                modal.find('.livro').text(`[${codigo}] ${nome}`);
                modal.find('input[name="codigo-exemplar"]').val(codigo);
            });

        });
    </script>
@endpush