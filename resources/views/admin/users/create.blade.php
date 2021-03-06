@extends('admin.layout')

@section('content')
    <div class="row">
        <div class=" col-md-offset-3 col-md-6">
                    <div class="box box-primary">
                        <div class="box-body">
                                @include('admin.partials.error-messages')
                            <div class="box-header with-border">
                                <h3>Insertar datos</h3>
                            </div>
                            <div class="box-body">
                                <form action="{{ route('admin.users.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Nombre: </label>
                                        <input name="name" value="{{ old('name') }}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Usuario: </label>
                                        <input name="email" value="{{ old('email') }}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="codigo">Código: </label>
                                        <input name="codigo" value="{{ old('codigo') }}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="telefono">Telefono: </label>
                                        <input name="telefono" value="{{ old('telefono') }}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Contraseña: </label>
                                        <input type="password" name="password" class="form-control" placeholder="Contraseña">
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirme la contraseña: </label>
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="Repita la contraseña">
                                       
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">Roles</label>
                                        @include('admin.roles.checkboxes')
                                    </div>
                                    <div class="form-group col-md-6">
                                         <label for="">Permisos</label>
                                         @include('admin.permissions.checkboxes', ['model' => $user])
                                    </div>
                                    <button class="btn btn-primary btn-block">Crear usuario</button>
                                </form>
                            </div>
                        </div>
                    </div>
             </div>
    </div>
@endsection