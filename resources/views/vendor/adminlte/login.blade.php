@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    @yield('css')
@stop

@section('classes_body', 'login-page')

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )
@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset') )
@php( $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ?? route($login_url) )
    @php( $register_url = $register_url ?? route($register_url) )
    @php( $password_reset_url = $password_reset_url ?? route($password_reset_url) )
    @php( $dashboard_url = $dashboard_url ?? route($dashboard_url) )
@else
    @php( $login_url = $login_url ?? url($login_url) )
    @php( $register_url = $register_url ?? url($register_url) )
    @php( $password_reset_url = $password_reset_url ?? url($password_reset_url) )
    @php( $dashboard_url = $dashboard_url ?? url($dashboard_url) )
@endif

@section('body')
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ $dashboard_url }}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a>
        </div>
        @if(isset($message))
            <div class="callout callout-success">
                <h5>C'est bon !</h5>
                <p>{{ $message }}</p>
            </div>
        @endif
        @if(isset($error_message))
            <div class="callout callout-danger">
                <h5>Oops !</h5>
                <p>{{ $error_message }}</p>
            </div>
        @endif
        <div class="card" style="border-radius: 5px">
            <div class="card-body login-card-body" style="border-radius: 10px;box-shadow: 0px 6px 18px -9px rgba(0,0,0,0.75);">
                <p class="login-box-msg">{{ __('Se connecter à Reflex\'Yon') }}</p>
                <form action="{{ $login_url }}" method="post">
                    {{ csrf_field() }}
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ __('Adresse email') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="{{ __('Mot de passe') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @if ($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-sm-7">
                            <a href="{{ $register_url }}" class="btn btn-default btn-block btn-flat">
                                Inscription
                            </a>
                        </div>
                        <div class="col-sm-5">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">
                                Connexion
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@stop
@section('js')
    <script src="three.js"></script>
    <script src="vanta.js"></script>
    <script>
        VANTA.NET({
            el: "#bodyAnimate",
            color: 0x0,
            backgroundColor: 0xe9ecef,
            maxDistance: 25.00,
            spacing: 20.00
        })
        $('canvas').css('opacity', '0.1')
    </script>
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')
@stop
