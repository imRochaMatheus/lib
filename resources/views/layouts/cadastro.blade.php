@extends('layouts.partials.master')
@section('conteudo')
    <form id="cadastro-usuario-form" class="col-md-6 cadastro" action="{{route('auth.on.cadastro')}}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-5 form-group">
                <label for="acesso">Nível de Acesso:</label>
                <select class="form-control" id="acesso" name="acesso" value="{{ old('acesso') }}" required>
                    <option value="1" selected>Administrador</option>
                    <option value="2">Funcionário</option>
                    <option value="3">Estudante</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-5 form-group">
                <label for="matricula">Matrícula:</label>
                <input type="text" class="form-control" name="matricula" id="matricula" aria-describedby="matricula-error" value="{{ old('matricula') }}" required>
                <small id="matriula-error" class="form-text">{{ $errors->has('matricula') ? $errors->first('matricula') : ''}}</small>
            </div>
            <div class="col-md-7 form-group">
                <label for="cargo">Cargo:</label>
                <select class="form-control" name="cargo" id="cargo" value="{{ old('cargo') }}" required>
                    @for($i = 0; $i < count($cargos); $i++)
                        <option value = {{ $cargos[$i]->id }}>{{ ucwords($cargos[$i]->nome) }}</option>  
                    @endfor 
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 form-group">
                <label for="Nome">Nome:</label>
                <input type="text" class="form-control" name="nome" id="nome" aria-describedby="nome-error" value="{{ old('nome') }}" required>
                <small id="nome-error" class="form-text">{{ $errors->has('nome') ? $errors->first('nome') : ''}}</small>
            </div>                    
        </div>

        <div class="row">
            <div class="col-md-6 form-group">
                <label for="tipo-telefone">Tipo de Telefone:</label>
                <select class="form-control" id="tipo-telefone" name="tipo-telefone" required>
                    <option value="1">Residencial</option>
                    <option value="2" selected>Celular</option>
                </select>
            </div>
            <div class="col-md-6 form-group">
                <label for="telefone">Telefone:</label>
                <input type="text" class="form-control" name="telefone" id="telefone" aria-describedby="telefone-error" value="{{ old('telefone') }}" required>
                <small id="telefone-error" class="form-text">{{ $errors->has('telefone') ? $errors->first('telefone') : ''}}</small>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="email-error" value="{{ old('email') }}" required>
                <small id="email-error" class="form-text">{{ $errors->has('email') ? $errors->first('email') : ''}}</small>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 form-group">
                <label for="senha">Senha:</label>
                <input type="password" class="form-control" name="senha" id="senha" aria-describedby="senha-error" required>
                <small id="email-error" class="form-text">{{ $errors->has('senha') ? $errors->first('senha') : ''}}</small>
            </div>
            <div class="col-md-6 form-group">
                <label for="confirmacao">Confirme sua senha:</label>
                <input type="password" class="form-control" name="confirmacao" id="confirmacao" aria-describedby="confirmacao-error" required>
                <small id="email-error" class="form-text">{{ $errors->has('confirmacao') ? $errors->first('confirmacao') : ''}}</small>
            </div> 
        </div>

        <button type="submit" class="btn btn-block mt-4">CADASTRAR</button>
    </form>

@stop

@push('scripts')
<script type="text/javascript">
    $(function() {
        $('#telefone').mask('(00) 0 0000-0000', {
            clearIfNotMatch: true
        });

        $('#tipo-telefone').change(function() {
            $('#telefone').val('');

            if(this.value === '1') {
                $('#telefone').mask('(00) 0000-0000', {
                    clearIfNotMatch: true
                });
            } else {
                $('#telefone').mask('(00) 0 0000-0000', {
                    clearIfNotMatch: true
                });
            }
        }); 
        
        $('#acesso').change(function() {
            console.log(this.value)
            if(this.value !== '3') {
                $('#cargo').parent().show();
            } else {
                $('#cargo').parent().hide();
            }
        });
    });
</script>
@endpush
