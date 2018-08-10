@extends('admin.layout')

@section('header')
<h1>
   TABLA
    <small>Reportes PNC</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard')}}"><i class="fa fa-home"></i> Inicio </a></li>
    <li class="active"><a href="{{ route('admin.posts.index')}}">Posts</a></li>
  </ol>
@endsection

@section('content')
<div class="box box-primary">
    <div class="box-header">
      <h3 class="box-title">lISTADO DE REPORTES</h3>
      <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Crear publicacion</button>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      {{-- <input type="text" id="myInput" class="form-control" placeholder="Buscar..." > --}}
      <table id="posts-table" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>ID</th>
          <th>Fecha</th>
          <th>Titulo</th>
          <th>Etiqueta</th>
          <th>Autor</th>
          <th>Acciones</th>
        </tr>
        </thead>
        <tbody id="miTabla">
            @foreach ($posts as $post)
            <tr>
              <td>{{ $post->id }}</td>
              <td> {{ optional($post->published_at)->format('d M y') }} </td>
                <td>{{ $post->title }}</td>
                <td>{{ optional($post->tags)->name }}</td>
                <td>{{ $post->owner->email  }}</td>
                <td>
                    <a href="{{ route('posts.show', $post)}}" class="btn btn-xs btn-default" target="_blank"><i class="fa fa-eye"></i></a>
                    <a href="{{ route('admin.posts.edit', $post)}}" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                     <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" style="display: inline">
                       @csrf
                       @method('DELETE')
                       <button class="btn btn-xs btn-danger" onclick="return confirm('¿Está seguro de querer eliminar el reporte?')"><i class="fa fa-times"></i></button>
                     </form>
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
      $('#posts-table').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true,
        "language": {
            "lengthMenu": "Display _MENU_ records per page",
            "zeroRecords": "Cero coincidencias",
            "info": "Mostrando la pagina _PAGE_ de _PAGES_",
            "infoEmpty": "Sin registros",
            "infoFiltered": "(filtrado de _MAX_ registros)"
        },
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                },
                customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '10pt' )
                        .prepend(
                            "<h1>Listado de novideades: </h1>"
                        );
                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' );
                }
            },
            'colvis', 'excel', 'pdf', 'csv', 'copy'
        ],
        columnDefs: [ {
            visible: false
        } ],
        
      });
    });
  </script>
{{-- buttons: [
  'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
] --}}
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

