@extends('layouts.app')
@section('content')


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Bootstrap Toggle -->
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<!--stilo del select2 seleccion de opcion de busqueda para la exportación-->
<link rel="stylesheet" href="{{asset('css/select2.css')}}">

<div class="card mt-3">
    <div class="card-header d-inline-flex ml-auto">
        <h5>Acceso a sistemas</h5>

    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <div class="form-group">
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
            @if($vistas->total() > 5)
            {{$vistas->links()}}
            @endif

        </div>

        <div>
            <a href="{{route('sistemas.create')}}" class="btn btn-primary ml-auto">
                <i class="fas fa-plus"></i>
                AGREGAR
            </a>
        </div>


        <div class="table-reponsive">
            <table class="table caption-top">
                <caption><i class="fas fa-list"></i>Lista Accesos a Sistemas</caption>

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Sistemas</th>
                        <th>Usuario</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
                    </tr>


                </thead>

                <tbody>

                <?php $valor = $init + 1; ?>
                    @foreach($vistas as $vista)
                    <tr>
                        <td>{{ $valor++ }}</td>
                        <td>{{$vista->claveSistema}}</td>
                        <td>{{$vista->nombre}}</td>
                        <td id="resp{{$vista->idSistemaPersona}}">
                            @foreach($estatus as $status)
                            @if($status->idSistemaPersona == $vista->idSistemaPersona)
                            <br>
                            <input id="toggle{{$status->idSistemaPersona}}" class="mi_checkbox" type="checkbox"
                                data-id="{{$status->idSistemaPersona}}" data-onstyle="success" data-offstyle="danger"
                                data-toggle="toggle" data-on="Activo" data-off="Inactivo"
                                {{$status->estatus ? 'checked' : ''}}>
                            @endif
                            @endforeach
                        </td>


                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">

                                <button type="Submit" class="btn btn-danger" form="delete_{{$vista->idSistemaPersona}}"
                                    onclick="return confirm('¿Desea continuar con la operacion?. Esta acción no se puede revertir')">

                                    <i class="fas fa-trash"></i>

                                </button>

                                <form action="{{route('sistemas.destroy', $vista->idSistemaPersona)}}"
                                    id="delete_{{$vista->idSistemaPersona}}" method="POST" enctype="multipart/form-data"
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

        <form id="exportForm" action="{{ route('export') }}" method="POST" target="_blank">
            @csrf
            <div class="container">
                <div class="row">
                    <label>Exportar</label>
                    <div class="col-xl">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="opcionTodo" id="1" value="option1"
                                checked>
                            <label class="form-check-label" for="1">General</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="opcionTodo" id="2" value="option2">
                            <label class="form-check-label" for="2">Sistema</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="opcionTodo" id="3" value="option3">
                            <label class="form-check-label" for="3">Usuario</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="opcionTodo" id="4" value="option4">
                            <label class="form-check-label" for="4">Vicepresidencia</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="opcionTodo" id="5" value="option5">
                            <label class="form-check-label" for="5">Área</label>
                        </div>
                    </div>

                    <div class="col-sm">
                        <select name="acce" id="acce" class="form-control"></select>

                    </div>


                    <div class="col-sm">
                        <select name="exportType" id="exportType" class="form-control">
                            <option value="pdf">PDF</option>
                            <option value="excel">Excel</option>
                        </select>
                    </div>

                    <div class="col-sm">
                        <button type="submit" class="btn btn-padding"><i class="fa fa-download"></i>
                            Exportar</button>
                    </div>
                </div>
            </div>
        </form>

    </div>




</div>



<script>
$(document).ready(function() {
    $('#acce').select2({
        width: 'resolve' // Usa el ancho del contenedor padre
    });
});
</script>




<!-- JS PARA FILTAR Y BUSCAR MEDIANTE PAGINADO -->
<Script type="text/javascript">
$('#limit').on('change', function() {
    window.location.href = "{{ route('sistemas.index')}}?limit=" + $(this).val() + '&search=' + $('#search')
        .val()
})

$('#search').on('keyup', function(e) {
    if (e.keyCode == 13) {
        window.location.href = "{{ route('sistemas.index')}}?limit=" + $('#limit').val() + '&search=' + $(
            this).val()
    }
})
</Script>

<script>
document.getElementById('pdfForm').addEventListener('submit', function(event) {
    // Abre una nueva ventana con el tamaño especificado al enviar el formulario
    window.open('', 'pdfWindow', 'width=600,height=800');
});
</script>

