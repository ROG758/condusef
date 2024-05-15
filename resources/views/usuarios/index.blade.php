@extends('layouts.app')
@section('content')
<div class="card mt-3">
    <div class="card-header d-inline-flex ml-auto">
        <h5>Usuarios</h5>

    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <div claas="form-group">
                    <a class="navbar-brand">Listar</a>
                    <!--filtado-->
                    <select class="form-select" aria-label="Default select example" id="limit" name="limit">
                        @foreach([0,5,10,15,20] as $limit)
                        <option value="{{$limit}}" @if(isset($_GET['limit'])){{($_GET['limit']==$limit) ?'selected':''}}
                            @endif>{{ $limit}}
                        </option>
                        @endforeach
                    </select>
                    <div>
                    <a href="{{route('personal.create')}}" class="btn btn-primary ml-auto">
            <i class="fas fa-plus"></i>
            AGREGAR
        </a>
                    </div>
                    <?php
                         if(isset($_GET['page'])){
                           $pag=$_GET['page'];
                        }else{
                           $pag=1;
                        }

                        if(isset($_GET['limit'])){
                             $limit=$_GET['limit'];
                       }else{
                             $limit=10;
                    }

                    $init=$limit*=($pag-1);
                     ?>

                </div>
            </div>

            <div class="col-8">
                <div class="form.group">
                    <a class="navbar-brand">Buscar</a>
                    <!--cuadro de busqueda-->
                    <input type="text" class="form-control" id="search" placeholder="Buscar" aria-label="Username"
                        aria-describedby="basic-addon1" value="{{(isset($_GET['search']))?$_GET['search']:''}}">
                </div>

            </div>
            @if($personal->total() > 5)
            {{$personal->links()}}
            @endif

        </div>
        <div class="table-reponsive">
            <table class="table caption-top">
                <caption>Lista de Personal</caption>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>No. de Empleado</th>
                        <th>Nombre</th>
                        <th>Área</th>
                        <th>Vicepresidencia</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                $valor=1;
                if($pag!=1){
                $valor=$init+1;
                }
                ?>
                    @foreach($personal as $personal)
                    <tr>
                        <td>{{$valor++}}</td>
                        <td>{{$personal->numeroEmpleado}}</td>
                        <td>{{$personal->nombre}} {{$personal->apellidoPaterno}} {{$personal->apellidoMaterno}}</td>
                        <td>{{$personal->area}}</td>
                        <td>{{$personal->idVicepre}}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                
                                <a href="{{route('personal.edit', $personal->idPersonal)}}" class="btn btn-primary"><i
                                        class="fas fa-pencil-alt"></i></a>

                                <button type="Submit" class="btn btn-danger" form="delete_{{$personal->idPersonal}}"
                                    onclick="return confirm('¿Desea continuar con la operacion?. Esta acción no se puede revertir')">

                                    <i class="fas fa-trash"></i>

                                </button>

                                <form action="{{route('personal.destroy', $personal->idPersonal)}}"
                                    id="delete_{{$personal->idPersonal}}" method="POST" enctype="multipart/form-data"
                                    hidden>
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
    <div class="card-footer">

    </div>

</div>

<script>
$(document).ready(function() {
    $('#limit').on('change', function() {
        applyFilters();
    });

    $('#search').on('keyup', function(e) {
        if (e.keyCode == 13) {
            applyFilters();
        }
    });

    function applyFilters() {
        var limit = $('#limit').val();
        var search = $('#search').val();

        // Codificar el valor de búsqueda antes de agregarlo a la URL
        search = encodeURIComponent(search);

        // Redirigir a la página con los parámetros de búsqueda y filtrado
        window.location.href = "{{ route('personal.index')}}?limit=" + limit + '&search=' + search;
    }
});
</script>
<!-- JS PARA FILTAR Y BUSCAR MEDIANTE PAGINADO -->

@endsection