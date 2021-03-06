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
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Positivas</h3>
                <br>
                <button class="printMe"><span class="fa fa-fw fa-print"></span></button>
                <div class="box-tools pull-right">
                   <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                   </button>
                   <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                 </div>
            </div>
            <div class="box-body">
                <div class="chart" id="barrasP">
                    <canvas id="mycanvasP" class="mycanvasP" width="1300" height="400"></canvas>
                    <img src="" id="canvasIMG" alt="">
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Negativas</h3>
                <div class="box-tools pull-right">
                   <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                   </button>
                   <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                 </div>
            </div>
            <div class="box-body">
                <div class="chart barrasN" id="barrasN">
                    <canvas id="mycanvasN" width="1300" height="400"></canvas>
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
<link rel="stylesheet" href="{{asset("/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css")}}">
@endpush

@push('scripts')
<script src="{{asset('/js/Chart.min.js')}}"></script>
{{-- <script src="/adminlte/bower_components/chart.js/Chart.js"></script> --}}
<script src="{{asset('/adminlte/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="/js/jQuery.print.min.js"></script>
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
        url: (window.location.pathname == '/admin/estadisticas/tag') ? '/admin/estadisticas/total' : '/admin/estadisticas/totalcat',
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
        url: (window.location.pathname == '/admin/estadisticas/tag') ? '/admin/estadisticas/total' : '/admin/estadisticas/totalcat',
		method: "GET",
        dataType: 'json',
		success: function(data) {
			var etiquetaP = [];
			var scoreP = [];
            var coloRP = [];

            var etiquetaN = [];
			var scoreN = [];
            var coloRN = [];

            var dynamicColors = function() {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            return "rgba(" + r + "," + g + "," + b + "," + "0.4)";
            };
            if( typeof dataF === 'undefined' )
            {
             //ciclo positivo   
			for(var i in data.tagsP) {
				etiquetaP.push("Etiqueta: " + data.tagsP[i].name);
				scoreP.push(data.tagsP[i].cantidad);
                coloRP.push(dynamicColors());
			}

            //ciclo negativo
            for(var i in data.tagsN) {
				etiquetaN.push("Etiqueta: " + data.tagsN[i].name);
				scoreN.push(data.tagsN[i].cantidad);
                coloRN.push(dynamicColors());
			}

            }
            else{
                //POSITIVAS
                for(var i in dataF.tagsP) {
				etiquetaP.push("Etiqueta: " + dataF.tagsP[i].name);
				scoreP.push(dataF.tagsP[i].cantidad);
                coloRP.push(dynamicColors());
			}
                //NEGATIVAS
            for(var i in dataF.tagsN) {
				etiquetaN.push("Etiqueta: " + dataF.tagsN[i].name);
				scoreN.push(dataF.tagsN[i].cantidad);
                coloRN.push(dynamicColors());
			}

            }

			var chartdataP = {
				labels: etiquetaP,
				datasets : [
					{
						label: 'Cantidad de ocurrencias',
						backgroundColor:  coloRP,
						borderColor:  'rgba(255,99,132,1)',
						hoverBackgroundColor: 'rgba(64, 90, 118, 0.9)',
						hoverBorderColor: 'rgba(255,99,132,1)',
						data: scoreP
					}
				]
			};

            var chartdataN = {
				labels: etiquetaN,
				datasets : [
					{
						label: 'Cantidad de ocurrencias',
						backgroundColor:  coloRN,
						borderColor:  'rgba(255,99,132,1)',
						hoverBackgroundColor: 'rgba(64, 90, 118, 0.9)',
						hoverBorderColor: 'rgba(255,99,132,1)',
						data: scoreN
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

			var ctx = $("#mycanvasP");
            var ctxn = $("#mycanvasN");

			var barGraph = new Chart(ctx, {
				type: 'bar',
				data: chartdataP,
                options:option
			});
            var barGraph = new Chart(ctxn, {
				type: 'bar',
				data: chartdataN,
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
 $( "#mycanvasP" ).remove();
 $( "#mycanvasN" ).remove();
 var txt1 = "<canvas id='mycanvasP'  width='1300' height='400'></canvas>";
 var txt2 = "<canvas id='mycanvasN'  width='1300' height='400'></canvas>";    
 $("#barrasP").append(txt1); 
 $("#barrasN").append(txt2); 
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

    <script>
        $('.printMe').click(function(){
            var canvas = document.getElementById('mycanvasP');
            var dataURL = canvas.toDataURL();
            document.getElementById('canvasIMG').src = dataURL;
            $('#canvasIMG').print();
        });
    </script>
@endpush