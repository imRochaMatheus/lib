@include('layouts.partials.basico')
@section('conteudo')



<div class="container col-md-8 mt-5">
    <div class="card">
        <div class="card-header">
            <center>
                Cadastro de usuários
            </center>      
        </div>
        <div class="card-body">
            <form action="{{route('cadastro')}}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-8">
                        <label for="Nome">Nome</label>
                        <input type="text" class="form-control" name="nome" placeholder="nome" id="nome"  required value = {{ old('nome') }}>
                        {{ $errors->has('nome') ? $errors->first('nome') : ''}}
                    </div>
                    <div class="col-md-4">
                        <label for="matricula">Matricula:</label>
                        <input type="text" class="form-control" name="matricula" placeholder="Matrícula..." id="matricula" required value = {{ old('matricula') }}>
                        {{ $errors->has('matricula') ? $errors->first('matricula') : ''}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <label for="telefone">Telefone: </label>
                        <input type="text" class="form-control" name="telefone" placeholder="Telefone" id="telefone" required value = {{ old('telefone') }}>
                        {{ $errors->has('telefone') ? $errors->first('telefone') : ''}}
                    </div>
                    <div class="col-md-4">
                        <label for="cargo">Cargo:  </label>
                        <select class="form-control" id="cargo" name="cargo" placeholder="Acesso" value = {{ old('cargo') }}>
                            @for ($i = 0; $i < count($cargos); $i++)
                                <option value = {{$cargos[$i]->id}}>{{$cargos[$i]->nome}}</option>  
                            @endfor 
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <label for="email">Email: </label>
                        <input type="email" class="form-control" name="email" placeholder="Email" id="email" required value = {{ old('email') }}>
                        {{ $errors->has('email') ? $errors->first('email') : ''}}
                    </div>
                    <div class="col-md-4">
                        <label for="senha">Senha:</label>
                        <input type="password" class="form-control" name="senha" placeholder="Senha" id="senha" required>
                        {{ $errors->has('senha') ? $errors->first('senha') : ''}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <label for="confirmacao">Confirme sua senha:</label>
                        <input type="password" class="form-control" name="confirmacao" placeholder="Repita sua senha" id="confirmacao_senha">
                        {{ $errors->has('confirmacao') ? $errors->first('confirmacao') : ''}}
                    </div>
                    <div class="col-md-4">
                        <label for="acesso">Acesso: </label>
                        <select class="form-control" id="acesso" name="acesso" placeholder="Acesso" value = {{ old('acesso') }}>
                            <option value="1">Administrador</option>
                            <option value="2">Funcionário</option>
                            <option value="3">Estudante</option>
                        </select>
                    </div>       
                </div>
                <button type="submit" class="btn btn-primary mt-4">Cadastrar</button>
            </form>
        </div>
    </div>
</div>





