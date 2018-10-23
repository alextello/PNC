@extends('admin.layout')

@section('content')


  <form action="{{route('hechosnegativos.post')}}" class="form-inline" method="POST">
    @csrf
      <input type="text" id="Buscar" name="Buscar" class="form-control" placeholder="Ingrese el año que desea" required>
      <button class="btn btn-info form-control">Buscar</button>
  </form><br>

  <div class="box box-primary">
      <div class="box-header">
      <h3 class="box-title">LISTADO DE HECHOS NEGATIVOS AÑO {{ $t = $year ? $year : now()->year }}</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
<input type="hidden" id="year">
<table id="posts-table" class="table table-bordered table-striped">
    <thead>
    <tr>
      <th>Nombre</th>
      <th>Enero</th>
      <th>Febrero</th>
      <th>Marzo</th>
      <th>Abril</th>
      <th>Mayo</th>
      <th>Junio</th>
      <th>Julio</th>
      <th>Agosto</th>
      <th>Septiembre</th>
      <th>Octubre</th>
      <th>Noviembre</th>
      <th>Diciembre</th>
      <th>Total</th>
    </tr>
    </thead>
    <tbody id="miTabla">
     @foreach($tags as $tag)
      <tr>
        @php $i = 0; @endphp
        <td>{{$tag['name']}}</td>
        @foreach($tag['meses'] as $mes)
        <td>{{$mes}}</td>
        @php $i = $i+$mes @endphp
        @endforeach
        <td>{{$i}}</td>
      </tr>
     @endforeach
      
    </tbody>
   
  </table>
</div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset("/DataTables/datatables.min.css")}}"/>
<link rel="stylesheet" href="{{asset("/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css")}}">
@endpush

@push('scripts')
<script type="text/javascript" src="{{asset("/DataTables/datatables.min.js")}}"></script>
<script src="{{asset("/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js")}}"></script>

<script>
  $( document ).ready(function() {
    var currentTime = new Date();
    var myInput = document.getElementById("year");
    if (myInput.value != undefined){
    myInput.value = currentTime.getFullYear();
    }
    $("#Buscar").datepicker( {
    format: " yyyy", // Notice the Extra space at the beginning
    viewMode: "years", 
    minViewMode: "years"
});
});
</script>

<script>
  $(function () {
    $('#posts-table').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
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
              title: "Listado de hechos negativos año: "+$("#year").val(),
              text: "Imprimir"
          },
          'excel', 'copy', 'csv',
          {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                text: 'Exportar PDF',
                title: "Listado de hechos negativos año: "+$("#year").val()
          }
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