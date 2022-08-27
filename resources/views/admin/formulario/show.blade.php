@extends('layouts.app')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">{{ __('Formulario') }}</h1>
    <p class="mb-4">Tabla de formulario</p>


    <!-- DataTales Example  -->
    <div class="card shadow mb-3">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between mb-1">
                <h1 class="h5 mb-0 font-weight-bold text-primary">Formularios</h1>
                <a href="{{ route('formulario.create') }}" class="btn btn-info btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Nuevo formulario</span>
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
                            <th>Empresa</th>
                            <th>Evento</th>
                            <th>Preguntas</th>
                            <th>Creado por</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($eventos as $evento)
                        <tr>
                            <td>{{ $evento->id }}</td>
                            <td>{{ $evento->empresa }}</td>
                            <td>{{ $evento->nombre }}</td>
                            <td>{{ $evento->formularios->count() }}</td>
                            <td>{{ $evento->users->name }}</td>
                            <td>
                                <form action="{{ route('formulario.destroy',$evento->id) }}" method="POST">
                                    <a href="{{ route('formulario.edit',$evento->id) }}" class="btn btn-warning btn-icon-split">
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <div class="card border-left-info shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <div class="d-sm-flex align-items-center justify-content-between mb-1">
                <h1 class="h5 mb-0 font-weight-bold text-primary">Links</h1>
            </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="table-responsive table-borderless">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Formulario</th>
                            <th scope="col">Direccion del formulario</th>
                        </tr>
                    </thead>
                    <tbody class="table-info">
                    @foreach($eventos as $evento)
                        @if($evento->contenidos->count())
                        <tr>
                            <th scope="row">{{ $evento->empresa }} - {{ $evento->nombre }}</th>
                            <td>
                                <a href="{{ url('form').'/'.$evento->id.'/'.strtolower($evento->empresa).'/'.strtolower($evento->nombre) }}" class="btn btn-info btn-icon-split">
                                {{ url('form').'/'.$evento->id.'/'.strtolower($evento->empresa).'/'.strtolower($evento->nombre) }} <br>    
                                </a>
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td colspan="2">
                                <a href="{{ route('contenido.create') }}" class="btn btn-danger">
                                El link del evento: {{$evento->nombre}} se creara al crear un contenido, ingresa aqui para crearlo
                                </a>
                            </td>
                        </tr>
                        @endif
                    
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
<!-- /.container-fluid -->

@endsection