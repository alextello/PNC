@extends('admin.layout')

@section('header')
<h1>
   Ver plantillas
    <small>Reportes PNC</small>
  </h1>
  <ol class="breadcrumb">
  <li><a href="{{ route('dashboard')}}"><i class="fa fa-home"></i> Inicio </a></li>
  <li class="active"><a href="{{ route('admin.plantillas.index')}}">Plantillas</a></li>
  </ol>
@endsection

@section('content')
    <div class="form-group">
        <input type="text" class="form-control" name="name" placeholder="Nombre de la plantilla" value="{{ $plantilla->name}}">
    </div>
    <textarea name="body" id="editor" class="form-control" rows="10" placeholder="Contenido de plantilla">{!! $plantilla->body !!}</textarea>
    <span class="help-block">Los cambios aquí no se guardarán</span>
@endsection

@push('styles')
<link rel="stylesheet" href={{asset("/css/dropzone.css")}}>
<link rel="stylesheet" href={{asset("/adminlte/bower_components/select2/dist/css/select2.min.css")}}>
@endpush

@push('scripts')
<script src={{asset('/adminlte/ckeditor/ckeditor.js')}}></script>
<script src={{asset("/adminlte/bower_components/select2/dist/js/select2.full.min.js")}}></script>
<script>

    CKEDITOR.replace('editor');
    $('.select2').select2({
        tags: true
    });

    CKEDITOR.config.height = 315;
</script>
@endpush