@extends('layouts.app')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">{{ __('Mensaje') }}</h1>
    <p class="mb-4">Formulario de mensaje</p>

    <div class="card shadow mb-4 border-left-success">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-info">Enviar mensaje al usuario Root</h5>
        </div>
        <div class="card-body">
            <form class="needs-validation" method="POST" action="{{ route('mensaje.store') }}"  role="form" enctype="multipart/form-data">
                @csrf
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
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="" />
                        <div class="invalid-feedback">
                            Valid name is required.
                        </div>
                        <br>
                        <label for="email">Correo</label>
                        <input type="email" class="form-control" id="correo" name="correo" placeholder="" />
                        <div class="invalid-feedback">
                            Valid email is required.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="name">Mensaje</label>
                        <textarea name="mensaje" id="mensaje" class="form-control"></textarea>
                        <div class="invalid-feedback">
                            Valid message is required.
                        </div>
                    </div>
                </div>

                <hr class="mb-4">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <input type="hidden" class="form-control" id="paginacion" name="paginacion" value="admin">
                        <button class="btn btn-success btn-lg btn-block" type="submit">Enviar mensaje</button>
                    </div>
                    <div class="col-md-6 mb-3">
                        <a href="{{ route('mensaje.index') }}" class="btn btn-danger btn-lg btn-block">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

@endsection