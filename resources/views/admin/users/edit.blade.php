@extends('admin.layout')

@section('content')

<div class="row">
    <div class="col-md-offset-3 col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                @if($errors->any())
                    <ul class="list-group">
                        @foreach ($errors->all() as $error)
                            <li class="list-group-item list-group-item-danger">
                                {{$error}}
                            </li>
                        @endforeach
                    </ul>
                @endif
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
</div>

@endsection