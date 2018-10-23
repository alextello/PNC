@extends('admin.layout')

@section('content')
<div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Elija las dos rangos de fecha a comparar</h3>
        </div>
        <div class="box-body">
            <form id="searchForm">
                <div class="form-group">
                    <label>Rango de fecha 1</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="rango" name="rango">
                    </div>
                    <!-- /.input group -->
                  </div>
                <div class="form-group">
                    <label>Rango de fecha 2</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="rango2" name="rango2">
                    </div>
                    <!-- /.input group -->
                  </div>
                <button class="btn btn-info" type="submit">Buscar</button>
            </form>
        </div>
        <!-- /.box-body -->
      </div>
      
      <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Hechos positivos y negativos</h3>
        
                    <div class="box-tools pull-right">
                      {{-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> --}}
                      </button>
                      {{-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> --}}
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="linechartdiv">
                      <canvas id="lineChart" style="height: 249px; width: 548px;" width="548" height="249"></canvas>
                    </div>
                  </div>
                  <!-- /.box-body -->
                 </div>
            </div>
      </div>
      <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Hechos negativos</h3>
        
                    <div class="box-tools pull-right">
                      {{-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> --}}
                      </button>
                      {{-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> --}}
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="linechartdiv2">
                      <canvas id="lineChart2" style="height: 249px; width: 548px;" width="548" height="249"></canvas>
                    </div>
                  </div>
                  <!-- /.box-body -->
                 </div>
            </div>
      </div>
      <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Hechos positivos</h3>
        
                    <div class="box-tools pull-right">
                      {{-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> --}}
                      </button>
                      {{-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> --}}
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="linechartdiv3">
                      <canvas id="lineChart3" style="height: 249px; width: 548px;" width="548" height="249"></canvas>
                    </div>
                  </div>
                  <!-- /.box-body -->
                 </div>
            </div>
      </div>

@endsection

