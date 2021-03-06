@extends('admin.layout')


@section('header')
<h1>
   Editar plantilla
    <small>Reportes PNC</small>
  </h1>
  <ol class="breadcrumb">
  <li><a href="{{ route('dashboard')}}"><i class="fa fa-home"></i> Inicio </a></li>
  <li class="active"><a href="{{ route('admin.plantillas.index')}}">Plantillas</a></li>
  </ol>
@endsection

@section('content')
    <form action="{{route('admin.plantillas.update', $plantilla)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
            <label for="name">Nombre:</label>
            <input type="text" class="form-control" name="name" style="width: 18cm" placeholder="Nombre de la plantilla" value="{{ old('name', $plantilla->name)}}">
            {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
        </div>
        <div class="form-gruop {{$errors->has('body') ? 'has-error' : ''}}">
            <textarea name="body" id="editor" class="form-control" rows="10" placeholder="Contenido de plantilla">{{ old('body', $plantilla->body)}}</textarea>
            {!! $errors->first('body', '<span class="help-block">:message</span>') !!}
        </div>
        <div style="width: 18cm;" >
            <button class="pull-right btn btn-primary">Guardar cambios</button>
        </div>
    </form>
@endsection

@push('styles')
<link rel="stylesheet" href="{{asset("/css/dropzone.css")}}">
<link rel="stylesheet" href="{{asset("/adminlte/bower_components/select2/dist/css/select2.min.css")}}">
@endpush

@push('scripts')
<script src="{{asset('/adminlte/ckeditor/ckeditor.js')}}"></script>
{{-- <script src={{asset('/adminlte/ckeditor/ckeditor.js')}}></script> --}}
<script src="{{asset("/adminlte/bower_components/select2/dist/js/select2.full.min.js")}}"></script>
<script>

    CKEDITOR.replace('editor');
    $('.select2').select2({
        tags: true
    });

    CKEDITOR.config.height = 315;
    CKEDITOR.config.width = '18cm';
    CKEDITOR.config.languaje = 'es';
    // CKEDITOR.config.uiColor = '#F7B42C';

</script>
@endpush