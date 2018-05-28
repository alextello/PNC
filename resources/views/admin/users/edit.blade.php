@extends('admin.layout')

@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                    @include('admin.partials.error-messages')
                <div class="box-header with-border">
                    <h3>Datos Personales</h3>
                </div>
                <div class="box-body">
                    <form action="{{ route('admin.users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Nombre: </label>
                            <input name="name" value="{{ old('name', $user->name) }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Usuario: </label>
                            <input name="email" value="{{ old('email', $user->email) }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="codigo">Código: </label>
                            <input name="codigo" value="{{ old('codigo', $user->codigo) }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="telefono">Telefono: </label>
                            <input name="telefono" value="{{ old('telefono', $user->telefono) }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña: </label>
                            <input type="password" name="password" class="form-control" placeholder="Contraseña">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirme la contraseña: </label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Repita la contraseña">
                            <span class="help-block">Dejar en blanco los campos de contraseña si no desea cambiarla</span>
                        </div>
                        <button class="btn btn-primary btn-block">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Roles</h3>
            </div>
            <div class="box-body">
                @role('Administrador')
                <form action="{{ route('admin.users.roles.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('admin.roles.checkboxes')
                <button class="btn btn-primary btn-block">Actualizar Roles</button>
                 </form>
                 @else
                 <ul class="list-group">
                     @foreach ($user->roles as $role)
                        <li class="list-group-item">{{$role->name}}</li>
                     @endforeach
                 </ul>
                 @endrole
            </div>
        </div>
        <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Permisos</h3>
                </div>
                <div class="box-body">
                    @role('Administrador')
                    <form action="{{ route('admin.users.permissions.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('admin.permissions.checkboxes', ['model' => $user])
                    <button class="btn btn-primary btn-block">Actualizar Permisos</button>
                     </form>
                     @else
                     <ul class="list-group">
                         @php
                         $pr = $user->getAllPermissions()->pluck('name');
                         @endphp
                         @foreach($pr as $p)
                         <li class="list-group-item">
                            {{$p}}
                        </li>
                             @endforeach
                     {{-- <li class="list-group-item">{{ $user->getAllPermissions()->pluck('name')->implode(', ') }}</li> --}}
                         {{-- @forelse ($user->permissions as $perm)
                            <li class="list-group-item">{{$perm->name}}</li>
                            @empty
                            <li class="list-group-item">No tiene permisos adicionales</li>
                         @endforelse --}}
                     </ul>
                     @endrole
                </div>
            </div>
    </div>
</div>

@endsection