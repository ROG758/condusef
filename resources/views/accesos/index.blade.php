@extends('layouts.app')
@section('content')
<div class="card mt-3">
    <div class="card-header d-inline-flex ml-auto">
        <h5>Sistemas De información</h5>

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
            @if($accesos->total() > 5)
            {{$accesos->links()}}
            @endif

        </div>

        <div class="table-reponsive">
            <table class="table caption-top">
                <caption><i class="fas fa-list"></i>Lista de Sistemas de Infomación</caption>
                <div>
                    <a href="{{route('acceso.create')}}" class="btn btn-primary ml-auto">
                        <i class="fas fa-plus"></i>
                        AGREGAR
                    </a>
                </div>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Sistema</th>
                        <th>Descripción</th>
                        <th>Siglas/ Acrónimo del sistema</th>
                        <th>Clasificación</th>
                        <th>Área desarrolladora</th>
                        <th>¿El sistema se encuentra activo?
                            <select class='form' name="activo" id="activo" aria-describedby="basic-addon1"
                                value="{{(isset($_GET['activo']))?$_GET['activo']:''}}">
                                <option value="#">Todo</option>
                                <option value="si">SI</option>
                                <option value="no">NO</option>
                            </select>
                        </th>
                        <th>URL de sitio Web</th>
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
                    @foreach($accesos as $acceso)
                    <tr>
                        <td>{{$valor++}}</td>
                        <td><span class="text-primary">{{$acceso->claveSistema}}</span><br>
                        {{$acceso->nombreSistema}}</td>
                        <td>{{$acceso->descripcion}}</td>
                        <td>{{$acceso->siglas}}</td>
                        <td>{{$acceso->clasificacion}}</td>
                        <td>{{$acceso->desarrollo}}</td>
                        <td>{{$acceso->estatus}}</td>
                        <td>{{$acceso->url}}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{route('acceso.show', $acceso->idAccesos)}}" class="btn btn-info"><i
                                        class="fas fa-eye"></i></a>
                                <a href="{{route('acceso.edit', $acceso->idAccesos)}}" class="btn btn-primary"><i
                                        class="fas fa-pencil-alt"></i></a>

                                <button type="Submit" class="btn btn-danger" form="delete_{{$acceso->idAccesos}}"
                                    onclick="return confirm('¿Desea continuar con la operacion?. Esta acción no se puede revertir')">

                                    <i class="fas fa-trash"></i>

                                </button>

                                <form action="{{route('acceso.destroy', $acceso->idAccesos)}}"
                                    id="delete_{{$acceso->idAccesos}}" method="POST" enctype="multipart/form-data"
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
<!-- JS PARA FILTAR Y BUSCAR MEDIANTE PAGINADO -->
<Script type="text/javascript">
$('#limit').on('change', function() {
    window.location.href = "{{ route('acceso.index')}}?limit=" + $(this).val() + '&search=' + $('#search')
        .val()
})

$('#search').on('keyup', function(e) {
    if (e.keyCode == 13) {
        window.location.href = "{{ route('acceso.index')}}?limit=" + $('#limit').val() + '&search=' + $(
            this).val()
    }
})
</Script>
@endsection