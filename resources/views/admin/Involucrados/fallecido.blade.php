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
                        <div class="row">
                        <div class="form-group col-md-3">
                                <label for="">Nombre</label>
                                <input type="text" class="form-control" placeholder="Nombre completo" value="{{$involucrado->name}}" name="herido">

                            </div>
                            <div class="form-group col-md-3">
                                <label for="">DPI (opcional)</label>
                                <input type="number" class="form-control" placeholder="" id="dpiherido" value="{{$involucrado->dpi}}" name="dpiherido">

                            </div>
                            <div class="form-group col-md-2">
                                <label for="">Género</label>
                                <select type="text" class="form-control" placeholder="Nombre completo" id="generoherido" value="{{$involucrado->name}}" name="generoherido">
                                    <option value="M" selected>M</option>
                                    <option value="F">F</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="">Edad</label>
                                <input name="ageherido" type="number" value="{{$involucrado->age}}" class="form-control">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="">Herido/Fallecido</label>
                                <select name="herofall" id="herofall" class="form-control" >
                                        <option {{ collect(old( 'herofall', optional($involucrado->fallecido)))->contains('1') ? 'selected' : '' }} value="1">Fallecido</option>
                                        <option {{ collect(old( 'herofall', optional($involucrado->fallecido)))->contains('2') ? 'selected' : '' }} value="0">Herido</option>
                                </select>
                            </div>
                        </div>
                    </div>
                        <div class="row">

                            <div class="form-group col-md-4">
                                <label for="">Tatuajes</label>
                                <textarea name="tattoosherido" id="tattoosherido" class="form-control" cols="30" rows="2">{{$involucrado->tattoos}}</textarea>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="">Alias</label>
                                <input type="text" name="aliasherido" value="{{$involucrado->alias}}" class="form-control">
                            </div>

                            <div class="form-group col-md-2">
                                <label for="gang">Mara</label>
                                <select name="gangherido" id="gangherido" class="form-control select2">
                                    <option value="0">Seleccione</option>
                                    @foreach ($gangs as $gang)
                                    <option value="{{ $gang->name}}" {{ old( 'gangherido', $involucrado->mara->id) == $gang->id ? 'selected' : '' }} >{{ $gang->name }}</option>
                                    @endforeach 
                                </select>
                            </div>

                            <div class="col-md-3 form-group">
                                <label for="">Abordo:</label>
                                <select name="abordo" id="abordo" class="form-control select2">
                                    <br>
                                    <option value="">Seleccione una opcion</option>
                                    @foreach ($movil as $mov)
                                    <option value="{{ $mov->id}}" {{ old( 'abordo', $involucrado->movil->id) == $mov->id ? 'selected' : '' }} >{{ $mov->tipo }}</option>
                                    @endforeach 
                                </select>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="">Heridas:</label>
                                    <textarea name="heridas" id="heridas" cols="30" rows="4" class="form-control">{{$involucrado->heridas}}</textarea>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Motivo:</label>
                                    <textarea name="motivo" id="motivo" cols="30" rows="4" class="form-control">{{$involucrado->motivo}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="">Diagnostico</label>
                                    <textarea name="diagnostico" id="diagnostico" cols="30" rows="4" class="form-control">{{$involucrado->diagnostico}}</textarea>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Observaciones</label>
                                    <textarea name="observaciones" id="observaciones" cols="30" rows="4" class="form-control">{{$involucrado->observaciones}}</textarea>
                                </div>
                        <button class="btn btn-primary btn-block">Actualizar</button>
                    </form>
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
            tags: true,
        });
</script>
@endpush