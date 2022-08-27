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
<div class="col-md-4 mb-3">
        <label for="rol">Rol</label>
        <select class="custom-select d-block w-100" name="rol" id="rol">
        <option value="{{ isset($acceso->rol)?$acceso->rol:old('rol') }}">{{ isset($acceso->rol)?$acceso->rols->nombre:"Selecione uno" }}</option>
            @foreach($rols as $key => $rol)
            <option value="{{ $key }}">{{ $rol }}</option>
            @endforeach
        </select>
        <div class="invalid-feedback">
            Please select a valid country.
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="rol">Menu</label>
        <select class="custom-select d-block w-100" name="menu" id="menu">
        <option value="{{ isset($acceso->menu)?$acceso->menu:old('menu') }}">{{ isset($acceso->menu)?$acceso->menus->nombre:"Selecione uno" }}</option>
            @foreach($menus as $key => $menu)
            <option value="{{ $key }}">{{ $menu }}</option>
            @endforeach
        </select>
        <div class="invalid-feedback">
            Please select a valid country.
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <label for="nombre">Estatus</label>
        <div class="custom-control custom-switch">
            <label class="switch">
                <input type="checkbox" name="estatus" value="true" checked="{{isset($acceso->estatus)?$acceso->estatus:old('estatus')}}" >           
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
        <input type="hidden" class="form-control" id="created_by" name="created_by" value="{{ Auth::user()->id }}">
        <button class="btn btn-success btn-lg btn-block" type="submit">{{ $modo }}</button>
    </div>
    <div class="col-md-6 mb-3">
        <a href="{{ route('accesos.index') }}" class="btn btn-danger btn-lg btn-block">Cancelar</a>

    </div>
</div>