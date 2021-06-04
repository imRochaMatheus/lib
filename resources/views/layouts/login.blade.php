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
                        @if(isset($cookies->email) && $cookies->email != '')
                            <input type="email" id="email" name="email" placeholder="Email" value={{$cookies->email}} required />
                        @else
                            <input type="email" id="email" name="email" placeholder="Email" required />
                        @endif
                        <i class="fas fa-envelope"></i>
                        {{ $errors->has('email') ? $errors->first('email') : ''}}
                    </div>
                    <div class="form-group">
                        <label for="password" aria-hidden="true" hidden>Senha</label>
                        @if(isset($cookies->email) && $cookies->email != '')
                            <input type="password" id="password" name="password" placeholder="Senha" value={{$cookies->senha}} required />
                        @else
                            <input type="password" id="password" name="password" placeholder="Senha" required />
                        @endif
                        <i class="fas fa-lock"></i>
                        <i class="fas fa-eye show-pwd"></i>
                        {{ $errors->has('password') ? $errors->first('password') : ''}}
                    </div>
                    <div class="custom-control custom-checkbox">
                        @if(isset($cookies->checked) && $cookies->checked == 'checked'){
                            <input type="checkbox" class="custom-control-input" id="connected" name="connected" checked>
                        @else
                            <input type="checkbox" class="custom-control-input" id="connected" name="connected" >
                        @endif
                        <label class="custom-control-label" for="connected">Lembrar-se</label>
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