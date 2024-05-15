@extends('layouts.app')
@section('content')
<div clas="card mt-3">
    <div class="card-header d-inline-flex">
        <h5>Vista de Ususario {{$vistas->nombre}}</h5>
        <a href="{{route('vista.index')}}" class="btn btn-primary ml-auto">
            <i class="fas fa-chevron-circle-left"></i>
            Volver
        </a>
    </div>
    <div class="card-body">
        <form action="{{route('vista.store')}}" method="POST" enctype="multipart/form-data" id="create">
        @include('vistauser.partials.form')
        </form>
    </div>
    <div class="card-footer">
        
    </div>

</div>
@endsection
