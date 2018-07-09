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

@if($post->involucrados->count())
<div class="col-md-12">

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">
                Involucrados
                <small></small>
            </h3>
            <!-- tools box -->
            <div class="pull-right box-tools">
                <button type="button" class="btn btn-primary btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                    <i class="fa fa-minus"></i></button>
                </div>
                <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body pad" style="">
                <label for="" class="col-md-5">Nombre</label>
                <label for="" class="col-md-5">DPI</label>
                <label for="" class="col-md-1">Género</label>
                <label for="" class="col-md-1">Eliminar</label>
                @foreach ($post->involucrados as $inv)
                <div class="form-group col-md-5" >
                <input type="text" class="form-control" placeholder="Nombre completo" name="involucrados[]" disabled value="{{ $inv->name }}">
                </div>
                <div class="form-group col-md-5" >
                    <input type="text" class="form-control" placeholder="Nombre completo" name="dpi[]" disabled value="{{ $inv->dpi }}">
                </div>
                <div class="form-group col-md-1" >
                    <input type="text" class="form-control" placeholder="Nombre completo" name="genero[]" disabled value="{{ $inv->gender }}">
                </div>
                <div class="form-group col-md-1" >
                    <form action=" {{ route('admin.involucrados.destroy', [$inv->id, $post->id] )}} " method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-md btn-danger"><span>X</span></button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
    <form action={{ route('admin.posts.update', $post)}} method="POST">
        @csrf
        @method('PUT')
        @foreach ($post->involucrados as $inv)
        <input type="hidden" value="{{$inv->name}}" name="involucrados[]">
        <input type="hidden" value="{{$inv->dpi}}" name="dpi[]">
        <input type="hidden" value="{{$inv->gender}}" name="genero[]">
        @endforeach
    <div class="col-md-8">
            <div class="box box-primary">
                    <div class="box-body">
                        <label for="plantilla">Plantilla</label>
                            <select name="plantilla" class="form-control select2" onchange="cambio(this)">
                                    <option value="" selected>Seleccione la plantilla</option>
                                    @foreach ($plantillas as $pl)
                                    <option value="{{ $pl->id}}">{{ $pl->name }}</option>
                                    @endforeach
                                </select>
                    </div>
                </div>

    {{-- <div class="box box-primary">
            <div class="box-body">
                <div class="form-group {{$errors->has('title') ? 'has-error' : ''}}" >
                    <label for="">Titulo del reporte</label>
                <input type="text" class="form-control" placeholder="Ingrese aquí el titulo del reporte" id="title" name="title" value="{{ old('title', $post->title)}}">
                    {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                    
                </div>
                
                <div class="form-group {{$errors->has('body') ? 'has-error' : ''}}" >
                        <label for="">Contenido del reporte</label>
                <textarea name="body" id="editor" class="form-control" rows="10" placeholder="Detalle aquí el reporte">{{ old('body', $post->body ? $post->body : $post->plantilla )}}</textarea>
                        {!! $errors->first('body', '<span class="help-block">:message</span>') !!}
                   </div>
                  
            </div>
        </div> --}}
        <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">
                      Nueva novedad
                    <small>llene todos los campos</small>
                  </h3>
                  <!-- tools box -->
                  <div class="pull-right box-tools">
                    <button type="button" class="btn btn-primary btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                      <i class="fa fa-minus"></i></button>
                  </div>
                  <!-- /. tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body pad" style="">
                <div class="form-group {{$errors->has('title') ? 'has-error' : ''}}" >
                      <label for="">Titulo del reporte</label>
                  <input type="text" class="form-control" placeholder="Ingrese aquí el titulo del reporte" id="title" name="title" value="{{ old('title', $post->title)}}">
                      {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                      
                  </div>
                  
                  <div class="form-group {{$errors->has('body') ? 'has-error' : ''}}" >
                          <label for="">Contenido del reporte</label>
                  <textarea name="body" id="editor" class="form-control" rows="10" placeholder="Detalle aquí el reporte">{{ old('body', $post->body ? $post->body : $post->plantilla )}}</textarea>
                          {!! $errors->first('body', '<span class="help-block">:message</span>') !!}
                  </div>
                </div>
              </div>

              <div class="box box-primary">
                    <div class="box-header">
                      <h3 class="box-title">
                          Registre involucrados en la novedad si desea
                        <small>(opcional)</small>
                      </h3>
                      <!-- tools box -->
                      <div class="pull-right box-tools">
                        <button type="button" class="btn btn-primary btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                          <i class="fa fa-minus"></i></button>
                      </div>
                      <!-- /. tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body pad" style="" id='dinamico'>
                    <div id="conjunto">
                    <div class="form-group col-md-4" >
                          <label for="">Nombre</label>
                      <input type="text" class="form-control" placeholder="Nombre completo"  name="involucrados[]" >
                          
                      </div>
                      <div class="form-group col-md-4" >
                            <label for="">DPI (opcional)</label>
                        <input type="number" class="form-control" placeholder="" id="dpi" name="dpi[]">
                            
                        </div>
                        <div class="form-group col-md-2" >
                                <label for="">Género</label>
                            <select type="text" class="form-control select2" placeholder="Nombre completo" id="genero" name="genero[]">
                                <option value="M">M</option>
                                <option value="F">F</option>
                            </select>
                            </div>

                      <div class="form-group col-md-2" >
                          <label for="">Añadir otro</label>
                            <button class="form-control btn btn-success" type="button" name='otro' id='otro'><span><i class="fa fa-plus"></i></span></button>
                        </div>
                    </div>
                    </div>
                  </div>
    </div>
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-body">
                    <div class="form-group {{$errors->has('oficio') ? 'has-error' : ''}}" >
                            <label>Oficio:</label>
                            <input name="oficio" type="number" class="form-control" id="oficio" value="{{ old('oficio', $post->oficio ? $post->oficio : '') }}">
                            <!-- /.input group -->
                    </div>
                     <div class="form-group {{$errors->has('municipio') ? 'has-error' : ''}}" >
                        <label for="">Seleccione el municipio</label>
                        <select name="municipio" id="municipio" class="form-control select2">
                            <option value="">Seleccione el municipio</option>
                            @if($post->address!=null)
                            @foreach ($municipios as $muni)
                            <option value="{{ $muni->id}}"
                                {{ old('municipio', $post->address->municipio->id) == $muni->id ? 'selected' : '' }}
                                >{{ $muni->name }}</option>
                             @endforeach
                             @else
                             @foreach ($municipios as $muni)
                            <option value="{{ $muni->id}}"
                                {{ old('municipio') == $muni->id ? 'selected' : '' }}
                                >{{ $muni->name }}</option>
                             @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group {{$errors->has('address_id') ? 'has-error' : ''}}" >
                            <label>Dirección del suceso</label>
                            <input name="address_id" type="text" class="form-control" id="address_id" value="{{ old('address_id', $post->address_id ? $post->address()->pluck('name')->implode('') : '') }}">
                            <!-- /.input group -->
                    </div>
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
                    <div class="bootstrap-timepicker">
                        <div class="form-group {{$errors->has('time') ? 'has-error' : ''}}">
                          <label>Hora del suceso:</label>
        
                          <div class="input-group">
                            <input type="text" name="time" class="form-control timepicker" value="{{ old('time', $post->time ?  date("g:i a", strtotime($post->time)): '') }}">
        
                            <div class="input-group-addon">
                              <i class="fa fa-clock-o"></i>
                            </div>
                          </div>
                          <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                      </div>
                    {{-- <div class="form-group {{$errors->has('category_id') ? 'has-error' : ''}}" >
                        <label for="">Seleccione una categoría</label>
                        <select name="category_id" id="category_id" class="form-control select2">
                            <option value="">Seleccione la categoria</option>
                            @foreach ($categories as $cat)
                            <option value="{{ $cat->id}}"
                                {{ old('category_id', $post->category_id) == $cat->id ? 'selected' : '' }}
                                >{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    {{-- <div class="form-group {{$errors->has('subcategory_id') ? 'has-error' : ''}}" >
                            <label for="">Seleccione una subcategoría</label>
                            <select name="subcategory_id" id="subcategory_id" class="form-control select2">
                                <option value="">Seleccione la subcategoria</option>
                                @if(isset($post->subcategory_id))
                                @foreach ($categories as $category)
                                @if($category->id == $post->category_id)
                                @foreach ($category->subcategories as $sub)
                                <option value="{{ $sub->id}}"
                                    {{ old('subcategory_id', $post->subcategory_id) == $sub->id ? 'selected' : '' }}
                                    >{{ $sub->name }}</option>
                                @endforeach
                                @endif
                                @endforeach
                                @endif
                            </select>
                        </div> --}}
                    <div class="form-group {{$errors->has('tag_id') ? 'has-error' : ''}}" >
                        <label for="">Etiqueta</label>
                            <select name="tag_id" class="form-control select2" data-placeholder="Elija la etiqueta"
                            style="width: 100%;">
                            @foreach ($tags as $tag)
                             <option {{ collect(old('tag_id', optional($post->tags)->id))->contains($tag->id) ? 'selected' : '' }}
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


@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.css">
<link rel="stylesheet" href="/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="/adminlte/plugins/timepicker/bootstrap-timepicker.min.css">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.js"></script>
<script src="/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="/adminlte/bower_components/ckeditor/ckeditor.js"></script>
<script src="/adminlte/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
<script>
function cambio(selectObject) {
    var value = selectObject.value; 
    $.ajax({
        headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
        type: "POST",
        url: '/admin/plantilla',
        data: { plantilla: value},
        success: function(data) {
        CKEDITOR.instances.editor.setData(data.body);
        }
    })
};
    $('#datepicker').datepicker({
    autoclose: true
  });
    CKEDITOR.replace('editor');
    $('.select2').select2({
        tags: true,
        createTag: function(params) {
                return undefined;
           }
    });


    CKEDITOR.config.height = 315;

    Dropzone.autoDiscover = false;


    var myDropzone = new Dropzone(".dropzone", { 
        addRemoveLinks: true,
        dictRemoveFile: 'Eliminar',
        url: '/admin/posts/{{ $post->url }}/photos',
        acceptedFiles: 'image/*',
        maxFilesize: 2,
        maxFiles: 2,
        paramName: 'photo',
        dictDefaultMessage: 'Arrastre aquí las fotos o haga click para seleccionarlas',
        removedFile: function(file){
    //         $.ajax({
    //     type: 'POST',
    //     headers: '{{ csrf_token() }}',
    //     url: '/admin/photos/'+file
    // });
        console.log(file.value);
        },
        headers:{
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
        
        });

          

        myDropzone.on('error', function(fle, res){
           var msg = res.errors.photo[0];
           $('.dz-error-message:last > span').text(msg);
        });

       
</script>
<script>
    $(document).ready(function(){
        var i = 1;
        $('#otro').click(function(){
            i++;
            $('#dinamico').append("<div id='conjunto"+i+"'> <div class='form-group col-md-4'> <label for=''>Nombre</label><input type='text' class='form-control' placeholder='Nombre completo'  name='involucrados[]' ></div><div class='form-group col-md-4' ><label for=''>DPI (opcional)</label><input type='number' class='form-control' placeholder='' id='dpi' name='dpi[]'></div><div class='form-group col-md-2' ><label for=''>Género</label><select type='text' class='form-control select2' id='genero' name='genero[]'> <option value='M'>M</option><option value='F'>F</option></select></div><div class='form-group col-md-2' ><label for=''>Quitar</label><button class='form-control btn btn-danger btn_remove' type='button' name='remove' id='"+i+"'><span><i class='fa fa-minus'></i></span></button></div></div>");
        });
        $(document).on('click', '.btn_remove', function(){
            var button_id = $(this).attr("id");
            $('#conjunto'+button_id).remove();
        });
    });
</script>
<script>
    // $(document).ready(function(){
    //     $('#category_id').change(function() {
    //         console.log('cambio');
    //     $('#subcategy_id').empty();
    //     var id = $('#category_id').val();
    //      $('#subcategory_id').html('<option value='">Seleccione subcategoria</option>');
    //     var url = '/admin/Subcategory/'+id;
    //   $.ajax({
    //       url: url,
    //       type: "GET",
    //       dataType: "json",
    //       success:function(data) {
    //           $.each(data, function(key, value) {
    //               $('#subcategory_id').append('<option value="'+value.id+'">'+value.name+'</option>');
    //           });
    
    //       },
    //       error:function(result){
    //           console.log('error');
    //       }
    //   });
    //     });
    // });
  </script>

  <script>
   $('.timepicker').timepicker({
      showInputs: false,
      minuteStep: 5,
      defaultTime: 'current'
    })
  </script>
@endpush
