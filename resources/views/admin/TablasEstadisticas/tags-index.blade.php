@extends('admin.layout')

@section('content')

    <div class="box box-primary">
        <div class="box-body">
            <div class="box-header with-border">
                <h3>Elija la etiqueta</h3>
            </div>
            <div class="box-body">
                <form action="{{route('buscar.tag')}}" method="POST">
                    @csrf
                    <label for="Buscar">Seleccione el mes y año</label>
                        <input type="text" id="Buscar" name="Buscar" class="form-control" placeholder="Ingrese el año que desea" required>
                    <div class="form-group">
                        <label for="tag">Seleccione la etiqueta</label>
                        <select name="tag" id="tag" class="form-control select2" required>
                            <option value="">Seleccione una etiqueta</option>
                            @foreach($tags as $tag)
                            <option value="{{$tag->id}}">{{$tag->subcategory}} / {{$tag->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <button class="form-control btn btn-info">Buscar</button>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('styles')
<link rel="stylesheet" href={{asset("/adminlte/bower_components/select2/dist/css/select2.min.css")}}>
<link rel="stylesheet" href={{asset("/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css")}}>
@endpush

@push('scripts')
<script src={{asset("/adminlte/bower_components/select2/dist/js/select2.full.min.js")}}></script>
<script src={{asset("/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js")}}></script>
<script>
        $('.select2').select2({});
</script>
<script>
$( document ).ready(function() {
 
    $("#Buscar").datepicker( {
    format: " mm-yyyy", // Notice the Extra space at the beginning
    viewMode: "months", 
    minViewMode: "months",
    languaje: "es"
}).datepicker("setDate",'now');;
});
</script>
@endpush