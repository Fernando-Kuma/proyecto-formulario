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
        <label for="name">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="" value="{{ isset($respuesta->nombre)?$respuesta->nombre:old('nombre') }}">
        <div class="invalid-feedback">
            Valid name is required.
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label for="name">Tipo</label>
        <input type="text" class="form-control" id="tipo" name="tipo" placeholder="" value="{{ isset($respuesta->tipo)?$respuesta->tipo:old('tipo') }}">
        <div class="invalid-feedback">
            Valid name is required.
        </div>
    </div>
</div>

<hr class="mb-4">
<div class="row">
    <div class="col-md-6 mb-3">
        <input type="hidden" class="form-control" id="created_by" name="created_by" value="{{ Auth::user()->id }}">
        <button class="btn btn-success btn-lg btn-block" type="submit">{{ $modo }}</button>
    </div>
    <div class="col-md-6 mb-3">
        <a href="{{ route('respuestas.index') }}" class="btn btn-danger btn-lg btn-block">Cancelar</a>
    </div>
</div>