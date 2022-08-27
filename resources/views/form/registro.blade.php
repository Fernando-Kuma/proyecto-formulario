<!DOCTYPE html>
<html lang="en">
@foreach($evento->contenidos as $contenido)
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>{{ $evento->nombre }}</title>
    <link rel="icon" type="image/jpg" href="{{ asset('storage').'/'.$contenido->img_logo }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <style type="text/css" >

            
        

    </style>

</head>

<body id="page-top">
    <!-- Header-->

    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-0" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#">{{ $evento->empresa }} - {{ $evento->nombre }}</a>
            <img class="logo" src="{{ asset('storage').'/'.$contenido->img_logo }}" alt="logo" style="height: 80px; display: block;">
        </div>
    </nav>

    <!-- Content -->
    <header class="masthead" style="padding-top: 5rem; padding-bottom: calc(10rem - 4.5rem); background: linear-gradient(to bottom, rgba(0, 0, 0, 0.4) 0%, rgba(0, 0, 0, 0.6) 100%), url({{asset('storage').'/'.$contenido->img_fondo}}); background-position: center; background-repeat: no-repeat; background-attachment: scroll; background-size: cover;">
        <div class="container px-4 px-lg-5 h-100">
            <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-10 align-self-end">
                    {!! $contenido->texto_inicial !!}
                </div>
                <div class="col-lg-10 align-self-baseline">
                    <button type="button" class="btn btn-primary btn-lg rounded-pill buttonCreate" data-bs-toggle="modal" data-bs-target="#modalUsuario" id="buttonCreate">Registrate</button>
                </div>
            </div>
        </div>
    </header>
    <!-- Footer-->
    <footer class="bg-light py-3">
        <div class="container px-4 px-lg-5">
            <div class="small text-center text-muted">Copyright &copy; 2022 - {{ $evento->empresa }} </div>
        </div>
    </footer>


    <!-- Modal -->
    <div class="modal fade" id="modalUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content text-black modal-lg mb-3" style="background: {{ $contenido->color_fondo }}; -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title" style="color: {{$contenido->color_texto}} ;">Contesta este registro</h5>
                    <button type="button" class="btn nav-link mb-1 px-0 py-0" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times-circle fa-2x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="mb-3 row" method="POST" 
                    action="{{url('form').'/'.$evento->id.'/'.strtolower($evento->empresa).'/'.strtolower($evento->nombre) }}"
                    role="form" enctype="multipart/form-data" id="formUser">
                        @csrf
                        @foreach($evento->formularios as $formulario )
                        <div class="form-group col-md-6">
                            <label class="col-form-label" style="color: {{$contenido->color_texto}} ;">{{ $formulario->pregunta }}</label>
                            <input type="hidden" name="pregunta[]" id="pregunta[]" class="form-control" value="{{ $formulario->pregunta }}">
                            <input type="{{ $formulario->respuestas->tipo }}" name="registro[]" id="registro[]" class="form-control" placeholder="{{ $formulario->pregunta }}" required>
                        </div>
                        @endforeach
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <input type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-success" value="Regístrate">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>
@endforeach

</html>