$(document).ready(function () {
    let total = 1;
    const contenedor = document.querySelector('#dinamic');


    $('#agregar').on('click', function () {
        $('#dinamic').append(`

        <div class="row">
            <div class="col-md-5 mb-3">
                <label for="pregunta">Pregunta</label>
                <select class="custom-select d-block w-100" name="pregunta" id="pregunta">
                    <option value="{{ isset($formulario->pregunta)?$formulario->pregunta:old('pregunta') }}">{{ isset($formulario->pregunta)?$formulario->preguntas->nombre:"Selecione uno" }}</option>
                    @foreach($preguntas as $key => $pregunta)
                    <option value="{{ $key }}">{{ $pregunta }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">
                    Please select a valid country.
                </div>
            </div>
            <div class="col-md-5 mb-3">
                <label for="respuesta">Tipo de respuesta</label>
                <select class="custom-select d-block w-100" name="respuesta" id="respuesta">
                    <option value="{{ isset($formulario->respuesta)?$formulario->respuesta:old('respuesta') }}">{{ isset($formulario->respuesta)?$formulario->respuestas->nombre:"Selecione uno" }}</option>
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

        `);
    });

    //ELIMINAR
    $(document).on('click', '.remover', function () {
        $(this).parents('.row').remove();
    })
});