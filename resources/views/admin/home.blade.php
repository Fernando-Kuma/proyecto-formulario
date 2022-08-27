@extends('layouts.app')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h2 mb-0 text-gray-800">{{Auth::user()->empresa}}</h1>
    <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
  </div>

  <!-- Content Row -->
  <div class="row">
    <!-- Columna a -->
    <div class="col-lg-6 mb-4">
      <!-- Perfil -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <div class="d-sm-flex align-items-center justify-content-between mb-0">
            <h6 class="m-0 font-weight-bold text-primary">Perfil</h6>
            <a href="{{ route('usuarios.show',Auth::user()->id) }}" class="btn btn-warning btn-icon-split">
              <span class="icon text-white-70">
                <i class="fas fa-edit"></i> Editar
              </span>
            </a>
          </div>
        </div>
        <div class="card-body">
          <div class="row justify-content-md-center">
            <div class="col col-lg-4">
              <img class="img-fluid px-1 px-sm-1 mb-2" style="width: 15rem;" src="img/undraw_profile.svg" alt="...">
            </div>
            <div class="col col-lg-8">
              <h1 class="h4 mb-0 text-gray-800 text-center">
                <p>
                  {{ Auth::user()->name }} {{ Auth::user()->surnames }}
                </p>
                <p>
                  Rol: {{ Auth::user()->rols->nombre }}
                </p>
              </h1>
            </div>
          </div>

          <h1 class="h6 my-2 text-gray-700">
            <p>Correo: {{ Auth::user()->email }}</p>
            <p>Empresa: {{ Auth::user()->empresa }}</p>
            <p>Telefono: {{ Auth::user()->phone }}</p>
          </h1>
        </div>
      </div>
    </div>

    <!-- Columna b -->
    <div class="col-lg-6 mb-4">

      <!-- Instrucciones -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Descripción</h6>
        </div>
        <div class="card-body">
          <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="img/undraw_posting_photo.svg" alt="...">
          </div>

          <p>
            Bienvenido {{ Auth::user()->name }}, en las seccion de preguntas podras crear una nueva pregunta para tu formulario o usar una ya existentes.
            En el formulario debes colocar la preguna y el tipo de respuesta que deseas obtener.
            Al crear tu cuestionario el se generara una direccion para poder registrarse, esto se obtendra por el nombre de tu empresa ingresada.
          </p>
        </div>
      </div>

    </div>
  </div>

</div>
<!-- /.container-fluid -->

@endsection