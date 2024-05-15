@csrf
<div class="col-6">
    <div class="col-12">

        <div class="col-group">
            <label for="">Vicepresidencia</label>
            <input type="text" class="form-control" name="vicepresidencia"
                value="{{(isset($vicepresidencia))?$vicepresidencia->vicepresidencia:old('vicepresidencia')}}" required>
        </div>
</div>