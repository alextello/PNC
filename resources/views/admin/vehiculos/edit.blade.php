@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
                <div class="box box-primary">
                        <div class="box-body">
                            <div class="box-header with-border">
                                <h3>Datos</h3>
                            </div>
                            <div class="box-body">
                                <form action="{{ route('admin.vehiculo.update', $vehiculo) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Tipo:</label>
                                        <select name="tipo" class="form-control select2" id="tipo">
                                            <option value="">Seleccione una opcion</option>
                                            @foreach($tipos as $tipo)
                                            <option {{ collect(old( 'tipo', optional($vehiculo->tipo_id)))->contains($tipo->id) ? 'selected' : '' }} value="{{ $tipo->id }}">{{ $tipo->tipo }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Marca:</label>
                                        <select name="marca" id="marca" class="form-control select2">
                                            <option value="">Seleccione una opcion</option>
                                            @foreach($marcas as $marca)
                                            <option {{ collect(old( 'tipo', optional($vehiculo->marca_id)))->contains($marca->id) ? 'selected' : '' }} value="{{ $marca->id }}">{{ $marca->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Modelo:</label>
                                        <input type="number" name="modelo" value="{{ old('modelo', $vehiculo->modelo)}}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Color:</label>
                                        <input type="text" name="color" value="{{ old('color', $vehiculo->color)}}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Placa:</label>
                                        <input type="text" name="placa" value="{{ old('placa', $vehiculo->placa)}}" class="form-control">
                                    </div>
                                   
                                    <button class="btn btn-primary btn-block">Actualizar</button>
                                </form>
                            </div>
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
     tags: true
 })
</script>
@endpush