@extends('admin.layout')

@section('header')
<h1>
   TABLA
    <small>PERMISOS PNC</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard')}}"><i class="fa fa-home"></i> Inicio </a></li>
    <li class="active"><a href="{{ route('admin.permissions.index')}}">Permisos</a></li>
  </ol>
@endsection


@section('content')
<div class="box box-primary">
    <div class="box-header">
      <h3 class="box-title">lISTADO DE USUARIOS</h3>
      {{-- <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Crear Role </a> --}}
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <input type="text" id="myInput" class="form-control" placeholder="Buscar..." >
      <table id="permisos-table" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>ID</th>
          <th>Identificador</th>
          <th>Nombre</th>
          <th>Acciones</th>
        </tr>
        </thead>
        <tbody id="miTabla">
            @foreach ($permissions as $permission)
            <tr>
                <td>{{ $permission->id }}</td>
                <td>{{$permission->name}}</td>
                <td>{{$permission->display_name}}</td>
                <td>
                    <a href="{{ route('admin.permissions.edit', $permission)}}" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
       
      </table>
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
      $('#permisos-table').DataTable({
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

