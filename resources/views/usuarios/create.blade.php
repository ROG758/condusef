@extends('layouts.app')
@section('content')
<div class="card mt-3">

    <div class="card-header">
        <h5>Alta de Usuarios</h5>
        <a href="{{route('personal.index')}}" class="btn btn-primary ml-auto">
            <i class="fa fa-arrow-left"></i>
            volver
        </a>
    </div>

    <div class="card-body">
        <form action="{{route('personal.store')}}" method="POST" enctype="multipart/form-data" id="create">
            @include('usuarios.partials.form')
        </form>

        <div class="card-footer">
            <button class="btn btn-primary" form="create"
                onclick="return confirm('Antes de continuar, valide si los datos son correctos')">
                <i class="fa fa-plus"></i>
                Crear
            </button>
        </div>

    </div>

</div>
@endsection