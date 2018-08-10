@extends('admin.layout')

@section('header')
<h1>
   TABLA
    <small>ROLES PNC</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard')}}"><i class="fa fa-home"></i> Inicio </a></li>
    <li class="active"><a href="{{ route('admin.roles.index')}}">Roles</a></li>
  </ol>
@endsection


@section('content')
<div class="box box-primary">
    <div class="box-header">
      <h3 class="box-title">lISTADO DE USUARIOS</h3>
      <a href="{{ route('admin.roles.create') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Crear Role </a>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <input type="text" id="myInput" class="form-control" placeholder="Buscar..." >
      <table id="roles-table" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Identificador</th>
          <th>Permisos</th>
          <th>Acciones</th>
        </tr>
        </thead>
        <tbody id="miTabla">
            @foreach ($roles as $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{$role->name}}</td>
                <td>{{$role->display_name}}</td>
                <td>{{$role->permissions->pluck('name')->implode(', ') }}</td>
                <td>
                    <a href="{{ route('admin.roles.edit', $role)}}" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                    @if($role->id != 1) 
                    <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" style="display: inline">
                       @csrf
                       @method('DELETE')
                       <button class="btn btn-xs btn-danger" onclick="return confirm('¿Está seguro de querer eliminar este usuario?')"><i class="fa fa-times"></i></button>
                     </form>
                     @endif
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
<link rel="stylesheet" type="text/css" href="{{asset("/DataTables/datatables.min.css")}}"/>
@endpush

@push('scripts')
<script type="text/javascript" src="{{asset("/DataTables/datatables.min.js")}}"></script>

<script>
    $(function () {
      $('#roles-table').DataTable({
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

