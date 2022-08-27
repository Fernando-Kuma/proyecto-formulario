@extends('layouts.app')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">{{ __('Perfil') }}</h1>
    <p class="mb-4">Formulario del usuario activo</p>

    <div class="card shadow mb-4 border-left-success">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-info">Formulario</h5>
        </div>
        <div class="card-body">
            <form class="needs-validation" method="POST" action="{{ route('usuarios.update', $usuario->id) }}" role="form" enctype="multipart/form-data">
                @csrf
                {{ method_field('PATCH') }}
                @method('PUT')
                @if(count($errors)>0)
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <input type="hidden" class="form-control" id="created_by" name="created_by" value="{{ Auth::user()->id }}">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" placeholder="" name="name" value="{{ isset($usuario->name)?$usuario->name:old('name') }}">
                        <div class="invalid-feedback">
                            Valid first name is required.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="surnames">Apellidos</label>
                        <input type="text" class="form-control" id="surnames" placeholder="" name="surnames" value="{{ isset($usuario->surnames)?$usuario->surnames:old('surnames') }}">
                        <div class="invalid-feedback">
                            Valid last name is required.
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="email">Correo</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" value="{{ isset($usuario->email)?$usuario->email:old('email') }}">
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>
                    @if($usuario->rol_id == 1 || $usuario->rol_id == 2)
                    <div class="col-md-6 mb-3">
                        <label for="empresa">Empresa</label>
                        <input type="text" class="form-control" id="empresa" placeholder="" name="empresa" value="{{ isset($usuario->empresa)?$usuario->empresa:old('empresa') }}">
                        <div class="invalid-feedback">
                            Valid empresa is required.
                        </div>
                    </div>
                    @endif
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="password" placeholder="" name="password" value="">
                        <div class="invalid-feedback">
                            Valid password is required.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="phone">Telefono</label>
                        <input type="text" class="form-control" id="phone" placeholder="" name="phone" value="{{ isset($usuario->phone)?$usuario->phone:old('phone') }}">
                        <div class="invalid-feedback">
                            Valid phone is required.
                        </div>
                    </div>
                </div>
                <hr class="mb-4">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <button class="btn btn-success btn-lg btn-block" type="submit">Editar</button>
                    </div>
                    <div class="col-md-6 mb-3">
                        <a href="{{ url('/admin') }}" class="btn btn-danger btn-lg btn-block">Cancelar</a>

                    </div>
                </div>
            </form>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

@endsection