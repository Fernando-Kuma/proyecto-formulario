@if(count($errors)>0)
<div class="alert alert-danger" role="alert">
    <ul>
        @foreach($errors->all() as $error)
        <li>
            {{ $error }}
        </li>
        @endforeach
    </ul>
</div>
@endif

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="name">Empresa</label>
        <input type="text" class="form-control" id="empresa" name="empresa" placeholder="" value="{{ Auth::user()->empresa }}" disabled>
        <div class="invalid-feedback">
            Valid name is required.
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label for="name">Evento</label>
        <select class="custom-select d-block w-100" name="evento" id="evento">
            <option value="{{ isset($contenido->eventos->id)?$contenido->eventos->id:old('evento') }}">{{ isset($contenido->eventos->nombre)?$contenido->eventos->nombre:"Selecione uno" }}</option>
            @foreach ($eventos as $evento)
            <option value="{{ $evento->id }}">{{ $evento->nombre }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="d-flex bd-highlight justify-content-start">
    <div class="p-2 bd-highlight">
        <label for="texto_final_id">¿Deseas que el participante del formulario reciba un correo personalizado?</label><br>
    </div>
    <div class="p-2 bd-highlight">
        <div class="form-check form-check-inline">
            <input class="form-check-input form-control" type="radio" name="mostrar_correo" style="height: auto;" id="mostrar_correo" onclick="mostrarEmail()" {{ isset($estatus)? "checked" :  "" }} value=true >
            <label class="form-check-label">Si</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input form-control" type="radio" name="mostrar_correo" style="height: auto;" id="mostrar_correo" onclick="ocultarEmail()" {{ isset($estatus)? "" :  "checked" }} value=false >
            <label class="form-check-label">No</label>
        </div>
    </div>   
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="img_fondo">Foto de fondo</label>
        @if(isset($contenido->img_fondo))
        <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$contenido->img_fondo }}" width="50" height="30" alt="">
        @endif
        <input type="file" class="form-control" name="img_fondo" id="img_fondo" value="">
    </div>
    <div class="col-md-6 mb-3">
        <label for="img_logo">Logo</label>
        @if(isset($contenido->img_logo))
        <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$contenido->img_logo }}" width="50" height="30" alt="">
        @endif
        <input type="file" class="form-control" name="img_logo" id="img_logo" value="">
    </div>
</div>
<div class="mb-3">
    <label for="texto_inicial_id">Texto principal</label>
    <small id="texto_inicial_id" class="form-text text-muted">
        Recuerda usar los estilos para darle jerarquia y diseño a tu texto.
    </small>
    <textarea name="texto_inicial" id="texto_inicial" type="text" class="form-control">{{ isset($contenido->texto_inicial)?$contenido->texto_inicial:old('texto_inicial') }}</textarea>
</div>
<div class="mb-3">
    <label for="texto_final_id">Texto al concluir</label>
    <small id="texto_final_id" class="form-text text-muted">
        Recuerda usar los estilos para darle jerarquia y diseño a tu texto.
    </small>
    <textarea name="texto_final" id="texto_final" type="text" class="form-control">{{ isset($contenido->texto_final)?$contenido->texto_final:old('texto_final') }}</textarea>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label for="color_fondo">Color del formulario (fondo) </label>
        <input type="color" class="form-control form-control-color" name="color_fondo" id="color_fondo" value="{{ isset($contenido->color_fondo)?$contenido->color_fondo:old('#FFFFFF') }}" title="Choose your color">
    </div>
    <div class="col-md-6 mb-3">
        <label for="color_texto">Color del formulario (texto)</label>
        <input type="color" class="form-control form-control-color" name="color_texto" id="color_texto" value="{{ isset($contenido->color_texto)?$contenido->color_texto:old('#FFFFFF') }}" title="Choose your color">
    </div>
</div>
<div class="mb-3" id="emailSend">
    <label for="texto_correo_id">Texto correo</label>
    <small id="texto_correo_id" class="form-text text-muted">
        Recuerda usar los estilos para darle jerarquia y diseño a tu texto.
    </small>
    <textarea name="texto_correo" id="texto_correo" type="text" class="form-control" style="rgb(255 255 255 / 65%)">{{ isset($contenido->texto_correo)?$contenido->texto_correo:old('texto_correo') }}</textarea>
</div>

<hr class="mb-4">
<div class="row">
    <div class="col-md-6 mb-3">
        <input type="hidden" class="form-control" id="created_by" name="created_by" value="{{ Auth::user()->id }}">
        <button class="btn btn-success btn-lg btn-block" type="submit">{{ $modo }}</button>
    </div>
    <div class="col-md-6 mb-3">
        <a href="{{ route('contenido.index') }}" class="btn btn-danger btn-lg btn-block">Cancelar</a>
    </div>
</div>


@if(isset($estatus))
<style type="text/css">
    #emailSend{
        display: block;
    };
</style>
@else
<style type="text/css">
    #emailSend{
        display: none;
    };
</style>
@endif



<script>
    function mostrarEmail(){
        document.getElementById('emailSend').style.display='block';
    }

    function ocultarEmail(){
        document.getElementById('emailSend').style.display='none';
    };
</script>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace('texto_inicial');
    CKEDITOR.replace('texto_final');
    CKEDITOR.replace('texto_correo');
</script>