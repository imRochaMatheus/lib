@extends('layouts.partials.master')
@section('conteudo')
    <div class="login-form-wrapper col-md-8">
        <div class="form-main">
            <div class="login-form-img"></div>
            <div class="login-form">
                <form id="login-form" action="{{route('login')}}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="email" aria-hidden="true" hidden>Email</label>
                        <input type="email" id="email" name="email" placeholder="Email" required />
                        <i class="fas fa-envelope"></i>
                        {{ $errors->has('email') ? $errors->first('email') : ''}}
                    </div>
                    <div class="form-group">
                        <label for="password" aria-hidden="true" hidden>Senha</label>
                        <input type="password" id="password" name="password" placeholder="Senha" required />
                        <i class="fas fa-lock"></i>
                        <i class="fas fa-eye show-pwd"></i>
                        {{ $errors->has('password') ? $errors->first('password') : ''}}
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="connected" name="connected">
                        <label class="custom-control-label" for="connected">Manter-me conectado</label>
                    </div>
                    <button type="submit" class="form-btn">ENTRAR</button>
                    <div class="forgot-pwd">
                        <a href="{{ route('recuperarSenha') }}">Esqueci minha senha</a>
                    </div>
                </form>
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