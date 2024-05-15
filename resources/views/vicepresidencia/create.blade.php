@extends('layouts.app')

@section('styles')
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection

@section('content')
<div class="card mt-3">

    <div class="card-header">
        <h5>Alta de Vicepresidencias</h5>
        <a href="{{route('vicepresidencia.index')}}" class="btn btn-primary ml-auto">
            <i class="fa fa-arrow-left"></i>
            volver
        </a>
    </div>
    <div class="card-body">
        <!-- Formulario resguardado en acceso partials-->
        <form action="{{route('vicepresidencia.store')}}" method="POST" enctype="multipart/form-data" id="create">

            @include('vicepresidencia.partials.form')
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