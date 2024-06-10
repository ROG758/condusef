@extends('layouts.app')

@section('styles')
<!-- Latest compiled and minified CSS de Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('css/select2.css')}}">
@endsection

@section('content')
<div class="card mt-3">
    <div class="card-header">
        <h5>Alta de Accesos a sistemas</h5>
        <a href="{{route('sistemas.index')}}" class="btn btn-primary ml-auto">
            <i class="fa fa-arrow-left"></i>
            Volver
        </a>
    </div>
    <div class="card-body">
        <form action="{{route('sistemas.store')}}" method="POST" enctype="multipart/form-data" id="create">
            @csrf
            <div>
                <div class="col-group">
                    <label for="idAccesos">Sistemas</label>
                    <div>
                        <select name="idAccesos" id="idAccesos" class="form-control select2-single" required>
                            <option value="#">Seleccione</option>
                            @foreach($accesos as $acceso)
                            <option value="{{$acceso['idAccesos']}}">
                                {{$acceso['claveSistema']}}-{{$acceso['nombreSistema']}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="card-footer">
                    <h5>Seleccion de sistemas</h5>

                    <div class="col-group">
                        <label for="idPersonal">Usuarios</label>
                        <div>
                            <select name="idPersonal[]" id="idPersonal" class="form-control select2-multiple" title="Seleccionar usuarios" multiple required>
                                <option value="#">Seleccione</option>
                                @foreach($personal as $usuarios)
                                <option value="{{$usuarios['idPersonal']}}">
                                    {{$usuarios['numeroEmpleado']}}-{{$usuarios['nombre']}} {{$usuarios['apellidoPaterno']}} {{$usuarios['apellidoMaterno']}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Lista para mostrar sistemas seleccionados -->
                    <div>
                        <h5>Usuarios Seleccionados:</h5>
                        <ul id="selectedSystems" style="max-height: 400px; overflow-y: auto;"></ul>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer">
        <button class="btn btn-primary" form="create" onclick="return confirm('Antes de continuar, valide si los datos son correctos')">
            <i class="fa fa-plus"></i>
            Crear
        </button>
    </div>
</div>
@endsection

@section('scripts')
<!-- Latest compiled and minified JavaScript de Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    // Inicializar Select2 para ambos selects
    $('#idAccesos').select2({
        width: 'resolve' // Usa el ancho del contenedor padre
    });

    $('#idPersonal').select2({
        width: 'resolve', // Usa el ancho del contenedor padre
        placeholder: 'Seleccione usuarios', // Placeholder para el select múltiple
        allowClear: true // Permite limpiar la selección
    });

    // Manejo de cambios en los usuarios seleccionados
    $('#idPersonal').change(function() {
        $('#selectedSystems').empty(); // Limpiar la lista de sistemas seleccionados

        // Iterar sobre los sistemas seleccionados y agregarlos a la lista
        $('#idPersonal option:selected').each(function() {
            $('#selectedSystems').append('<li>' + $(this).text() + '</li>');
        });
    });
});
</script>
@endsection
