@extends('admin.layout')

@section('content')
<div class="box box-primary">
    <div class="box-body">
        <div class="box-header with-border">
            <h3>Tabla estadistica</h3><h2>{{$date->format('m-Y')}}</h2>
        </div>
        <div class="box-body">
                <table id="posts-table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>No.</th>
                          <th>Oficio</th>
                          <th>Evento</th>
                          <th>Año</th>
                          <th>Mes</th>
                          <th>Día</th>
                          <th>Fecha</th>
                          <th>Hora</th>
                          <th>Direccion</th>
                          <th>Aldea</th>
                          <th>Vehiculo tipo</th>
                          <th>Marca</th>
                          <th>Linea</th>
                          <th>Placa</th>
                          <th>Modelo</th>
                          <th>Color</th>
                          <th>Guardia</th>
                          <th>Juzgado o fiscalia</th>
                        </tr>
                        </thead>
                        <tbody id="miTabla">
                            @php $i=1; @endphp
                            @foreach ($posts as $post)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $post->oficio }}</td>
                                <td>{{ $tag->name }}</td>
                                <td> {{ $post->published_at->format('Y') }} </td>
                                <td>{{  $post->published_at->format('F') }}</td>
                                <td>{{  $post->published_at->format('l') }} </td>
                                <td>{{  $post->published_at->format('d-m-Y') }} </td>
                                <td>{{ $post->time }}</td>
                                <td>{{ $post->address->name }}</td>
                                <td>{{ $post->address->aldea->name }}</td>
                                @if(isset($post->vehiculo))
                                <td>{{ optional($post->vehiculo->tipo)->tipo}}</td>
                                <td>{{ optional($post->vehiculo->brand)->name }}</td>
                                <td>{{ optional($post->vehiculo)->linea }}</td>
                                <td>{{ optional($post->vehiculo)->placa }}</td>
                                <td>{{ optional($post->vehiculo)->modelo }}</td>
                                <td>{{ optional($post->vehiculo)->color }}</td>
                                <td>{{$post->guardia}}</td>
                                <td>{{ $post->juzgado }}</td>
                                @else
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                @endif
                                @php $i++ @endphp
                            </tr>
                            @endforeach
                        </tbody>
                       
                      </table>
        </div>
    </div>
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
        'scrollX'     : true,
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
            'excel', 'pdf', 'csv', 'copy'
        ],language: {
            buttons: {
                copyTitle: 'Datos copiados',
                copySuccess: {
                    _: '%d Lineas copiadas',
                    1: '1 Lina copiada'
                }
            }
        },
        columnDefs: [ {
            visible: false
        } ],
        
      });
    });
  </script>
@endpush