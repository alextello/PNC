@extends('admin.layout')

@section('content')
<form action="{{route('admin.estadisticas.fecha')}}" id="searchForm" method="POST">
    @csrf
    <label>Rango de fecha:</label>
    <div class="form-group">
        
        <div class="col-md-6">
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" name="reservation" id="reservation">
            </div>
        </div>
        <div class="col-md-6">
            <button class="btn btn-primary btn-block" id="buscar">Buscar</button>
        </div>
        </div>
    </form>
    <br>
    <div class="col-md-6 form-group">
        <div class="btn-group" role="group">
            <a href="{{ route('admin.estadisticas.tabla') }}" target="_blank" class="btn btn-primary">Ver tabla</a>
        </div>
    </div>

    <label class="col-lg-10" id="fechas" for="">Estadistica historica a partir del 2019</label>
    <div id='canvas'>
        <canvas id="mycanvas" width="1300" height="600"></canvas>
    </div>
@endsection

@push('styles')
<link rel="stylesheet" href="/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css">
@endpush

@push('scripts')
<script src="/js/Chart.min.js"></script>
<script src="/adminlte/bower_components/moment/min/moment.min.js"></script>
<script src="/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script>
    $('#reservation').daterangepicker({
        'startDate': '01/01/2019',
        'endDate': '02/01/2019',
        locale: {
      format: 'D/M/YYYY'
    }
    });
   $(document).ready(function(){
     inicio();
});



function inicio(dataF){
    $.ajax({
        url: (window.location.pathname == '/admin/estadisticas/tag') ? '/admin/estadisticas/total' : '/admin/estadisticas/totalcat',
		method: "GET",
        dataType: 'json',
		success: function(data) {
			var player = [];
			var score = [];
            var coloR = [];

            var dynamicColors = function() {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            return "rgba(" + r + "," + g + "," + b + "," + "0.4)";
            };
            if( typeof dataF === 'undefined' )
            {
                console.log('No entra F');
			for(var i in data) {
				player.push("Etiqueta: " + data[i].name);
				score.push(data[i].cantidad);
                coloR.push(dynamicColors());
			}
                
            }
            else{
                console.log('si F');
                for(var i in dataF.tags) {
				player.push("Etiqueta: " + dataF.tags[i].name);
				score.push(dataF.tags[i].cantidad);
                coloR.push(dynamicColors());
			}
            }

			var chartdata = {
				labels: player,
				datasets : [
					{
						label: 'Cantidad de ocurrencias',
						backgroundColor:  coloR,
						borderColor:  'rgba(255,99,132,1)',
						hoverBackgroundColor: 'rgba(64, 90, 118, 0.9)',
						hoverBorderColor: 'rgba(255,99,132,1)',
						data: score
					}
				]
			};

            var option = {
	scales: {
  	yAxes:[{
    		stacked:true,
        gridLines: {
        	display:true,
          color:"rgba(255,99,132,0.2)"
        },
        ticks: {
                min: 0,
                stepSize: 1
            }
    }],
    xAxes:[{
    		gridLines: {
        	display:false
        }
    }]
  },
  responsive:true
};

			var ctx = $("#mycanvas");

			var barGraph = new Chart(ctx, {
				type: 'bar',
				data: chartdata,
                options:option
			});
		},
		error: function(data) {
			console.log(data);
		}
	});
}

$( "#searchForm" ).submit(function( event ) {
 
 // Stop form from submitting normally
 event.preventDefault();
 $( "#mycanvas" ).remove();
 var txt1 = "<canvas id='mycanvas' width='1300' height='600'></canvas>";  
 $("#canvas").append(txt1); 
 // Get some values from elements on the page:
 var $form = $( this ),
   term = $form.find( "input[name='reservation']" ).val();
  // url = $form.attr( "action" );

 // Send the data using post
 console.log(window.location.pathname);
 var posting = $.post( window.location.path, 
    {
    fecha: term,
    "_token": "{{ csrf_token() }}", 
    });
 
 

 // Put the results in a div
 posting.done(function( dataF ) {
     var date = $("#reservation").val().split("-")
     $("#fechas").text('Estadistica del ' + date[0] + 'al ' + date[1] );
     inicio(dataF);

 });
});


    </script>
@endpush