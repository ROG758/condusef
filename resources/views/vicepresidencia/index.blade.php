@extends('layouts.app')
@section('content')
<div class="card mt-3">
    <div class="card-header d-inline-flex ml-auto">
        <h5>Vicepresidencias</h5>
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
            @if($vicepresidencia->total() > 5)
            {{$vicepresidencia->links()}}
            @endif

        </div>
        <div>
            <div>
                <a href="{{route('vicepresidencia.create')}}" class="btn btn-primary ml-auto">
                    <i class="fas fa-plus"></i>
                    AGREGAR
                </a>
            </div>
            <caption><i class="fas fa-list"></i>Lista de Vicepresidencias</caption>
        </div>

        <div class="table-reponsive">
            <table class="table caption-top">

                <thead>
                    <tr>
                        <th>#</th>
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
                    @foreach($vicepresidencia as $vice)
                    <tr>
                        <td>{{$valor++}}</td>
                        <td>{{$vice->vicepresidencia}}</td>

                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                               
                                <a href="{{route('vicepresidencia.edit', $vice->idVicepre)}}" class="btn btn-primary"><i
                                        class="fas fa-pencil-alt"></i></a>

                                <button type="Submit" class="btn btn-danger" form="delete_{{$vice->idVicepre}}"
                                    onclick="return confirm('¿Desea continuar con la operacion?. Esta acción no se puede revertir')">

                                    <i class="fas fa-trash"></i>

                                </button>

                                <form action="{{route('vicepresidencia.destroy', $vice->idVicepre)}}"
                                    id="delete_{{$vice->idVicepre}}" method="POST" enctype="multipart/form-data" hidden>
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
    window.location.href = "{{ route('vicepresidencia.index')}}?limit=" + $(this).val() + '&search=' + $(
            '#search')
        .val()
})

$('#search').on('keyup', function(e) {
    if (e.keyCode == 13) {
        window.location.href = "{{ route('vicepresidencia.index')}}?limit=" + $('#limit').val() + '&search=' +
            $(
                this).val()
    }
})
</Script>

@endsection