@include('layouts.partials.basico')
@section('conteudo')



<div class="container col-md-8 mt-5">
    <div class="card">
        <div class="card-header">
            <center>
                Formulário de empréstimos
            </center>      
        </div>
        <div class="card-body">
            <form action="{{route('emprestimo')}}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-4">
                        <label for="matricula">Matrícula: </label>
                        <input type="text" class="form-control" name="matricula" placeholder="Matrícula" id="matricula" autocomplete="off" required value = {{ old('matricula') }}>
                        {{ $errors->has('matricula') ? $errors->first('matricula') : ''}}
                    </div>
                    <div class="col-md-4">
                        <label for="codigo">Código do Livro:</label>
                        <input type="text" class="form-control" name="codigo"  autocomplete="off" placeholder="Código" id="codigo" required value = {{ old('codigo') }}>
                        {{ $errors->has('codigo') ? $errors->first('codigo') : ''}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="data_emprestimo">Data do empréstimo: </label>
                        <input type="date" class="form-control" name="data_empprestimo" placeholder="Autor" id="data_emprestimo" required>
                    </div>
                </div>
               
                <button type="submit" class="btn btn-primary mt-4">Cadastrar</button>
            </form>
        </div>
    </div>
</div>





