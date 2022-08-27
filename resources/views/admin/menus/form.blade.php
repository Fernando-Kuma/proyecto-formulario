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
    <div class="col-md-3 mb-3">
        <input type="hidden" class="form-control" id="created_by" name="created_by" value="{{ Auth::user()->id }}">
        <label for="icono">Icono</label>
        <select class="custom-select d-block w-100" name="icono" id="icono">
        <option value="{{ isset($menu->icono)?$menu->icono:old('icono') }}">{{ isset($menu->icono)?$menu->icono:"Selecione uno" }}</option>
            @include('admin.list')
        </select>
        <div class="invalid-feedback">
            Please select a valid.
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" id="nombre" placeholder="" name="nombre" value="{{ isset($menu->nombre)?$menu->nombre:old('nombre') }}">
        <div class="invalid-feedback">
            Valid name is required.
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <label for="nombre">Estatus</label>
        <div class="custom-control custom-switch">
            <label class="switch">
                <input type="checkbox" name="estatus" value="true" checked="{{isset($menu->estatus)?$menu->estatus:old('estatus')}}" >           
                <span class="slider"></span>
                <p class="off">No</p>
                <p class="on">Si</p>
            </label>
        </div>
    </div>
</div>

<hr class="mb-4">
<div class="row">

    <div class="col-md-6 mb-3">
        <button class="btn btn-success btn-lg btn-block" type="submit">{{ $modo }}</button>
    </div>
    <div class="col-md-6 mb-3">
        <a href="{{ route('menus.index') }}" class="btn btn-danger btn-lg btn-block">Cancelar</a>

    </div>
</div>