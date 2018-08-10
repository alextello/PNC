@extends('admin.layout')

@section('content')
<form action="" id="searchForm" method="POST">
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
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Hechos positivos (Generon femenino)</h3>
                <div class="box-tools pull-right">
                   <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                   </button>
                   <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                 </div>
            </div>
            <div class="box-body">
                <div class="chart" id="barras">
                    <canvas id="mycanvas" width="1300" height="800"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Hechos Negativos (Generon femenino)</h3>
                    <div class="box-tools pull-right">
                       <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                       </button>
                       <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                     </div>
                </div>
                <div class="box-body">
                    <div class="chart" id="barras">
                        <canvas id="mycanvas" width="1300" height="800"></canvas>
                    </div>
                </div>
            </div>
        </div>
    <div class="col-md-12">
        <!-- AREA CHART -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Area Chart</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div class="chart">
              <canvas id="areaChart" width="1300" height="300"></canvas>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

      </div>
@endsection

@push('styles')
<link rel="stylesheet" href={{asset("/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css")}}>
@endpush

@push('scripts')
<script src={{asset("/js/Chart.min.js")}}></script>
{{-- <script src="/adminlte/bower_components/chart.js/Chart.js"></script> --}}
<script src={{asset("/adminlte/bower_components/moment/min/moment.min.js")}}></script>
<script src={{asset("/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js")}}></script>
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
     area();
  

});

function area(){
    $.ajax({
        url: '/admin/estadisticas/personas',
		method: "GET",
        dataType: 'json',
        success: function(data) {
            var speedCanvas = document.getElementById("areaChart");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 18;

var speedData = {
  labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
  datasets: [{
    label: "Ocurrencias por mes",
    data: [0, 59, 75, 20, 20, 55, 40, 11, 2, 9, 0, 11],
  }]
};

var chartOptions = {
  legend: {
    display: true,
    position: 'top',
    labels: {
      boxWidth: 80,
      fontColor: 'black'
    }
  }
};

var lineChart = new Chart(speedCanvas, {
  type: 'line',
  data: speedData,
  options: chartOptions
});
},
error: function(data) {
     console.log(data);
 }

    });
   
}


function inicio(dataF){
    $.ajax({
        url: '/admin/estadisticas/totalpersonas',
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
			for(var i in data.personasFP) {
				player.push("Etiqueta: " + data.personasFP[i].name);
				score.push(data.personasFP[i].cantidad);
                coloR.push(dynamicColors());
			}
                
            }
            else{
                console.log('si F');
                for(var i in dataF.tags) {
				player.push("Genero: " + dataF.tags[i].name);
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
 var txt1 = "<canvas id='mycanvas'  width='1300' height='300'></canvas>";  
 $("#barras").append(txt1); 
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