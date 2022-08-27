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
    <div class="col-md-9 mb-3">
        <label for="name">Nombre de evento</label>
        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="" value="{{ isset($evento->nombre)?$evento->nombre:old('nombre') }}">
        <div class="invalid-feedback">
            Valid name is required.
        </div>
    </div>
    <div class="col-md-2 mb-3">
        <label for="name">Agregar pregunta</label>
        <a class="clonar btn btn-success btn-icon-split">
            <span class="icon text-white-100">
                <i class="fas fa-plus"></i>
            </span>
        </a>
    </div>
</div>

<div id="clon">
    @if (isset($evento->id))
    @foreach($evento->formularios as $formulario )
    <div class="group row">
        <div class="col-md-5 mb-3">
        <input type="hidden" id="formulario_id[]" name="formulario_id[]" placeholder="" value="{{ isset($formulario->id)?$formulario->id:old('formulario_id[]') }}">
            <label for="pregunta">Pregunta</label>
            <input type="text" class="form-control" id="pregunta[]" name="pregunta[]" placeholder="" value="{{ isset($formulario->pregunta)?$formulario->pregunta:old('pregunta[]') }}">
        </div>
        <div class="col-md-5 mb-3">
            <label for="respuesta">Tipo de respuesta</label>
            <select class="custom-select d-block w-100" name="respuesta[]" id="respuesta[]">
                <option value="{{ isset($formulario->respuesta)?$formulario->respuesta:old('respuesta[]') }}">{{ isset($formulario->respuesta)?$formulario->respuestas->nombre:"Selecione uno" }}</option>
                @foreach($respuestas as $key => $respuesta)
                    <option value="{{ $key }}">{{ $respuesta }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-1 mb-3">
            <label for="name">Eliminar</label>
            <a class="deleteP btn btn-danger btn-icon-split" href="{{ route('formulario.show',$formulario->id) }}"  id="deleteP" data-id="{{$formulario->id}}">
                <span class="icon text-white-100">
                    <i class="fas fa-close"></i>
                </span>
            </a>
        </div>
    </div>
    @endforeach
    @else
    <div class="group row">
        <div class="col-md-5 mb-3">
            <label for="pregunta">Pregunta</label>
            <input type="text" class="form-control" id="pregunta[]" name="pregunta[]" placeholder="" value="{{ isset($formulario->pregunta)?$formulario->pregunta:old('pregunta[]') }}">
        </div>
        <div class="col-md-5 mb-3">
            <label for="respuesta">Tipo de respuesta</label>
            <select class="custom-select d-block w-100" name="respuesta[]" id="respuesta[]">
                <option value="{{ isset($formulario->respuesta)?$formulario->respuesta:old('respuesta[]') }}">{{ isset($formulario->respuesta)?$formulario->respuestas->nombre:"Selecione uno" }}</option>
                @foreach($respuestas as $key => $respuesta)
                    <option value="{{ $key }}">{{ $respuesta }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                Please select a valid country.
            </div>
        </div>
        <div class="col-md-1 mb-3">
            <label for="name">Eliminar</label>
            <a class="remover btn btn-danger btn-icon-split" id="agregar">
                <span class="icon text-white-100">
                    <i class="fas fa-close"></i>
                </span>
            </a>
        </div>
    </div>
    @endif
</div>

<hr class="mb-4">
<div class="row">
    <div class="col-md-6 mb-3">
        <input type="hidden" class="form-control" id="created_by" name="created_by" value="{{ Auth::user()->id }}">
        <button class="btn btn-success btn-lg btn-block" type="submit">{{ $modo }}</button>
    </div>
    <div class="col-md-6 mb-3">
        <a href="{{ route('formulario.index') }}" class="btn btn-danger btn-lg btn-block">Cancelar</a>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<script>
    $('.clonar').click(function() {
        // Clona el .input-group
        var $clone = $('#formulario .group.row').last().clone();

        // Borra los valores de los inputs clonados
        $clone.find(':input').each(function() {
            this.value = '';
        });

        // Agrega lo clonado al final del #formulario
        $clone.appendTo('#clon');
    });
    $(document).on('click', '.remover', function() {
        $(this).parents('.row').remove();
    })
</script>