@push('scripts')
<script src="{{asset('/adminlte/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('/js/Chart.min.js')}}"></script>
<script src="{{asset('/js/chartjs-plugin-datalabels.js')}}"></script>
 <script>
        var thisYear = (new Date()).getFullYear();    
        var start = new Date("1/1/" + thisYear);
        var end = new Date("12/31/" + thisYear);
        var defaultStart = moment(start.valueOf());
        var defaultEnd = moment(end.valueOf());
       
        var lastYear = (new Date()).getFullYear()-1;   
        var start2 = new Date("1/1/" + lastYear);
        var end2 = new Date("12/31/" + lastYear);
        var defaultStart2 = moment(start2.valueOf());
        var defaultEnd2 = moment(end2.valueOf());


        jQuery(document).ready(function(){
        $('#rango').daterangepicker({
            locale: {
            format: 'DD/M/YYYY'
            },
            startDate: defaultStart,
            endDate: defaultEnd,
        });
        $('#rango2').daterangepicker({
            locale: {
            format: 'DD/M/YYYY'
            },
            startDate : defaultStart2,
            endDate: defaultEnd2,
        });
        jQuery('#searchForm').submit(function(e){
       e.preventDefault();
        $("#lineChart").remove();
        $("#lineChart2").remove();
        $("#lineChart3").remove();
       $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
      });
       jQuery.ajax({
          url: "{{ route('admin.graficos.comparacionPost') }}",
          method: 'post',
          data: {
             rango1: jQuery('#rango').val(),
             rango2: jQuery('#rango2').val()
          },
          success: function(result){
            var newCanvas = "<canvas id='lineChart' height='450' style='margin-left: 10px; padding-left: 10px;'></canvas>";
            var newCanvas2 = "<canvas id='lineChart2' height='450' style='margin-left: 10px; padding-left: 10px;'></canvas>";
            var newCanvas3 = "<canvas id='lineChart3'height='450' style='margin-left: 10px; padding-left: 10px;'></canvas>";
            $(".linechartdiv").append(newCanvas);
            $(".linechartdiv2").append(newCanvas2);
            $(".linechartdiv3").append(newCanvas3);
            var speedCanvas = document.getElementById("lineChart");
            var speedCanvas2 = document.getElementById("lineChart2");
            var speedCanvas3 = document.getElementById("lineChart3");
            // Chart.defaults.global.defaultFontFamily = "Lato";
            // Chart.defaults.global.defaultFontSize = 12;

            labelsP = [];
            labelsN = [];
            //variables para chart por nacionalidad
            labelsC = [];
            dataC = [];
            labelsC2 = [];
            dataC2 = [];

            //variables para chart por mes
            labelsTP = [];
            dataTP = [];
            labelsTP2 = [];
            dataTP2 = [];
            
            labelsTN = [];
            dataTN = [];
            labelsTN2 = [];
            dataTN2 = [];

            var dynamicColors = function() {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            return "rgba(" + r + "," + g + "," + b + "," + "0.6)";
            };
            for(var i in result.cat1) {
            labelsC.push(result.cat1[i].name);
            dataC.push(result.cat1[i].cantidad);
            }  
            for(var i in result.cat2) {
            labelsC2.push(result.cat2[i].name);
            dataC2.push(result.cat2[i].cantidad);
            }  
            // Object.keys(result.tagsPN1).forEach(function(key) {
            // console.log(key, result.tagsPN1[key].cantidad);
            // });
            for(var i in result.tagsPN1) {
            // console.log(result.tagsPN1[i].name);
            labelsTN.push(result.tagsPN1[i].name);
            dataTN.push(result.tagsPN1[i].cantidad);
            }  
            // console.log(result.tagsPN1, dataTN);
            for(var i in result.tagsPN2) {
              // console.log(result.tagsPN2[i].name);
            labelsTN2.push(result.tagsPN2[i].name);
            dataTN2.push(result.tagsPN2[i].cantidad);
            }  
            // console.log(result.tagsPN2, dataTN2);
            for(var i in result.tagsPC1) {
            labelsTP.push(result.tagsPC1[i].name);
            dataTP.push(result.tagsPC1[i].cantidad);
            }   
            for(var i in result.tagsPC2) {
            labelsTP2.push(result.tagsPC2[i].name);
            dataTP2.push(result.tagsPC2[i].cantidad);
            }   
            
            //PARA CHART POR NACIONALIDAD
            var speedDataC = {
              labels: ['Hechos positivos', 'Hechos negativos'],
              datasets: [
                {
                label: 'Comparacion de hechos '+result.fecha1,
                data: dataC,
                backgroundColor:  dynamicColors(),
                borderColor:  "rgba(" + 0 + "," + 0 + "," + 0 + "," + "0.6)",
                borderWidth: 2,
                // hoverBackgroundColor: dynamicColors(),
                hoverBorderColor: dynamicColors()
                },
                {
                label: 'Comparacion de hechos '+result.fecha2,
                data: dataC2,
                backgroundColor:  dynamicColors(),
                borderColor:  "rgba(" + 0 + "," + 0 + "," + 0 + "," + "1)",
                borderWidth: 2,
                // hoverBackgroundColor: dynamicColors(),
                hoverBorderColor: dynamicColors()
                },
            ]
            };
            var speedDataTP = {
              labels: labelsTP,
              datasets: [
                {
                label: 'Comparacion de hechos '+result.fecha1,
                data: dataTP,
                backgroundColor:  dynamicColors(),
                borderColor:  "rgba(" + 0 + "," + 0 + "," + 0 + "," + "1)",
                borderWidth: 2,
                // hoverBackgroundColor: dynamicColors(),
                hoverBorderColor: dynamicColors()
                },
                {
                label: 'Comparacion de hechos '+result.fecha2,
                data: dataTP2,
                backgroundColor:  dynamicColors(),
                borderColor:  "rgba(" + 0 + "," + 0 + "," + 0 + "," + "1)",
                borderWidth: 2,
                // hoverBackgroundColor: dynamicColors(),
                hoverBorderColor: dynamicColors()
                },
            ]
            };
            var speedDataTN = {
              labels: labelsTN,
              datasets: [
                {
                label: 'Comparacion de hechos '+result.fecha1,
                data: dataTN,
                backgroundColor:  dynamicColors(),
                borderColor:  "rgba(" + 0 + "," + 0 + "," + 0 + "," + "1)",
                borderWidth: 2,
                // hoverBackgroundColor: dynamicColors(),
                hoverBorderColor: dynamicColors()
                },
                {
                label: 'Comparacion de hechos '+result.fecha2,
                data: dataTN2,
                backgroundColor:  dynamicColors(),
                borderColor:  "rgba(" + 0 + "," + 0 + "," + 0 + "," + "1)",
                borderWidth: 2,
                // hoverBackgroundColor: dynamicColors(),
                hoverBorderColor: dynamicColors()
                },
            ]
            };
            //PARA CHART POR NACIONALIDAD
            var chartOptions = {
                scales : {
                    yAxes:[{
                    gridLines: {
                        display:true,
                        color:"rgba(0,0,0,1)"
                    },
                    ticks: {
                        min: 0,
                        stepSize: 1,
                    }
                }],
                xAxes:[{
                  display: true,
                  offset: true,
                  gridLines:{
                    display: true,
                    color:"rgba(0,0,0,1)"
                  }
                }]
                },
                plugins: {
					datalabels: {
						align: function(context) {
							var value = context.dataset.data[context.dataIndex];
							return value > 0 ? 'center' : 'start';
						},
						anchor: function(context) {
							var value = context.dataset.data[context.dataIndex];
							return value > 0 ? 'end' : 'start';
						},
						rotation: function(context) {
							var value = context.dataset.data[context.dataIndex];
							return value > 0 ? 45 : 180 - 45;
						},
						backgroundColor: function(context) {
							return context.dataset.backgroundColor;
						},
            opacity: 1,
            font : {
                      size : '18'
                  },
						borderRadius: 4,
						color: 'white',
						formatter: Math.round
					}
                },
                 //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
                scaleBeginAtZero: true,
                //Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines: true,
                //String - Colour of the grid lines
                scaleGridLineColor: 'rgba(0,0,0,.05)',
                //Number - Width of the grid lines
                scaleGridLineWidth: 1,
                //Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                //Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines: true,
                //Boolean - If there is a stroke on each bar
                barShowStroke: true,
                //Number - Pixel width of the bar stroke
                barStrokeWidth: 2,
                //Number - Spacing between each of the X value sets
                barValueSpacing: 5,
                //Number - Spacing between data sets within X values
                barDatasetSpacing: 1,
                //String - A legend template
                legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
                //Boolean - whether to make the chart responsive
                responsive: true,
                maintainAspectRatio: false
            };
            
            chartOptions.datasetFill = false

             var lineChart = new Chart(speedCanvas, {
              type: 'bar',
              data: speedDataC,
              options: chartOptions,
            });
           
            var lineChart2 = new Chart(speedCanvas2, {
              type: 'bar',
              data: speedDataTN,
              options: chartOptions,
            });
           
            var lineChart3 = new Chart(speedCanvas3, {
              type: 'bar',
              data: speedDataTP,
              options: chartOptions,
            });

          }});
       });
    });
    </script>
@endpush

@push('styles')
<link rel="stylesheet" href="{{asset('/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
@endpush


