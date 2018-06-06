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
<canvas id="mycanvas" width="1300" height="600"></canvas>
@endsection

@push('styles')
<link rel="stylesheet" href="/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css">
@endpush

@push('scripts')
<script src="/js/Chart.min.js"></script>
<script src="/adminlte/bower_components/moment/min/moment.min.js"></script>
<script src="/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script>
    $('#reservation').daterangepicker()
   $(document).ready(function(){
       inicio();
});

function inicio(dataF){
    $.ajax({
		url: "/admin/estadisticas/total",
		method: "GET",
		success: function(data) {
			console.log(data);
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
			for(var i in data) {
				player.push("Etiqueta " + data[i].name);
				score.push(data[i].cantidad);
                coloR.push(dynamicColors());
			}
                
            }
            else{
                for(var i in data) {
				player.push("Etiqueta " + data[i].name);
				score.push(data[i].cantidad);
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

 // Get some values from elements on the page:
 var $form = $( this ),
   term = $form.find( "input[name='reservation']" ).val(),
   url = $form.attr( "action" );

 // Send the data using post
 var posting = $.post( url, 
    {
    fecha: term,
    "_token": "{{ csrf_token() }}", 
    });

 // Put the results in a div
 posting.done(function( dataF ) {
     console.log(dataF);
     inicio(dataF);
//    var content = $( data ).find( "#content" );
//    $( "#result" ).empty().append( content );
 });
});


    </script>
@endpush