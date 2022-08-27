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
    <header class="masthead" style="padding-top: 5rem; padding-bottom: calc(10rem - 4.5rem); 
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0.4) 0%, rgba(0, 0, 0, 0.6) 100%), url({{asset('storage').'/'.$contenido->img_fondo}}); background-position: center; background-repeat: no-repeat; background-attachment: scroll; background-size: cover;">
        <div class="container px-4 px-lg-5 h-100">
            <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-10 align-self-end">
                {!! $contenido->texto_final !!}
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



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>
@endforeach

</html>
