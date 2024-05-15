@csrf
<div class="col-6">
    <div class="col-12">

        <div class="col-group">
            <label for="">No. de Empleado</label>
            <input type="text" class="form-control" name="numeroEmpleado"
                value="{{(isset($personal))?$personal->numeroEmpleado:old('numeroEmpleado')}}" required>
        </div>

        <div class="col-group">
            <label for="">Nombre</label>
            <input type="text" class="form-control" name="nombre"
                value="{{(isset($personal))?$personal->nombre:old('nombre')}}" required>
        </div>
    </div>
    <div class="col-12">
        <div class="col-group">
            <label for="">Apellido Paterno</label>
            <input type="text" class="form-control" name="apellidoPaterno"
                value="{{(isset($personal))?$personal->apellidoPaterno:old('apellidoPaterno')}}" required>
        </div>
    </div>
    <div class="col-12">
        <div class="col-group">
            <label for="">Apellido Materno</label>
            <input type="text" class="form-control" name="apellidoMaterno"
                value="{{(isset($personal))?$personal->apellidoMaterno:old('apellidoMaterno')}}" required>
        </div>
    </div>

    <div class="col-12">
        <div class="col-group">
            <label for="">Área</label>
            <input type="text" class="form-control" name="area"
                value="{{(isset($personal))?$personal->area:old('area')}}" required>
        </div>
    </div>

  

</div>