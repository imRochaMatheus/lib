@extends('layouts.partials.master')
@section('conteudo')
    <div class="recuperar-senha-form-wrapper col-md-8">
        <div class="form-main">
            <div class="recuperar-senha-form-img"></div>
            <div class="recuperar-senha-form">
                <form id="recuperar-senha-form" action="{{route('login')}}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="matricula" aria-hidden="true" hidden>Matrícula:</label>
                        <input type="text" id="matricula" name="matricula" placeholder="Informa a sua matrícula..." required />
                        <i class="fas fa-user"></i>
                        {{ $errors->has('matricula') ? $errors->first('matricula') : ''}}
                    </div>
                
                    <button type="submit" class="form-btn">RECUPERAR SENHA</button>
                    <div class="login-link">
                        <a href="{{ route('login') }}">Ir para Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush

@push('scripts')
    <script type="text/javascript">
        $(function() {
            $('#password').keypress(function() {
                $('.show-pwd').show();
            });

            $('.show-pwd').click(function() {
                if($(this).hasClass('fa-eye')){
                    $('#password').prop('type', 'text');
                    $(this).removeClass('fa-eye');
                    $(this).addClass('fa-eye-slash');
                } else {
                    $('#password').prop('type', 'password');
                    $(this).removeClass('fa-eye-slash');
                    $(this).addClass('fa-eye');
                }                
            });
        });
    </script>
@endpush