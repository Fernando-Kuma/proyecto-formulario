@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-2">¿Olvidaste tu contraseña?</h1>   
                                    <p class="mb-4">Lo entendemos, pasan cosas. Sólo tienes que introducir tu dirección de correo electrónico a continuación
                                         ¡y le enviaremos un enlace para restablecer su contraseña!</p>
                                </div>
                                @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                    <div class="form-group">
                                        <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Introducir tu correo electrónico...">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        {{ __('Restablecer la contraseña') }}
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    @if (Route::has('login'))
                                    <a class="btn btn-link small" href="{{ route('login') }}">
                                        {{ __('¿Ya tienes una cuenta? ¡Iniciar sesión!') }}
                                    </a>
                                    @endif
                                </div>
                                <div class="text-center">
                                    @if (Route::has('register'))
                                    <a class="btn btn-link small" href="{{ route('register') }}">
                                        {{ __('¡Crea una cuenta!') }}
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection