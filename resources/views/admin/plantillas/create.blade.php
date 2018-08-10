@extends('admin.layout')

@section('header')
<h1>
   Crear plantilla
    <small>Reportes PNC</small>
  </h1>
  <ol class="breadcrumb">
  <li><a href="{{ route('dashboard')}}"><i class="fa fa-home"></i> Inicio </a></li>
  <li class="active"><a href="{{ route('admin.plantillas.index')}}">Plantillas</a></li>
  </ol>
@endsection


@section('content')
    <form action="{{route('admin.plantillas.store')}}" method="POST">
        @csrf
        <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
            <label for="name">Nombre:</label>
            <input type="text" class="form-control" name="name" placeholder="Nombre de la plantilla" autofocus value="{{ old('name')}}">
            {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
        </div>
        <div class="form-gruop {{$errors->has('body') ? 'has-error' : ''}}">
            <textarea name="body" id="editor" class="form-control" rows="10" placeholder="Contenido de plantilla">{{ old('body')}}</textarea>
            <button class="btn btn-primary btn-block">Crear plantilla</button>
            {!! $errors->first('body', '<span class="help-block">:message</span>') !!}
        </div>
    </form>
@endsection

@push('styles')
<link rel="stylesheet" href={{asset("/css/dropzone.css")}}>
<link rel="stylesheet" href={{asset("/adminlte/bower_components/select2/dist/css/select2.min.css")}}>
@endpush

@push('scripts')
<script src={{asset("/adminlte/bower_components/ckeditor/ckeditor.js")}}></script>
<script src={{asset("/adminlte/bower_components/select2/dist/js/select2.full.min.js")}}></script>
<script>

    CKEDITOR.replace('editor');
    $('.select2').select2({
        tags: true
    });

    CKEDITOR.config.height = 315;
</script>
@endpush