<script>
$(document).ready(function() {
    $('input[type=radio]').change(function() {
        var selectedOption = $(this).attr('id');
        if (selectedOption == "1") {
            $('#acce').prop('disabled', true); // Deshabilitar el select
            $('#acce').val('#'); // Establecer el valor por defecto como #
        } else if (selectedOption == "2") {
            $('#acce').prop('disabled', false);
            // Realizar una llamada AJAX para obtener los datos de los accesos
            $.ajax({
                url: "{{ route('obtener-datos-acce') }}", // Ruta del endpoint en Laravel
                type: 'GET',
                success: function(data) {
                    // Limpiar el select y agregar la opción por defecto
                    $('#acce').empty().append('<option value="#">Seleccione</option>');
                    // Llenar el select con los datos obtenidos
                    $.each(data, function(index, value) {
                        $('#acce').append('<option value="' + value.idaccesos +
                            '">' + value.claveSistema + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        } else if (selectedOption == "3") {
            $('#acce').prop('disabled', false);
            $.ajax({
                url: "{{ route('obtener-datos-usuario') }}", // Ruta del endpoint en Laravel
                type: 'GET',
                success: function(data) {
                    // Limpiar el select y agregar la opción por defecto
                    $('#acce').empty().append('<option value="#">Seleccione</option>');
                    // Llenar el select con los datos obtenidos
                    $.each(data, function(index, value) {
                        $('#acce').append('<option value="' + value.idPersonal +
                            '">' + value.nombre + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        } else if (selectedOption == "4") {
            $('#acce').prop('disabled', false);
            $.ajax({
                url: "{{ route('obtener-datos-vicepresidencia') }}",
                type: 'GET',
                success: function(data) {
                    $('#acce').empty().append('<option value="#">Seleccione</option>');
                    $.each(data, function(index, value) {
                        $('#acce').append('<option value="' + value.idVicepre +
                            '">' + value.vicepresidencia + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        } else if (selectedOption == "5") {
            $('#acce').prop('disabled', false);
            $.ajax({
                url: "{{ route('obtener-datos-area') }}",
                type: 'GET',
                success: function(data) {
                    $('#acce').empty().append('<option value="#">Seleccione</option>');
                    $.each(data, function(index, value) {
                        $('#acce').append('<option value="' + value.area +
                            '">' + value.area + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    });
});
</script>



<!--checkbox-->
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<script>
$(document).ready(function() {
    // Inicializar los switches de Bootstrap Toggle
    $('.mi_checkbox').bootstrapToggle();

    // Manejar el evento de cambio en los switches
    $('.mi_checkbox').change(function() {
        var idSistemaPersona = $(this).data('id');
        var estatus = $(this).prop('checked') ? 1 : 0;

        $.ajax({
            url: '{{ route("actualizar-status") }}', // Asegúrate de que esta ruta sea correcta
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                idSistemaPersona: idSistemaPersona,
                estatus: estatus
            },
            success: function(response) {
                $('#resp' + idSistemaPersona).html(response.newStatus);
                // Re-inicializar el Bootstrap Toggle después de actualizar el HTML
                $('#toggle' + idSistemaPersona).bootstrapToggle();
                // Volver a agregar el event listener
                $('#toggle' + idSistemaPersona).change(function() {
                    var idSistemaPersona = $(this).data('id');
                    var estatus = $(this).prop('checked') ? 1 : 0;

                    $.ajax({
                        url: '{{ route("actualizar-status") }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            idSistemaPersona: idSistemaPersona,
                            estatus: estatus
                        },
                        success: function(response) {
                            $('#resp' + idSistemaPersona).html(
                                response
                                .newStatus);
                            // Re-inicializar el Bootstrap Toggle después de actualizar el HTML
                            $('#toggle' + idSistemaPersona)
                                .bootstrapToggle();
                            // Volver a agregar el event listener
                            $('#toggle' + idSistemaPersona).change(
                                function() {
                                    var idSistemaPersona = $(
                                            this)
                                        .data('id');
                                    var estatus = $(this).prop(
                                        'checked') ? 1 : 0;

                                    $.ajax({
                                        url: '{{ route("actualizar-status") }}',
                                        type: 'POST',
                                        data: {
                                            _token: '{{ csrf_token() }}',
                                            idSistemaPersona: idSistemaPersona,
                                            estatus: estatus
                                        },
                                        success: function(
                                            response
                                        ) {
                                            $('#resp' +
                                                    idSistemaPersona
                                                )
                                                .html(
                                                    response
                                                    .newStatus
                                                );
                                            // Re-inicializar el Bootstrap Toggle después de actualizar el HTML
                                            $('#toggle' +
                                                    idSistemaPersona
                                                )
                                                .bootstrapToggle();
                                        },
                                        error: function(
                                            xhr,
                                            status,
                                            error) {
                                            console
                                                .error(
                                                    error
                                                );
                                            alert(
                                                'Hubo un error al actualizar el estado. Por favor, inténtalo de nuevo.'
                                            );
                                        }
                                    });
                                });
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                            alert(
                                'Hubo un error al actualizar el estado. Por favor, inténtalo de nuevo.'
                            );
                        }
                    });
                });
            },
            error: function(xhr, status, error) {
                console.error(error);
                alert(
                    'Hubo un error al actualizar el estado. Por favor, inténtalo de nuevo.'
                );
            }
        });
    });
});
</script>


@endsection