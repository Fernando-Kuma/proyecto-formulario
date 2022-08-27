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
        <input type="hidden" class="form-control" id="created_by" name="created_by" value="{{ Auth::user()->id }}">
        <label for="name">Nombre</label>
        <input type="text" class="form-control" id="name" placeholder="" name="name" value="{{ isset($usuario->name)?$usuario->name:old('name') }}">
        <div class="invalid-feedback">
            Valid first name is required.
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label for="surnames">Apellidos</label>
        <input type="text" class="form-control" id="surnames" placeholder="" name="surnames" value="{{ isset($usuario->surnames)?$usuario->surnames:old('surnames') }}">
        <div class="invalid-feedback">
            Valid last name is required.
        </div>
    </div>
</div>
<div class="mb-3">
    <label for="email">Correo</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" value="{{ isset($usuario->email)?$usuario->email:old('email') }}">
    <div class="invalid-feedback">
        Please enter a valid email address for shipping updates.
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="password">Contraseña</label>
        <input type="password" class="form-control" id="password" placeholder="" name="password" value="" {{ isset($usuario->password)?"disabled":"" }}>
        <div class="invalid-feedback">
            Valid password is required.
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label for="phone">Telefono</label>
        <input type="text" class="form-control" id="phone" placeholder="" name="phone" value="{{ isset($usuario->phone)?$usuario->phone:old('phone') }}">
        <div class="invalid-feedback">
            Valid phone is required.
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label for="empresa">Empresa</label>
        <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon3">{{ Auth::user()->empresa }}</span>
        <input type="text" class="form-control" id="empresa" placeholder="" name="empresa" value="{{ isset($usuario->empresa)?$usuario->empresa:old('empresa') }}">
        </div>
        <div class="invalid-feedback">
            Valid empresa is required.
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label for="rol">Rol</label>
        <select class="custom-select d-block w-100" name="rol_id" id="rol_id">
        <option value="{{ isset($usuario->rol_id)?$usuario->rol_id:old('rol_id') }}">{{ isset($usuario->rol_id)?$usuario->rols->nombre:"Selecione uno" }}</option>
            @foreach($rols as $key => $rol)
                @if(Auth::user()->rol_id == 1)
                    <option value="{{ $key }}">{{ $rol }}</option>
                @else
                    @if ($key != 1 && $key != 2)
                    <option value="{{ $key }}">{{ $rol }}</option>
                    @endif
                @endif
            
            @endforeach
        </select>
        <div class="invalid-feedback">
            Please select a valid country.
        </div>
    </div>
</div>
<hr class="mb-4">
<div class="row">
    <div class="col-md-6 mb-3">
        <button class="btn btn-success btn-lg btn-block" type="submit">{{ $modo }}</button>
    </div>
    <div class="col-md-6 mb-3">
        <a href="{{ route('usuarios.index') }}" class="btn btn-danger btn-lg btn-block">Cancelar</a>

    </div>
</div>