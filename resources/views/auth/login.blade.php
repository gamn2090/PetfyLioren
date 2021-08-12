@extends('layouts.app')

@section('content')
<div style="margin-top:60px" class="container">
    @if (session('Exito'))
        <div class="alert alert-success" style="width: 100%; text-align:center">
            {{ session('Exito') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="login-box">
            <div class="login-logo">
                <img src="https://cdn.shopify.com/s/files/1/2656/3744/files/petfy-mobile_320x320_a20c9f71-cd8a-46d0-8773-dc6e06ec2ed9_156x.png?v=1593824086"
                alt="Petfy logo"
                class="brand-image"
                style="opacity: .8; width: 150px; heigth: 150px;">
            </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
        <p class="login-box-msg">inicia sesion para ingresar al sistema</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input-group mb-3">
                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Correo">                
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                    </div>
                </div>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                    </div>
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="row">
            
            <!-- /.col -->
            <div class="col-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Login') }}
                </button>
            </div>
            <!-- /.col -->
            </div>
        </form>        

        <p class="mb-1">
            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('¿Olvidó su contraseña?') }}
                </a>
            @endif
            <a class="btn btn-link" href="{{ route('register') }}">
                {{ __('¿Eres nuevo?, ¡regístrate!') }}
            </a>
        </p>        
        </div>
        <!-- /.login-card-body -->
    </div>
    </div>
    <!-- /.login-box -->
    </div>
</div>        

    
@endsection

