@extends('admin.layout') @section('header')
<h1>
    Crear publicación
    <small>Reportes PNC</small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="{{ route('dashboard')}}">
            <i class="fa fa-home"></i> Inicio </a>
    </li>
    <li class="active">
        <a href="{{ route('admin.posts.create')}}">Posts</a>
    </li>
</ol>
@endsection @section('content') 
@if($post->photos->count())
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    @foreach($post->photos as $photo)
                    <form action="{{ route('admin.photos.destroy', $photo) }}" method="POST">
                        @csrf @method('DELETE')
                        <div class="col-md-2">
                            <button class="btn btn-danger btn-xs" onclick="return confirm('¿Está seguro de querer eliminar la imagen?')" style="position: absolute">
                                <i class="fa fa-remove"></i>
                            </button>
                            <img src="{{asset('/storage/'.$photo->url)}}" alt="" class="img-responsive">
                        </div>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif 

    @if(optional($post->arma)->count())
    <div class="col-md-12">
        <div class="box box-primary collapsed-box">
            <div class="box-header">
                <h3 class="box-title">
                    Arma
                </h3>
                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-primary btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body pad">
                <div class="row">
                    <div class="col-md-2 form-group">
                        <label for="">Tipo</label>
                        <input type="text" class="form-control" value="{{$post->arma->tipo->tipo}}" disabled>
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="">Marca:</label>
                        <input type="text" class="form-control" value="{{$post->arma->brand->name}}" disabled>
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="">Calibre:</label>
                        <input type="text" class="form-control" value="{{$post->arma->calibre}}" disabled>
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="">Registro:</label>
                        <input type="text" class="form-control" value="{{$post->arma->registro}}" disabled>
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="">Licencia:</label>
                        <input type="text" class="form-control" value="{{$post->arma->licencia}}" disabled>
                    </div>
                    <div class="col-md-2 btn-group">  
                        <br>                          
                        <a target="_blank" href="{{route('admin.arma.edit', $post->arma->id)}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                        <form action="{{route('admin.arma.delete', $post->arma->id)}}" method="POST" style="display: inline">
                            @csrf
                            <input type="hidden" value="{{$post->id}}" name="post">
                            <button class="btn btn-danger"><i class="fa fa-remove" onclick="return confirm('¿Está seguro de querer eliminar el arma registrada?')"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(optional($post->vehiculo)->count())
        <div class="col-md-12">
            <div class="box box-primary collapsed-box">
                <div class="box-header">
                    <h3 class="box-title">
                        Vehiculo
                    </h3>
                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-primary btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body pad">
                    <div class="row">
                        <div class="col-md-2 form-group">
                            <label for="">Tipo</label>
                            <input type="text" class="form-control" value="{{$post->vehiculo->tipo->tipo}}" disabled>
                        </div>
                        <div class="col-md-2 form-group">
                            <label for="">Marca:</label>
                            <input type="text" class="form-control" value="{{$post->vehiculo->brand->name}}" disabled>
                        </div>
                        <div class="col-md-2 form-group">
                            <label for="">Color:</label>
                            <input type="text" class="form-control" value="{{$post->vehiculo->color}}" disabled>
                        </div>
                        <div class="col-md-2 form-group">
                            <label for="">Linea:</label>
                            <input type="text" class="form-control" value="{{$post->vehiculo->linea}}" disabled>
                        </div>
                        <div class="col-md-2 form-group">
                            <label for="">Modelo:</label>
                            <input type="text" class="form-control" value="{{$post->vehiculo->modelo}}" disabled>
                        </div>
                        <div class="col-md-2 form-group">
                            <label for="">Placa:</label>
                            <input type="text" class="form-control" value="{{$post->vehiculo->placa}}" disabled>
                        </div>
                        <div class="col-md-2 btn-group">  
                            <br>                          
                            <a target="_blank" href="{{route('admin.vehiculo.edit', $post->vehiculo->id)}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                            <form action="{{route('admin.vehiculo.delete', $post->vehiculo->id)}}" method="POST" style="display: inline">
                                @csrf
                                <input type="hidden" value="{{$post->id}}" name="post">
                                <button class="btn btn-danger"><i class="fa fa-remove" onclick="return confirm('¿Está seguro de querer eliminar el vehiculo registrado?')"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if($post->involucrados->count())
    <div class="col-md-12">
        <div class="box box-primary collapsed-box">
            <div class="box-header">
                <h3 class="box-title">
                    Involucrados
                    <small></small>
                </h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-primary btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
                <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body pad" style="">
                @foreach ($post->involucrados as $inv)
                @if($inv->aprehendido == '1')
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="">Nombre</label>
                    <input type="text" disabled class="form-control" value="{{$inv->name}}">

                    </div>
                    <div class="form-group col-md-3">
                        <label for="">DPI (opcional)</label>
                        <input type="number" disabled class="form-control" value="{{$inv->dpi}}">

                    </div>
                    <div class="form-group col-md-2">
                        <label for="">Género</label>
                        <input type="text" class="form-control" disabled value="{{$inv->gender}}">
                    </div>

                    <div class="form-group col-md-2">
                        <label for="">Edad</label>
                        <input disabled type="number" value="{{ $inv->age }}"class="form-control">
                    </div>

                    <div class="form-group col-md-2">
                        <label for="">Delito</label>
                        <input disabled type="text" value="{{ optional($inv->delito)->name }}"class="form-control">
                    </div>
                </div>
                <div class="row">

                    <div class="form-group col-md-4">
                        <label for="">Tatuajes</label>
                        <textarea name="tattoos[]" disabled class="form-control" cols="30" rows="2">{{ $inv->tattoos }}</textarea>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="">Alias</label>
                        <input type="text"  disabled value="{{ $inv->alias }}" class="form-control">
                    </div>

                    <div class="form-group col-md-2">
                        <label for="gang">Mara</label>
                        <input type="text" class="form-control" disabled value="{{optional($inv->mara)->name}}">
                    </div>
                <div class="form-group col-md-2">
                    <br>
                    <form action=" {{ route('admin.involucrados.destroy', [$inv->id, $post->id] )}} " method="post" style="padding-right: 0px !important;">
                            @csrf @method('DELETE')
                            <div class="btn-group">
                        <button class="btn btn-md btn-danger"  onclick="return confirm('¿Está seguro de querer eliminarlo?')">
                            <span>X</span>
                        </button>
                        <a class="btn btn-md btn-info" href="{{ route('involucrado.index', [$inv->id, $post->id] ) }}">
                            <i class="fa fa-edit"></i>
                        </a>
                    </form>
                </div>
            </div>
            </div>
            <hr>
                @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-md-12">
            <div class="box box-primary collapsed-box">
                <div class="box-header">
                    <h3 class="box-title">
                        Heridos/Fallecidos
                        <small></small>
                    </h3>
                    <!-- tools box -->
                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-primary btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /. tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body pad" style="">
                    @foreach ($post->involucrados as $inv)
                    @if($inv->aprehendido == '0')
                    <div class="row">
                            <div class="form-group col-md-3">
                                <label for="">Nombre</label>
                                <input type="text" class="form-control" disabled value="{{$inv->name}}">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">DPI</label>
                                <input type="number" class="form-control" disabled value="{{$inv->dpi}}">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="">Género</label>
                                <input type="text" class="form-control" disabled value="{{$inv->gender}}">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="">Edad</label>
                                <input type="number" class="form-control" disabled value="{{$inv->age}}">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="">Fallecido/Herido</label>
                                @if($inv->fallecido == 1)
                                <input type="text" class="form-control" disabled value="Fallecido">
                                @else
                                <input type="text" class="form-control" disabled value="Herido">
                                @endif
                            </div>
                        </div>
                        <div class="row">

                            <div class="form-group col-md-4">
                                <label for="">Tatuajes</label>
                            <textarea name="tattoosherido" id="tattoosherido" class="form-control" cols="30" rows="2" disabled>{{ $inv->tattoos }}</textarea>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="">Alias</label>
                                <input type="text" class="form-control" disabled value="{{$inv->alias}}">
                            </div>

                            <div class="form-group col-md-2">
                                <label for="gang">Mara</label>
                                <input type="text" class="form-control" disabled value="{{optional($inv->mara)->name}}">
                            </div>

                            <div class="col-md-3 form-group">
                                <label for="">Abordo:</label>
                                <input type="text" class="form-control" disabled value="{{ optional($inv->movil)->tipo}}">
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="">Heridas:</label>
                                    <textarea cols="30" rows="4" class="form-control" disabled>{{$inv->heridas}}</textarea>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Motivo:</label>
                                    <textarea cols="30" rows="4" class="form-control" disabled>{{$inv->motivo}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="">Diagnostico</label>
                                    <textarea cols="30" rows="4" class="form-control" disabled>{{$inv->diagnostico}}</textarea>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Observaciones</label>
                                    <textarea cols="30" rows="4" class="form-control" disabled>{{$inv->observaciones}}</textarea>
                                </div>
                    <div class="form-group col-md-2">
                        <br>
                        <form action=" {{ route('admin.involucrados.destroy', [$inv->id, $post->id] )}} " method="post" style="padding-right: 0px !important;">
                                @csrf @method('DELETE')
                                <div class="btn-group">
                            <button class="btn btn-md btn-danger"  onclick="return confirm('¿Está seguro de querer eliminarlo?')">
                                <span>X</span>
                            </button>
                            <a class="btn btn-md btn-info" href="{{ route('involucrado.index', [$inv->id, $post->id] ) }}">
                                <i class="fa fa-edit"></i>
                            </a>
                        </form>
                    </div>
                </div>
                </div>
                <hr>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>

    @endif
 
    <form action={{ route( 'admin.posts.update', $post)}} method="POST">
        @csrf @method('PUT')
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

            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">
                        Nueva novedad
                        <small>llene todos los campos</small>
                    </h3>
                    <!-- tools box -->
                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-primary btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /. tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body pad" style="">
                    <div class="form-group {{$errors->has('title') ? 'has-error' : ''}}">
                        <label for="">Titulo del reporte</label>
                        <input type="text" class="form-control" placeholder="Ingrese aquí el titulo del reporte" id="title" name="title" value="{{ old('title', $post->title)}}"> {!! $errors->first('title', '
                        <span class="help-block">:message</span>') !!}

                    </div>

                    <div class="form-group {{$errors->has('body') ? 'has-error' : ''}}">
                        <label for="">Contenido del reporte</label>
                        <textarea name="body" id="editor" class="form-control" rows="10" placeholder="Detalle aquí el reporte">{{ old('body', $post->body ? $post->body : $post->plantilla )}}</textarea>
                        {!! $errors->first('body', '
                        <span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="btn-group col-md-offset-1">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Añadir aprehendidos</button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#vehiculoModal" {{ optional($post->vehiculo)->count() ? 'disabled' : '' }}>Registrar vehiculo</button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#armaModal" {{ optional($post->arma)->count() ? 'disabled' : '' }}>Registrar arma</button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#heridosModal">Registrar heridos/fallecidos</button>
                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="form-group {{$errors->has('oficio') ? 'has-error' : ''}}">
                        <label>Oficio: </label>
                        <div class="input-group">
                            <div class="input-group-addon">
                            <i class="fa fa-laptop"></i>
                            </div>
                            <input type="text" class="form-control" data-inputmask="&quot;mask&quot;: &quot;9999-9999&quot;" data-mask="" name="oficio" value="{{ old('oficio', $post->oficio ? $post->oficio : '') }}">
                        </div>
                      <!-- /.input group -->
                    </div>

                    <div class="form-group {{$errors->has('guardia') ? 'has-error' : ''}}">
                        <label>Guardia:</label>
                        <select name="guardia"  class="form-control multiple" id="guardia">
                            <option value="A">A</option>
                            <option value="B">B</option>
                        </select>
                    </div>

                    <div class="form-group {{$errors->has('aldea') ? 'has-error' : ''}}">
                        <label for="">Seleccione el aldea</label>
                        <select name="aldea" id="aldea" class="form-control select2">
                            <option value="">Seleccione el aldea</option>
                            @if($post->address!=null) 
                            @foreach ($aldeas as $aldea)
                            <option value="{{ $aldea->id}}" {{ old( 'aldea', $post->address->aldea->id) == $aldea->id ? 'selected' : '' }} >{{ $aldea->name }}</option>
                            @endforeach 
                            @else 
                            @foreach ($aldeas as $aldea)
                            <option value="{{ $aldea->id}}" {{ old( 'aldea')==$aldea->id ? 'selected' : '' }} >{{ $aldea->name }}</option>
                            @endforeach 
                            @endif
                        </select>
                    </div>

                    <div class="form-group {{$errors->has('address_id') ? 'has-error' : ''}}">
                        <label>Dirección del suceso</label>
                        <input name="address_id" type="text" class="form-control" id="address_id" value="{{ old('address_id', $post->address_id ? $post->address()->pluck('name')->implode('') : '') }}">
                        <!-- /.input group -->
                    </div>
                    <div class="form-group {{$errors->has('published_at') ? 'has-error' : ''}}">
                        <label>Fecha de suceso</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            {{-- {{dd($post->published_at->format('d-m-Y'))}} --}}
                            <input name="published_at" type="text" class="form-control pull-right" id="datepicker" value="{{ old('published_at', $post->published_at ? $post->published_at->format('d-m-Y') : '') }}">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="bootstrap-timepicker">
                        <div class="form-group {{$errors->has('time') ? 'has-error' : ''}}">
                            <label>Hora del suceso:</label>

                            <div class="input-group">
                                <input type="text" name="time" class="form-control timepicker" value="{{ old('time', $post->time ?  date(" g:i a
                                    ", strtotime($post->time)): '') }}">

                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                    </div>

                    <div class="form-group {{$errors->has('category') ? 'has-error' : ''}}">
                        <label for="">Categoria</label>
                        <select name="category" id="category" class="form-control select2" data-placeholder="Elija la categoria" style="width: 100%;">
                            <option value="">Seleccione una opcion</option>
                            <option value="1">Hecho negativo</option>
                            <option value="2">Hecho positivo</option>
                        </select>
                    </div>

                    <div class="form-group {{$errors->has('tag_id') ? 'has-error' : ''}}">
                        <label for="">Etiqueta</label>
                        <select name="tag_id" id="tag_id" class="form-control select2" data-placeholder="Elija la etiqueta" style="width: 100%;">
                            @foreach($tags as $tag)
                            <option {{ collect(old( 'tag_id', optional($post->tag_id)))->contains($tag->id) ? 'selected' : '' }} value="{{ $tag->id }}">{{ $tag->name }}</option> 
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group {{$errors->has('modus_operandi_id') ? 'has-error' : ''}}">
                        <label for="">Modus operandi: </label>
                        <select name="modus_operandi_id" id="modus_operandi_id" class="form-control tags" data-placeholder="Elija una opcion" style="width: 100%;">
                            <option value="">Seleccione una opcion</option>
                            @foreach($modus as $mod)
                            <option {{ collect(old( 'modus_operandi_id', optional($post->modus_operandi_id)))->contains($mod->id) ? 'selected' : '' }} value="{{ $mod->id }}">{{ $mod->name }}</option> 
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group {{$errors->has('typology_id') ? 'has-error' : ''}}">
                        <label for="">Tipologia: </label>
                        <select name="typology_id" id="typology_id" class="form-control tags" data-placeholder="Elija una opcion" style="width: 100%;">
                            <option value="">Seleccione una opcion</option>
                            @foreach($typology as $typo)
                            <option {{ collect(old( 'typology_id', optional($post->typology_id)))->contains($typo->id) ? 'selected' : '' }} value="{{ $typo->id }}">{{ $typo->name }}</option> 
                            @endforeach
                        </select>
                    </div>
        
                    <div class="form-group">
                        <div class="form-group {{$errors->has('denunciante') ? 'has-error' : ''}}">
                            <label>Denunciante:</label>
                            <input name="denunciante" placeholder="Nombre del denunciante o afectado" type="text" class="form-control" id="denunciante" value="{{ old('denunciante', $post->denunciante ? $post->denunciante : '') }}">
                            <!-- /.input group -->
                        </div>
                    </div>
                    
                    <div class="form-group">
                            <label for="">Unidades que proceden</label>
                            <select name="unidades[]" class="form-control multiple" id="unidades" multiple="multiple">
                                <option value="">Seleccione una opcion</option>
                                @foreach($unidades as $unidad)
                                    <option {{ collect(old( 'unidades', optional($unidad->procesos)->pluck('id')))->contains($post->id) ? 'selected' : '' }} value="{{ $unidad->placa }}">{{ $unidad->placa }}</option> 
                                @endforeach
                            </select>
                    </div>

                    <div class="form-group">
                        <label for="">Jefe de turno</label>
                        <select name="jefe_de_turno_id" class="form-control select2" id="jefe_de_turno_id">
                            <option value="">Seleccione una opcion</option>
                            @foreach($users as $user)
                                <option {{ collect(old( 'jefe_de_turno_id', optional($post->jefe_de_turno_id)))->contains($user->id) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->codigo }} / {{$user->name}}</option> 
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                            <label for="">Agentes que proceden</label>
                            <select name="agentes[]" class="form-control select2" id="agentes" multiple="multiple">
                                <option value="">Seleccione una opcion</option>
                                @foreach($users as $user)
                                    <option {{ collect(old( 'agentes', optional($user->procesos)->pluck('id')))->contains($post->id) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->codigo }} / {{$user->name}}</option> 
                                @endforeach
                            </select>
                    </div>

                    <div class="form-group">
                        <label for="">Juzgado </label>
                        <select name="juzgado" class="form-control select2" id="juzgado">
                            <option value="">Seleccione una opcion</option>
                            <option {{ collect(old( 'juzgado', optional($post->juzgado)))->contains('Juzgado de paz') ? 'selected' : '' }} value="Juzgado de paz">Juzgado de paz</option>
                            <option {{ collect(old( 'juzgado', optional($post->juzgado)))->contains('Juzgado de primera instancia') ? 'selected' : '' }} value="Juzgado de primera instancia">Juzgado de Primera instancia</option>
                            <option {{ collect(old( 'juzgado', optional($post->juzgado)))->contains('MP') ? 'selected' : '' }} value="Juzgado de MP">MP</option>
                        </select>
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
    

        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Involucrados</h4>
                    </div>
                    <div class="modal-body" style="overflow:hidden;">
                        <div class="box-body pad" style="" id='dinamico'>
                            <div id="conjunto">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="">Nombre</label>
                                        <input type="text" class="form-control" placeholder="Nombre completo" name="involucrados[]">

                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="">DPI (opcional)</label>
                                        <input type="number" class="form-control" placeholder="" id="dpi" name="dpi[]">

                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="">Género</label>
                                        <select type="text" class="form-control" placeholder="Nombre completo" id="genero" name="genero[]">
                                            <option value="M" selected>M</option>
                                            <option value="F">F</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="">Edad</label>
                                        <input name="age[]" type="number" class="form-control">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Delito/Falta menor: </label>
                                        <select name="offense_id[]" id="offense_id" class="form-control tags" style="width:100%;">
                                            <option value="Seleccione una opcion"></option>
                                            @foreach($offense as $off)
                                                <option value="{{$off->name}}">{{$off->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="form-group col-md-4">
                                        <label for="">Tatuajes</label>
                                        <textarea name="tattoos[]" id="tattoos[]" class="form-control" cols="30" rows="2"></textarea>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="">Alias</label>
                                        <input type="text" name="alias[]" class="form-control">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="gang">Mara</label>
                                        <select name="gang[]" id="gang" class="form-control tags">
                                            <option value="0">Seleccione</option>
                                            @foreach($gangs as $gang)
                                            <option value="{{ $gang->name }}">{{ $gang->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button class="btn btn-success" type="button" name='otro' id='otro'>
                                <span>
                                    <i class="fa fa-plus"></i>
                                </span>
                            </button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </form>



    <div id="heridosModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Heridos/Fallecidos</h4>
                    </div>
                    <div class="modal-body" style="overflow:hidden;">
                        <div class="box-body pad">
                                        <div class="row">
                                        <form action="{{route('admin.involucrados.fallecidos')}}" method="POST" id="heridoform">
                                            @csrf
                                            <input type="hidden" value="{{$post->id}}" name="post">
                                            <div class="form-group col-md-3">
                                                <label for="">Nombre</label>
                                                <input type="text" class="form-control" placeholder="Nombre completo" name="herido">
        
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="">DPI (opcional)</label>
                                                <input type="number" class="form-control" placeholder="" id="dpiherido" name="dpiherido">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="">Género</label>
                                                <select type="text" class="form-control" placeholder="Nombre completo" id="generoherido" name="generoherido">
                                                    <option value="M" selected>M</option>
                                                    <option value="F">F</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="">Edad</label>
                                                <input name="ageherido" type="number" class="form-control">
                                            </div>
                                            <div class="form-group col-md-2">
                                                    <label for="">Herido o Fallecido:</label>
                                                    <select class="form-control" id="herofall" name="herofall">
                                                        <option value="0" selected>Herido</option>
                                                        <option value="1">Fallecido</option>
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="row">
        
                                            <div class="form-group col-md-4">
                                                <label for="">Tatuajes</label>
                                                <textarea name="tattoosherido" id="tattoosherido" class="form-control" cols="30" rows="2"></textarea>
                                            </div>
        
                                            <div class="form-group col-md-3">
                                                <label for="">Alias</label>
                                                <input type="text" name="aliasherido" class="form-control">
                                            </div>
        
                                            <div class="form-group col-md-2">
                                                <label for="gang">Mara</label>
                                                <select name="gangherido" id="gangherido" class="form-control tags">
                                                    <option value="0">Seleccione</option>
                                                    @foreach($gangs as $gang)
                                                    <option value="{{ $gang->name }}">{{ $gang->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-3 form-group">
                                                <label for="">Abordo:</label>
                                                <select name="abordo" id="abordo" class="form-control tags">
                                                    <br>
                                                    <option value="">Seleccione una opcion</option>
                                                    @foreach($typeV as $mov)
                                                    <option value="{{ $mov->id }}">{{$mov->tipo}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label for="">Heridas:</label>
                                                    <textarea name="heridas" id="heridas" cols="30" rows="4" class="form-control"></textarea>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="">Motivo:</label>
                                                    <textarea name="motivo" id="motivo" cols="30" rows="4" class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label for="">Diagnostico</label>
                                                    <textarea name="diagnostico" id="diagnostico" cols="30" rows="4" class="form-control"></textarea>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="">Observaciones</label>
                                                    <textarea name="observaciones" id="observaciones" cols="30" rows="4" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i></button>
                    </form>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div id="vehiculoModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">
    
                    <!-- Modal content-->
                    <div class="modal-content">
    
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Vehiculo</h4>
                        </div>
                        <div class="modal-body" style="overflow:hidden;">
                            <div class="box-body pad">
                                <div class="row">
                                    <form action="{{route('admin.vehiculo.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="post" value="{{$post->id}}">
                                    <div class="col-md-2 form-group">
                                        <label for="">Tipo:</label>
                                        <br>
                                        <select name="type_id" id="type_id" class="form-cotrol tags" required>
                                            <option value="">Seleccione el tipo de vehiculo</option>
                                            @foreach($typeV as $mov)
                                                <option value="{{$mov->id}}">{{$mov->tipo}}</option>
                                            @endforeach
                                        </select>
                                    </div> 
                                    <div class="col-md-2 form-group">
                                        <label for="">Marca:</label>
                                        <br>
                                        <select name="marca_id" id="marca_id" class="tags form-control" required>
                                            <option value="">Seleccione marca</option>
                                            @foreach($marcaV as $mar)
                                             <option value="{{$mar->id}}">{{$mar->name}}</option>   
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label for="">Linea:</label>
                                        <br>
                                        <input type="text" name="linea" class="form-control" placeholder="Ingrese linea" value="IGN">
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label for="">Color:</label>
                                        <br>
                                        <input type="text" name="color" class="form-control" value="IGN" placeholder="Ingrese color">
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label for="">Placa:</label>
                                        <input type="text" name="placa" class="form-control" value="IGN" placeholder="Placa">
                                    </div>
                                    <div class="col-md-2 form-group">
                                    <label for="">Modelo</label>
                                    <input type="number" name="modelo" class="form-control" placeholder="1998">
                                    </div>                                    
                                </div>
                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>

            <div id="armaModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">
    
                    <!-- Modal content-->
                    <div class="modal-content">
    
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Arma</h4>
                        </div>
                        <div class="modal-body" style="overflow:hidden;">
                            <div class="box-body pad">
                                <div class="row">
                                    <form action="{{route('admin.arma.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="post" value="{{$post->id}}">
                                    <div class="col-md-3 form-group">
                                        <label for="">Tipo:</label>
                                        <br>
                                        <select name="type_id" id="type_id" class="form-cotrol tags" required>
                                            <option value="">Seleccione el tipo de arma</option>
                                            @foreach($typeA as $mov)
                                                <option value="{{$mov->name}}">{{$mov->tipo}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="">Marca:</label>
                                        <br>
                                        <select name="marca_id" id="marca_id" class="tags form-control" required>
                                            <option value="">Seleccione marca</option>
                                            @foreach($marcaA as $mar)
                                             <option value="{{$mar->name}}">{{$mar->name}}</option>   
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label for="">Calibre:</label>
                                        <br>
                                        <input type="text" name="calibre" class="form-control" placeholder="Ingrese calibre">
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label for="">Registro:</label>
                                        <input type="text" name="registro" class="form-control" placeholder="Registro">
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label for="">Licencia</label>
                                        <input type="text" name="licencia" class="form-control" placeholder="Licencia">
                                    </div>                                    
                                </div>
                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>

    @endsection @push('styles')
    <link rel="stylesheet" href={{asset("/css/dropzone.css")}}>
    <link rel="stylesheet" href={{asset("/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css")}}>
    <link rel="stylesheet" href={{asset("/adminlte/bower_components/select2/dist/css/select2.min.css")}}>
    <link rel="stylesheet" href={{asset("/adminlte/plugins/timepicker/bootstrap-timepicker.min.css")}}> @endpush 
    @push('scripts')
    <script src={{asset("/js/dropzone.min.js")}}></script>
    <script src={{asset("/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js")}}></script>
    <script src={{asset("/adminlte/bower_components/ckeditor/ckeditor.js")}}></script>
    <script src={{asset("/adminlte/plugins/timepicker/bootstrap-timepicker.min.js")}}></script>
    <script src={{asset("/adminlte/bower_components/select2/dist/js/select2.full.min.js")}}></script>
    <script src="/adminlte/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="/adminlte/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="/adminlte/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    
    <script>
        function cambio(selectObject) {
            var value = selectObject.value;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                type: "POST",
                url: '/admin/plantilla',
                data: {
                    plantilla: value
                },
                success: function (data) {
                    CKEDITOR.instances.editor.setData(data.body);
                }
            })
        };

      

        $('#datepicker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        });

        CKEDITOR.replace('editor');
        $('.select2').select2({
            tags: true,
            createTag: function (params) {
                return undefined;
            }
        });

        $('.tags').select2({
            tags: true,
            // width: 200
        })

        $('#gang').select2({
            tags: true,
            width: 100
        });

        $('#tattoos').select2({
            tags: true,
            placeholder: 'Ingrese tatuajes',
            width: 280
        });

        $('.multiple').select2({
            tags: true
        })
       
        $('[data-mask]').inputmask()


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
            removedFile: function (file) {
                console.log(file.value);
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }

        });
     
        Dropzone.options.myDropzone = {
            resizeWidth : 100,
            resizeHeight : 100
        }

        myDropzone.on('error', function (fle, res) {
            var msg = res.errors.photo[0];
            $('.dz-error-message:last > span').text(msg);
        });
    </script>

    <script>
        $(document).ready(function () {
            var i = 1;
            $('#otro').click(function () {
                i++;
                $('#dinamico').append("<div id='conjunto"+i+"'><div class='row'><div class='form-group col-md-4'><label for=''>Nombre</label><input type='text' class='form-control' placeholder='Nombre completo' name='involucrados[]'></div><div class='form-group col-md-4'> <label for=''>DPI (opcional)</label> <input type='number' class='form-control' placeholder='' id='dpi' name='dpi[]'> </div> <div class='form-group col-md-2'> <label for=''>Género</label> <select type='text' class='form-control' placeholder='Nombre completo' id='genero' name='genero[]'> <option value='M'>M</option> <option value='F'>F</option> </select></div> <div class='form-group col-md-2'> <label for=''>Edad</label> <input type='number' name='age[]' class='form-control'> </div> </div> <div class='row'> <div class='form-group col-md-4'> <label for=''>Tatuajes</label> <textarea name='tattoos[]' id='tattoos[]' class='form-control' cols='30' rows='2'></textarea> </div> <div class='form-group col-md-3'> <label for=''>Alias</label> <input type='text' name='alias[]' class='form-control'> </div> <div class='form-group col-md-2'> <label for='gang'>Mara</label> <select name='gang[]' id='gang' class='form-control new-select2'> @foreach($gangs as $gang) <option value='{{ $gang->name }}'>{{ $gang->name }}</option> @endforeach </select> </div> <div class='form-group col-md-1'> <label for=''>Quitar</label><button class='form-control btn btn-danger btn_remove' type='button' name='remove' id='"+i+"'><span><i class='fa fa-minus'></i></span></button></div></div>");
                $('.new-select2').select2({
                    tags: true
                });
            });
            $(document).on('click', '.btn_remove', function () {
                var button_id = $(this).attr('id');
                $('#conjunto' + button_id).remove();
            });

        $('#category').change( function() {
        var id = $('#category').val();
        $('#tag_id').empty()
        $.ajax({
            url: `/admin/subcategoria/${id}`,
            type: "GET",
            dataType: "json",
            success: data => {
                data.tags.forEach(tag =>
                    $('#tag_id').append(`<option value="${tag.id}">${tag.name}</option>`)
                )
            }
        })
    })
        });
    </script>
    <script>
        // $(document).ready(function(){
        //     $('#category_id').change(function() {
        //         console.log('cambio');
        //     $('#subcategy_id').empty();
        //     var id = $('#category_id').val();
        //      $('#subcategory_id').html('<option value=''>Seleccione subcategoria</option>');
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