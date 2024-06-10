<!doctype html>
<html lang="es">

<head>
    <title>Reporte</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />


    <link href="{{ asset('css/pdf.css') }}" rel="stylesheet">

</head>

<body>

    <div>
        <img src="{{asset('img/Logohacienda.png')}}" alt="hacienda" class="logo-hacienda">
    </div>

    <div>
        <img src="{{asset('img/Condusef.png')}}" alt="condusef" class="logo-condusef">
    </div>

    <div class="logo-container">
        <img src="{{asset('img/EscudoNacional.png')}}" alt="Escudo" class="escudo-nacional">
    </div>


    <h2 class="text-cab">{{$resultado}}</h2>
    <table class="table">


        <thead class="table th.cabecera">
            <tr>

                <th>Estatus</th>
                <th>Clave de Empleado Usuario</th>

            </tr>
        </thead>
        <tbody class="cuerpotabla">


            @foreach($vistas as $nom)
            <tr>

                <td>
                    @foreach($estatus as $status)
                    @if($status->idSistemaPersona == $nom->idSistemaPersona)
                    @if($status->estatus == 1)
                    Activo
                    @elseif($status->estatus == 0)
                    Inactivo
                    @endif
                    @endif
                    @endforeach
                </td>
                <td>{{$nom->nombre}}</td>

            </tr>
            @endforeach

        </tbody>
    </table>

    <div class="nombre-firma">
        <p>___________________________</p>
        <p>Nombre y Firma</p>
    </div>


    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>