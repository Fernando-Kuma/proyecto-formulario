@extends('layouts.app')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">{{ __('Roles') }}</h1>
    <p class="mb-4">Formulario de roles</p>

    <div class="card shadow mb-4 border-left-success">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-info">Formulario</h5>
        </div>
        <div class="card-body">
            <form class="needs-validation" method="POST" action="{{ route('roles.store') }}"  role="form" enctype="multipart/form-data">
                @csrf
                @include('admin.roles.form',['modo'=>'Crear'])
            </form>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

@endsection