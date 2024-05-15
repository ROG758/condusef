@csrf
<div class="col-6">
    <div class="col-12">
        <!--agregar id del sistemas-->
        <div class="col-group">
            <label for="">ID del sistema</label>
            <input type="text" class="form-control" name="claveSistema"
                value="{{(isset($acceso))?$acceso->claveSistema:old('claveSistema')}}" required>
        </div>

        <!--agrgar el nombre del sistema-->
        <div class="col-group">
            <label for="">Nombre de Sistema</label>
            <input type="text" class="form-control" name="nombreSistema"
                value="{{(isset($acceso))?$acceso->nombreSistema:old('nombreSistema')}}" required>
        </div>


        <!--agrgar descripcion del sistema-->
        <div class="col-group">
            <div class="col-group">
                <label for="">Descripción</label>
                <input type="text" class="form-control" name="descripcion"
                    value="{{(isset($acceso))?$acceso->descripcion:old('descripcion')}}" required>
            </div>
        </div>

        <!-- agrgar acronimo de sistema-->
        <div class="col-group">
            <div class="col-group">
                <label for="">Siglas/ Acrónimo del sistema</label>
                <input type="text" class="form-control" name="siglas"
                    value="{{(isset($acceso))?$acceso->siglas:old('siglas')}}" required>
            </div>
        </div>

        <!-- agregar la clasiosicacion del sistema-->
        <div class="col-group">
            <div class="col-group">
                <label for="">Clasificación</label>
                <input type="text" class="form-control" name="clasificacion"
                    value="{{(isset($acceso))?$acceso->clasificacion:old('clasificacion')}}" required>
            </div>
        </div>

        <!-- agregar el área que desarrollo el sistema-->
        <div class="col-group">
            <div class="col-group">
                <label for="">Área desarrolladora</label>
                <input type="text" class="form-control" name="desarrollo"
                    value="{{(isset($acceso))?$acceso->desarrollo:old('desarrollo')}}" required>
            </div>
        </div>

        <!--agraga estatus de sistema -->
        <div class="col-group">
            <label for="">¿El sistema se encuentra activo?</label>
            <input type="text" class="form-control" name="estatus"
                value="{{(isset($acceso))?$acceso->estatus:old('estatus')}}" required>
        </div>

        <div class="col-group">
            <label for="">URL</label>
            <input type="text" class="form-control" name="url" value="{{(isset($acceso))?$acceso->url:old('url')}}"
                required>
        </div>


        <!-- agrega la infomracion de roles del sistema-->
        <div class="col-group">
            <label for="">Roles del sistema</label>
            <div>
                <select name="idRolSistema" id="idRolSistema" class="form-comtrol">
                    <option value="#">Seleccione</option>
                    @foreach($Rolsistema as $Rolsistem)
                    <option value="{{$Rolsistem['idRolSistema']}}">{{$Rolsistem['nombreLiderP']}}</option>
                    @endforeach
                </select>
            </div>
        </div>



        <!-- agrega la infomracion general  del sistema-->
        <div class="col-group">
            <label for="">Informacón General del Sistema</label>
            <div>
                <select name="idInformacion" id="idInformacion" class="form-comtrol">
                    <option value="#">Seleccione</option>
                    @foreach($Informacionsis as $Informacionsis)
                    <option value="{{$Informacionsis['idInformacion']}}">{{$Informacionsis['inicioOperacion']}}</option>
                    @endforeach
                </select>
            </div>
        </div>



        <!-- agrega la caracteristicas de roles del sistema-->
        <div class="col-group">
            <label for="">Características del Sistema</label>
            <div>
                <select name="idCaracteriticas" id="idCaracteriticas" class="form-comtrol">
                    <option value="#">Seleccione</option>
                    @foreach($caracteristicas as $caracteristicas)
                    <option value="{{$caracteristicas['idCaracteriticas']}}">{{$caracteristicas['OS']}}</option>
                    @endforeach
                </select>
            </div>
        </div>


         <!-- agrega la Documentacion  del sistema-->
         <div class="col-group">
            <label for="">Documentación del Sistema</label>
            <div>
                <select name="idDocumentacion" id="idDocumentacion" class="form-comtrol">
                    <option value="#">Seleccione</option>
                    @foreach($Documentacion as $Documentacion)
                    <option value="{{$Documentacion['idDocumentacion']}}">{{$Documentacion['estatusDocumentacion']}}</option>
                    @endforeach
                </select>
            </div>
        </div>


         <!-- agrega la infomracion seguridad en  sistema-->
         <div class="col-group">
            <label for="">Seguridad del Sistema</label>
            <div>
                <select name="idSeguridad" id="idSeguridad" class="form-comtrol">
                    <option value="#">Seleccione</option>
                    @foreach($seguridad as $seguridad)
                    <option value="{{$seguridad['idSeguridad']}}">{{$seguridad['roles']}}</option>
                    @endforeach
                </select>
            </div>
        </div>

         <!-- agrega la datos personales en sistema-->
         <div class="col-group">
            <label for="">Datos personales en Sistema</label>
            <div>
                <select name="idDatos" id="idDatos" class="form-comtrol">
                    <option value="#">Seleccione</option>
                    @foreach($datos as $datos)
                    <option value="{{$datos['idDatos']}}">{{$datos['datosPersonales']}}</option>
                    @endforeach
                </select>
            </div>
        </div>



         <!-- agrega la infomracion de mantenimineto  del sistema-->
         <div class="col-group">
            <label for="">Matenimiento del Sistema</label>
            <div>
                <select name="idMantenimiento" id="idMantenimiento" class="form-comtrol">
                    <option value="#">Seleccione</option>
                    @foreach($mantenimiento as $mantenimiento)
                    <option value="{{$mantenimiento['idMantenimiento']}}">{{$mantenimiento['mantenimiento']}}</option>
                    @endforeach
                </select>
            </div>
        </div>




    </div>

</div>