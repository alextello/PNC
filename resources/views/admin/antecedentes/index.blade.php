@extends('admin.layout')

@section('content')

<div class="box">
    <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">lISTADO DE ANTECEDENTES</h3>
          {{-- <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Crear publicacion</button> --}}
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          {{-- <input type="text" id="myInput" class="form-control" placeholder="Buscar..." > --}}
          <table id="posts-table" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>DPI</th>
              <th>Nombre</th>
              <th>Genero</th>
              <th>Cantidad de novedades</th>
              <th>Ver</th>
            </tr>
            </thead>
            <tbody id="miTabla">
                @foreach($inv as $i)
                <tr>
                    <td>{{ $i->dpi }}</td>
                    <td>{{ $i->name }}</td>
                    <td>{{ $i->gender  }}</td>
                    <td>{{ $i->posts->count() }}</td>
                    <td><a class="btn btn-xs btn-info" target="_blank" href="{{ route('admin.antecedentes.posts', $i->id) }}"><span class="fa fa-eye" ></span></a></td>
                </tr>
                @endforeach
            </tbody>
           
          </table>
        </div>
        <!-- /.box-body -->
      </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endpush

@push('scripts')
<script src="/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script>
    $(function () {
      $('#posts-table').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true
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