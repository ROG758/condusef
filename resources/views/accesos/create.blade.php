@extends('layouts.app')
@section('content')
<div class="card mt-3">

    <div class="card-header">
        <h5>Alta de Sistemas De información</h5>
        <a href="{{route('acceso.index')}}" class="btn btn-primary ml-auto">
            <i class="fa fa-arrow-left"></i>
            volver
        </a>
    </div>
    <div class="card-body">
        <!-- Formulario resguardado en acceso partials-->
        <form action="{{route('acceso.store')}}" method="POST" enctype="multipart/form-data" id="create">

            @include('accesos.partials.form')
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