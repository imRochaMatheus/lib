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
                        <td class="status"><i class="fas fa-circle text-success"></i></td>
                        <td class="action">
                            <ul>
                                <li>
                                    <i class="fas fa-reply"></i>
                                </li>
                                <li>
                                    <i class="fas fa-exchange-alt"></i>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>123456</td>
                        <td>O Nome do Vento</td>
                        <td>Patrick Rothfuss</td>
                        <td>12/05/2021</td>
                        <td>19/05/2021</td>
                        <td class="status"><i class="fas fa-circle text-success"></i></td>
                        <td class="action">
                            <ul>
                                <li>
                                    <i class="fas fa-reply"></i>
                                </li>
                                <li>
                                    <i class="fas fa-exchange-alt"></i>
                                </li>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/consultar-emprestimo.css') }}">
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