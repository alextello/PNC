@extends('admin.layout')

@section('content')
    <div class="row">
        <div class=" col-md-offset-3 col-md-6">
                    <div class="box box-primary">
                        <div class="box-body">
                          @include('admin.partials.error-messages')
                            <div class="box-header with-border">
                                <h3>Editar permiso</h3>
                            </div>
                            <div class="box-body">
                                <form action="{{ route('admin.permissions.update', $permission) }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Identificador: </label>
                                        <input  value="{{ $permission->name }}" class="form-control" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="display_name">Nombre: </label>
                                        <input name="display_name" value="{{ old('display_name', $permission->display_name) }}" class="form-control">
                                    </div>
                                    <button class="btn btn-primary btn-block">Actualizar permiso</button>
                                </form>
                            </div>
                        </div>
                    </div>
             </div>
    </div>
@endsection