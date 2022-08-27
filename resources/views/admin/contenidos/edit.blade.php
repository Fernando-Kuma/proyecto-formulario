@extends('layouts.app')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">{{ __('Contenido') }}</h1>
    <p class="mb-4">Formulario de contenido</p>

    <div class="card shadow mb-4 border-left-success">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-info">Formulario</h5>
        </div>
        <div class="card-body">
            <form class="needs-validation" method="POST" action="{{ route('contenido.update', $contenido->id) }}"  role="form" enctype="multipart/form-data">
                @csrf
                {{ method_field('PATCH') }}
                @method('PUT')
                @include('admin.contenidos.form',['modo'=>'Editar'])
            </form>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

@endsection