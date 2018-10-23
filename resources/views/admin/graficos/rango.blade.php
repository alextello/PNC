@extends('admin.layout')

@section('content')
<div class="box box-primary">
    <div class="box-header">
      <h3 class="box-title">Elija el rango de fecha</h3>
    </div>
    <div class="box-body">
        <form id="searchForm">
            <div class="form-group">
                <label>Rango de fecha</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="rango" name="rango">
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

        jQuery(document).ready(function(){
          $('#rango').daterangepicker({
            locale: {
            format: 'DD/M/YYYY'
            },
            startDate: defaultStart,
            endDate: defaultEnd,
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
          url: "{{ route('admin.graficos.rangoPost') }}",
          method: 'post',
          data: {
             rango: jQuery('#rango').val()
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
            Chart.defaults.global.defaultFontFamily = "Lato";
            Chart.defaults.global.defaultFontSize = 12;

            //variables para chart por nacionalidad
            labelsC = [];
            dataC = [];

            //variables para chart por mes
            labelsTP = [];
            dataTP = [];
            
            labelsTN = [];
            dataTN = [];

            var dynamicColors = function() {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            return "rgba(" + r + "," + g + "," + b + "," + "0.6)";
            };
            for(var i in result.categorias) {
            labelsC.push(result.categorias[i].name);
            dataC.push(result.categorias[i].cantidad);
            }  
            for(var i in result.tagsN) {
            labelsTN.push(result.tagsN[i].subcategoria + ": " + result.tagsN[i].name);
            dataTN.push(result.tagsN[i].cantidad);
            }  
            for(var i in result.tagsP) {
            labelsTP.push(result.tagsP[i].subcategoria + ": " + result.tagsP[i].name);
            dataTP.push(result.tagsP[i].cantidad);
            }   
            
            //PARA CHART POR NACIONALIDAD
            var speedDataC = {
              labels: labelsC,
              datasets: [{
                label: "GRAFICO DE CATEGORIA DE HECHOS",
                data: dataC,
                backgroundColor:  dynamicColors(),
                borderColor:  "rgba(" + 0 + "," + 0 + "," + 0 + "," + "1)",
                borderWidth: 2,
                // hoverBackgroundColor: dynamicColors(),
                hoverBorderColor: dynamicColors()
              }]
            };
            
            //PARA CHART POR MES
             var speedDataTN = {
              labels: labelsTN,
              datasets: [{
                label: "GRAFICO DE HECHOS NEGATIVOS",
                data: dataTN,
                backgroundColor:  dynamicColors(),
                borderColor:  "rgba(" + 0 + "," + 0 + "," + 0 + "," + "1)",
                borderWidth: 2,
                // hoverBackgroundColor: dynamicColors(),
                hoverBorderColor: dynamicColors()
              }]
            };

             var speedDataTP = {
              labels: labelsTP,
              datasets: [{
                label: "GRAFICO DE HECHOS POSITIVOS",
                data: dataTP,
                backgroundColor:  dynamicColors(),
                borderColor:  "rgba(" + 0 + "," + 0 + "," + 0 + "," + "1)",
                borderWidth: 2,
                // hoverBackgroundColor: dynamicColors(),
                hoverBorderColor: dynamicColors()
              }]
            };
           
            //PARA CHART POR NACIONALIDAD
            var chartOptions = {
                scales: {
                yAxes:[{
                    stacked:true,
                    gridLines: {
                        display:true,
                        color:"rgba(0,0,0,1)"
                    },
                    ticks: {
                        min: 0,
                        stepSize: 1
                    }
                }],
                xAxes:[{
                  gridLines:{
                    display: true,
                    color:"rgba(0,0,0,1)"
                  },
                  display: true,
                  offset: true
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
					      	borderRadius: 4,
					      	color: 'white',
					      	formatter: Math.round,
                  font : {
                      size : '18'
                  }
					      }
                },
                maintainAspectRatio: false,
                // responsive:true
            };

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