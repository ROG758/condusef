@extends('layouts.app')

@section('styles')
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection

@section('content')
<div class="card mt-3">

    <div class="card-header">
        <h5>Alta de Accesos a sistemas</h5>
        <a href="{{route('sistemas.index')}}" class="btn btn-primary ml-auto">
            <i class="fa fa-arrow-left"></i>
            volver
        </a>
    </div>
    <div class="card-body">
        <!-- Formulario resguardado en acceso partials-->
        <form action="{{route('sistemas.store')}}" method="POST" enctype="multipart/form-data" id="create">

            @include('sistemasUsuarios.partials.form')
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

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
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