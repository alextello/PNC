@extends('admin.layout')

@section('content')
<div class="box box-primary">
    <div class="box-header">
      <h3 class="box-title">Llene el formulario para buscar</h3>
    </div>
    <div class="box-body">
        <form id="searchForm" class="form-inline">
                <label class="mr-3">Rango de fecha</label>
                <div class="input-group mr-3">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="rango" name="rango" required>
                </div>
                <label for="">Categoria</label>
                <select name="category" id="category" class="multiple form-control mr-3">
                    <option value="">Seleccione...</option>
                    <option value="1">Hechos positivos</option>
                    <option value="2">Hechos negativos</option>
                </select>
                <label for="">Delito</label>
                <select name="tag" id="tag" class="multiple form-control mr-3" style="width: 150px;" required></select>
            <button class="btn btn-info" type="submit">Buscar</button>
        </form>
    </div>
    <!-- /.box-body -->
  </div>
  
  <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Tabla estadistica</h3>
    
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

@endsection

@push('scripts')
<script src="/adminlte/bower_components/moment/min/moment.min.js"></script>
<script src="/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="/js/Chart.min.js"></script>
<script src="/js/chartjs-plugin-datalabels.js"></script>
<script src={{asset("/adminlte/bower_components/select2/dist/js/select2.full.min.js")}}></script>
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

            $('.multiple').select2({
            language: {
            noResults: function() {

            return "No hay resultados";        
            },
            searching: function() {

            return "Buscando..";
            }
            }
        });


         $('#category').change( function() {
        var id = $('#category').val();
        $('#tag').empty()
        $.ajax({
            url: `/admin/subcategoria/${id}`,
            type: "GET",
            dataType: "json",
            success: data => {
                data.tags.forEach(tag =>
                    $('#tag').append(`<option value="${tag.id}">${tag.subcategory.name + ' / ' + tag.name}</option>`)
                )
            }
        })
    });

        jQuery('#searchForm').submit(function(e){
       e.preventDefault();
        $("#lineChart").remove();
       $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
      });
       jQuery.ajax({
          url: "{{ route('admin.graficos.rangoDelito') }}",
          method: 'post',
          data: {
             rango: jQuery('#rango').val(),
             tag : jQuery('#tag').val()
          },
          success: function(result){
            var newCanvas = "<canvas id='lineChart' height='450' style='margin-left: 10px; padding-left: 10px;'></canvas>";
            $(".linechartdiv").append(newCanvas);
            var speedCanvas = document.getElementById("lineChart");
            Chart.defaults.global.defaultFontFamily = "Lato";
            Chart.defaults.global.defaultFontSize = 12;

            //variables para chart por nacionalidad
            labelsC = [];
            dataC = [];

            var dynamicColors = function() {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            return "rgba(" + r + "," + g + "," + b + "," + "0.6)";
            };
        

            labelsC.push(result.post[0].subcategoria+': '+result.post[0].name);
            dataC.push(result.post[0].cantidad);
            
            
            //PARA CHART POR NACIONALIDAD
            var speedDataC = {
              labels: labelsC,
              datasets: [{
                label: "Grafico de "+result.post[0].subcategoria+': '+result.post[0].name,
                data: dataC,
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
        
          }});
       });
    });
    </script>
@endpush

@push('styles')
<link rel="stylesheet" href={{asset("/adminlte/bower_components/select2/dist/css/select2.min.css")}}>
<link rel="stylesheet" href="/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css">
@endpush