@extends('admin.layout')

@section('header')
<h1>
   TABLA
    <small>PLANTILLAS PNC</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard')}}"><i class="fa fa-home"></i> Inicio </a></li>
    <li class="active"><a href="{{ route('admin.plantillas.index')}}">Plantillas</a></li>
  </ol>
@endsection

@section('content')
<div class="box box-primary">
    <div class="box-header">
      <h3 class="box-title">Pie de pagina por defecto</h3>
      {{-- <a href="{{ route('admin.plantillas.create') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Crear Plantilla </a> --}}
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <img src="{{asset('/storage/banner/footer.jpg')}}" alt="" style="height: 2.5cm; width: 100%" class="img-responsive">
    </div>
    <!-- /.box-body -->
  </div>

  <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Pie de pagina personalizado</h3>
          {{-- <a href="{{ route('admin.plantillas.create') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Crear Plantilla </a> --}}
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <img src="{{asset('/storage/'.$head->footer)}}" alt="" class="img-responsive" style="max-height: 2.5cm; max-width: 18cm; min-width: 100%" >
        </div>
        <!-- /.box-body -->
    </div>

    <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Cambiar pie de pagina</h3>
              {{-- <a href="{{ route('admin.plantillas.create') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Crear Plantilla </a> --}}
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="{{route('storage.footer')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <label for="">Seleccionar nuevo pie de pagina</label>
                    <small>dimensiones: 22cm X 2.5cm</small>
                    <input type="file"  accept="image/*" name="photo" class="form-control">
                    <button class="btn btn-info" type="submit">Guardar</button>
                </form>
            </div>
            <!-- /.box-body -->
    </div>

  <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Qué pie de pagina usar</h3>
          {{-- <a href="{{ route('admin.plantillas.create') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Crear Plantilla </a> --}}
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form action="{{route('storage.footer.default')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="radio" name="footer" {{$flag = $head->default_footer ? 'checked' : ''}} value="defecto">Por defecto<br>
                <input type="radio" name="footer" {{$flag = $head->default_footer ? '' : 'checked'}} class="" value="personalizado">Personalizado<br>
                <button class="btn btn-info" type="submit">Guardar</button>
            </form>
        </div>
        <!-- /.box-body -->
      </div>
@endsection

@push('styles')
<link rel="stylesheet" href={{asset("/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css")}}>
@endpush

@push('scripts')
<script src={{asset("/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js")}}></script>
<script src={{asset("/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js")}}></script>

<script>
    $(function () {
      $('#posts-table').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
      });
    });
  </script>

<script>
    $(document).ready(function(){
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#miTabla tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
      </script>
@endpush
