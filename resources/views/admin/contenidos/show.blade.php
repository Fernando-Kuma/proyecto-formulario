@extends('layouts.app')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">{{ __('Contenido') }}</h1>
    <p class="mb-4">Tabla de contenido</p>

    <!-- DataTales Example  -->
    <div class="card shadow mb-3">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between mb-1">
                <h1 class="h5 mb-0 font-weight-bold text-primary">Contenidos</h1>
                <a href="{{ route('contenido.create') }}" class="btn btn-info btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Agregar </span>
                </a>
            </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Datos de evento</th>
                            <th>Fotos</th>
                            <th>Texto principal</th>
                            <th>Texto concluido</th>
                            <th>Texto correo</th>
                            <th>Color Formulario</th>
                            <th>Creado por</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($eventos as $evento)
                        @foreach($evento->contenidos as $contenido)
                        <tr>
                            <td>{{ $contenido->id }}</td>
                            <td>
                                {{ $contenido->eventos->empresa }} 
                                <br> 
                                {{ $contenido->eventos->nombre }} 
                                <br> 
                                {{ $contenido->correo }}</td>
                            <td>
                                Fondo <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$contenido->img_fondo }}" width="200" alt="">
                                <br>
                                Logo <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$contenido->img_logo }}" width="200" alt="">
                            </td>
                            <td>{{ $contenido->texto_inicial }}</td>
                            <td>{{ $contenido->texto_final }}</td>
                            <td>{{ $contenido->texto_correo }}</td>
                            <td>
                                Fondo <input type="color" disabled value="{{ $contenido->color_fondo }}">
                                <br>
                                Texto <input type="color" disabled value="{{ $contenido->color_texto }}">
                            </td>
                            <td>{{ $contenido->users->name }}</td>
                            <td>
                                <form action="{{ route('contenido.destroy',$contenido->id) }}" method="POST">
                                    <a href="{{ route('contenido.edit',$contenido->id) }}" class="btn btn-warning btn-icon-split">
                                        <span class="icon text-white-70">
                                            <i class="fas fa-edit"></i>
                                        </span>
                                    </a>
                                    @csrf
                                    <!--@method('DELETE')-->
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger btn-icon-split" onClick="return confirm('¿Quieres borrar?')">
                                        <span class="icon text-white-70">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

@endsection