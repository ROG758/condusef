@extends('layouts.app')
@section('content')
<div class="card mt-3">

    <div class="card-header">
        <h5>Edición de Vicepresidencia</h5>
        <a href="{{route('vicepresidencia.index')}}" class="btn btn-primary ml-auto">
            <i class="fa fa-arrow-left"></i>
            volver
        </a>
    </div>

    <div class="card-body">
        <form action="{{route('vicepresidencia.update',$vicepresidencia->idVicepre)}}" method="POST" enctype="multipart/form-data" id="create">
            @method('PUT')
            @include('vicepresidencia.partials.form')
        </form>

        <div class="card-footer">
            <button class="btn btn-primary" form="create"
                onclick="return confirm('Antes de continuar, valide si los datos son correctos')">
                <i class="fas fa-pencil-alt"></i>
                editar
            </button>
        </div>

    </div>

</div>
@endsection