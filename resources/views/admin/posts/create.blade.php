@extends('admin.layout')

@section('header')
<h1>
   Crear publicación
    <small>Reportes PNC</small>
  </h1>
  <ol class="breadcrumb">
  <li><a href="{{ route('dashboard')}}"><i class="fa fa-home"></i> Inicio </a></li>
  <li class="active"><a href="{{ route('admin.posts.create')}}">Posts</a></li>
  </ol>
@endsection

@section('content')
<div class="row">
    <form action={{ route('admin.posts.store')}} method="POST">
        @csrf
    <div class="col-md-8">
    <div class="box box-primary">
            <div class="box-body">
                <div class="form-group {{$errors->has('title') ? 'has-error' : ''}}" >
                    <label for="">Titulo del reporte</label>
                    <input type="text" class="form-control" placeholder="Ingrese aquí el titulo del reporte" id="title" name="title">
                    {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                    
                </div>
                
                <div class="form-group">
                        <label for="">Contenido del reporte</label>
                        <textarea name="body" id="editor" class="form-control" rows="10" placeholder="Detalle aquí el reporte"></textarea>
                   </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-body">
                    <div class="form-group">
                            <label>Fecha de suceso</label>
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input name="published_at" type="text" class="form-control pull-right" id="datepicker">
                            </div>
                            <!-- /.input group -->
                    </div>
                    <div class="form-group">
                        <label for="">Seleccione una categoría</label>
                        <select name="category" class="form-control">
                            <option value="">Seleccione la categoria</option>
                            @foreach ($categories as $cat)
                            <option value="{{ $cat->id}}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Etiquetas</label>
                            <select name="tags[]" class="form-control select2" multiple="multiple" data-placeholder="Elija las etiquetas"
                            style="width: 100%;">
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                    </select>
                    </div>
                <div class="form-group">
                    <label for="">Extracto</label>
                    <textarea name="excerpt" id="excerpt" class="form-control" placeholder="Ingrese un extracto de la publicación"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css">
@endpush

@push('scripts')
<script src="/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="/adminlte/bower_components/ckeditor/ckeditor.js"></script>
<script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
<script>
    $('#datepicker').datepicker({
    autoclose: true
  });
    CKEDITOR.replace('editor');
    $('.select2').select2();
</script>
@endpush
