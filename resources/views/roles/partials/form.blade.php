@csrf
<div class="row">
    <div class="col-12">
        <div class="form-floating">
            <input type="text" placeholder="name" class="form-control" name="name"
                value="{{ isset($role) ? $role->name : old('name') }}">
            <label>Nombre</label>
        </div>
    </div>
    <div class="col-12">
        <h5>Permisos Para Este Rol: </h5>
        @if ((isset($role->id) ? $role->id : '') == '')
            @foreach ($permission as $value)
                <label>{{ Form::checkbox('permission[]', $value->id, false, ['class' => 'name']) }}
                    {{ $value->name }}
                </label><br>
            @endforeach
        @else
            <label for="">Permisos Para Este Rol: </label><br>
            @foreach ($permission as $value)
                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, ['class' => 'name']) }}
                    {{ $value->name }}</label><br>
            @endforeach
        @endif


    </div>
</div>
