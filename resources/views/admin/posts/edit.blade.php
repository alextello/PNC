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
@if($post->photos->count())
<div class="row">
        <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                            <div class="row">
                                    @foreach($post->photos as $photo)
                                    <form action="{{ route('admin.photos.destroy', $photo) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="col-md-2">
                                            <button class="btn btn-danger btn-xs" style="position: absolute"><i class="fa fa-remove"></i></button>
                                            <img src="/storage/{{ $photo->url }}" alt="" class="img-responsive">
                                        </div> 
                                    </form>
                                    @endforeach
                             </div>
                    </div>     
                </div>
            </div>
@endif
    <form action={{ route('admin.posts.update', $post)}} method="POST">
        @csrf
        @method('PUT')
    <div class="col-md-8">
    <div class="box box-primary">
            <div class="box-body">
                <div class="form-group {{$errors->has('title') ? 'has-error' : ''}}" >
                    <label for="">Titulo del reporte</label>
                <input type="text" class="form-control" placeholder="Ingrese aquí el titulo del reporte" id="title" name="title" value="{{ old('title', $post->title)}}">
                    {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                    
                </div>
                
                <div class="form-group {{$errors->has('body') ? 'has-error' : ''}}" >
                        <label for="">Contenido del reporte</label>
                <textarea name="body" id="editor" class="form-control" rows="10" placeholder="Detalle aquí el reporte">{{ old('body', $post->body)}}</textarea>
                        {!! $errors->first('body', '<span class="help-block">:message</span>') !!}
                   </div>
                  
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-body">
                    <div class="form-group {{$errors->has('published_at') ? 'has-error' : ''}}" >
                            <label>Fecha de suceso</label>
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                            <input name="published_at" type="text" class="form-control pull-right" id="datepicker" value="{{ old('published_at', $post->published_at ? $post->published_at->format('m/d/Y') : '') }}">
                            </div>
                            <!-- /.input group -->
                    </div>
                    <div class="form-group {{$errors->has('category_id') ? 'has-error' : ''}}" >
                        <label for="">Seleccione una categoría</label>
                        <select name="category_id" class="form-control select2">
                            <option value="">Seleccione la categoria</option>
                            @foreach ($categories as $cat)
                            <option value="{{ $cat->id}}"
                                {{ old('category_id', $post->category_id) == $cat->id ? 'selected' : '' }}
                                >{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group {{$errors->has('tags') ? 'has-error' : ''}}" >
                        <label for="">Etiquetas</label>
                            <select name="tags[]" class="form-control select2" multiple="multiple" data-placeholder="Elija las etiquetas"
                            style="width: 100%;">
                            @foreach ($tags as $tag)
                             <option {{ collect(old('tags', $post->tags->pluck('id')))->contains($tag->id) ? 'selected' : '' }}
                             value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                    </select>
                    </div>
                <div class="form-group {{$errors->has('excerpt') ? 'has-error' : ''}}" >
                    <label for="">Extracto</label>
                <textarea name="excerpt" id="excerpt" class="form-control" placeholder="Ingrese un extracto de la publicación">{{ old('excerpt', $post->excerpt)}}</textarea>
                </div>
                <div class="form-group">
                    <div class="dropzone"></div>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.css">
<link rel="stylesheet" href="/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.js"></script>
<script src="/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="/adminlte/bower_components/ckeditor/ckeditor.js"></script>
<script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
<script>
    $('#datepicker').datepicker({
    autoclose: true
  });
    CKEDITOR.replace('editor');
    $('.select2').select2({
        tags: true
    });

    CKEDITOR.config.height = 315;

    Dropzone.autoDiscover = false;

    var myDropzone = new Dropzone(".dropzone", { 
        url: '/admin/posts/{{ $post->url }}/photos',
        acceptedFiles: 'image/*',
        maxFilesize: 2,
        maxFiles: 2,
        paramName: 'photo',
        dictDefaultMessage: 'Arrastre aquí las fotos o haga click para seleccionarlas',
        headers:{
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
        
        });

        myDropzone.on('error', function(fle, res){
           var msg = res.errors.photo[0];
           $('.dz-error-message:last > span').text(msg);
        });
</script>
@endpush
