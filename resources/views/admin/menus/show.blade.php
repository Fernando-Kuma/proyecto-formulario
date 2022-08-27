@extends('layouts.app')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">{{ __('Menus') }}</h1>
    <p class="mb-4">Tabla de menus</p>

    <!-- DataTales Example  -->
    <div class="card shadow mb-3">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between mb-1">
                <h1 class="h5 mb-0 font-weight-bold text-primary">Menus</h1>
                <a href="{{ route('menus.create') }}" class="btn btn-info btn-icon-split">
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
                            <th>Icono</th>
                            <th>Nombre</th>
                            <th>Estatus</th>
                            <th>Creado por</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($menus as $menu)
                        <tr>
                            <td>{{ $menu->id }}</td>
                            <td>{{ $menu->icono }}</td>
                            <td>{{ $menu->nombre }}</td>
                            <td>{{ $menu->estatus }}</td>
                            <td>{{ $menu->users->name }}</td>
                            <td>
                                <form action="{{ route('menus.destroy',$menu->id) }}" method="POST">
                                    <a href="{{ route('menus.edit',$menu->id) }}" class="btn btn-warning btn-icon-split">
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
</div>
<!-- /.container-fluid -->

@endsection