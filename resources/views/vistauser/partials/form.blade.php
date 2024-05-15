@csrf
<div>
    <div class="col-group">
        <label for="">Usuarios</label>
        <div>
            <select name="idPersonal" id="idPersonal" class="form-control" required>
                <option value="#">Seleccione</option>
                @foreach($personal as $usuarios)
                <option value="{{$usuarios['idPersonal']}}">{{$usuarios['numeroEmpleado']}}-{{$usuarios['nombre']}}
                    {{$usuarios['apellidoPaterno']}} {{$usuarios['apellidoMaterno']}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="card-fooder">
        <h5>Seleccion de sistemas</h5>

        <div class="col-gorup">
            <label for="">Sistemas De Información</label>
            <div>
                <select name="idAccesos[]" id="idAccesos" class="control-form selectpicker" title="Seleccionar sistemas"
                    multiple required>
                    <option value="#">Seleccione</option>
                    @foreach($accesos as $acceso)
                    <option value="{{$acceso['idAccesos']}}">
                        {{$acceso['claveSistema']}}-{{$acceso['nombreSistema']}}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Lista para mostrar sistemas seleccionados -->
        <div>
            <h5>Sistemas Seleccionados:</h5>
            <ul id="selectedSystems" style="max-height: 400px; overflow-y: auto;"></ul>
        </div>

    </div>
</div>