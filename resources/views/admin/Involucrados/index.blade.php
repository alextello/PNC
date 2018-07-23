@extends('admin.layout')

@section('content')
<div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body">
                <div class="box-header with-border">
                    <h3>Datos Personales</h3>
                </div>
                <div class="box-body">
                    <form action="{{ route('admin.involucrado.update', [$involucrado->id, $post]) }}" method="POST">
                        @csrf
                    <input type="hidden" name="post" id="post" value="{{ $post }}">
                        <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                            <label for="name">Nombre: </label>
                            <input name="name" value="{{ $involucrado->name }}" class="form-control" placeholder="Nombre">
                        </div>
                        <div class="form-group">
                            <label for="email">DPI: </label>
                            <input name="dpi" type="number" value="{{ $involucrado->dpi }}" class="form-control" placeholder="dpi">
                        </div>
                        <div class="form-group">
                            <label for="codigo">Genero: </label>
                            <select name="gender" id="gender" class="form-control">
                                @if($involucrado->gender == 'M')
                                <option value="M" selected>M</option>
                                <option value="F">F</option>
                                @else
                                <option value="M">M</option>
                                <option value="F" selected>F</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group {{$errors->has('age') ? 'has-error' : ''}}">
                            <label for="telefono">Edad: </label>
                            <input name="age" value="{{ $involucrado->age }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Tatuajes: </label>
                            <input type="tattoos" name="tattoos" value="{{$involucrado->tattoos}} "class="form-control" placeholder="Contraseña">
                        </div>
                        <div class="form-group">
                            <label for="password">Alias: </label>
                            <input type="text" name="alias" class="form-control" value="{{$involucrado->alias}}" placeholder="Alias">
                        </div>
                        <div class="form-group">
                                <label for="password">Mara: </label>
                                <select name="gang_id" id="gang" class="form-control select2">
                                     @foreach($gangs as $gang)
                                     <option {{ collect($gang)->contains($involucrado->gang_id) ? 'selected' : '' }} value="{{ $gang->id }}">{{ $gang->name }}</option>
                                     @endforeach
                                </select>
                            </div>
                        <button class="btn btn-primary btn-block">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css">
@endpush

@push('scripts')
<script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
<script>
     $('.select2').select2({
            tags: true,
        });
</script>
@endpush