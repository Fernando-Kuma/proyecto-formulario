@extends('layouts.app')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">{{ __('Mensajes') }}</h1>
    <p class="mb-4">Tabla de mensajes</p>

    <!-- DataTales Example  -->
    <div class="card shadow mb-3">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between mb-1">
                <h1 class="h5 mb-0 font-weight-bold text-primary">Mensajes</h1>
            </div>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Mensajes</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mensajes as $mensaje)
                        <tr>
                            <td>{{ $mensaje->id }}</td>
                            <td>{{ $mensaje->nombre }}</td>
                            <td>{{ $mensaje->correo }}</td>
                            <td>{{ $mensaje->mensaje }}</td>
                            <td>
                                <form action="{{ route('respuestas.destroy',$mensaje->id) }}" method="POST">
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

@endsection