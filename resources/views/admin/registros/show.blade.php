@extends('layouts.app')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">{{ __('Registros') }}</h1>
    <p class="mb-4">Tablas de Registros</p>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <!-- DataTales Example  -->
    @foreach($eventos as $evento)
    <div class="card shadow mb-3">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between mb-1">
                <h1 class="h5 mb-0 font-weight-bold text-primary">Registros del evento {{$evento->nombre}}</h1>
            </div>
            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            @foreach($evento->formularios as $formulario)
                                <th>{{$formulario->pregunta}}</th>
                            @endforeach
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($evento->solicituds as $solicitud)
                        <tr>     
                            <td>{{ $solicitud->id }}</td>
                            @foreach($solicitud->registros as $registro)
                            <td>{{ $registro->respuesta }}</td>
                            @endforeach
                            <td>
                                <form action="{{ route('registros.destroy',$solicitud->id) }}" method="POST">
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
    @endforeach
</div>
<!-- /.container-fluid -->

@endsection