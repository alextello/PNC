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
                                <form action="{{ route('admin.arma.update', $gun) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Tipo:</label>
                                        <select name="type_id" class="form-control select2" id="type_id">
                                            <option value="">Seleccione una opcion</option>
                                            @foreach($tipos as $tipo)
                                            <option {{ collect(old( 'type_id', optional($gun->type_id)))->contains($tipo->id) ? 'selected' : '' }} value="{{ $tipo->tipo }}">{{ $tipo->tipo }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Marca:</label>
                                        <select name="marca_id" id="marca_id" class="form-control select2">
                                            <option value="">Seleccione una opcion</option>
                                            @foreach($marcas as $marca)
                                            <option {{ collect(old( 'marca_id', optional($gun->marca_id)))->contains($marca->id) ? 'selected' : '' }} value="{{ $marca->name }}">{{ $marca->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Calibre:</label>
                                        <input type="text" name="calibre" value="{{ old('calibre', $gun->calibre)}}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Registro:</label>
                                        <input type="text" name="registro" value="{{ old('registro', $gun->registro)}}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Licencia:</label>
                                        <input type="text" name="licencia" value="{{ old('licencia', $gun->licencia)}}" class="form-control">
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
<link rel="stylesheet" href={{asset("/adminlte/bower_components/select2/dist/css/select2.min.css")}}>
@endpush

@push('scripts')
<script src={{asset("/adminlte/bower_components/select2/dist/js/select2.full.min.js")}}></script>
<script>
 $('.select2').select2({
     tags: true
 })
</script>
@endpush