@extends('admin.layout')

@section('content')

<div class="row">
    <div class="col-lg-4 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{$usuarios}}</h3>

          <p>Usuarios registrados</p>
        </div>
        <div class="icon">
          <i class="fa fa-fw fa-group"></i>
        </div>
        {{-- <a href="#" class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </a> --}}
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3>{{$posts}}</h3>

          <p>Novedades ocurridas este mes</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        {{-- <a href="#" class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </a> --}}
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{$aprehendidos}}</h3>

          <p>Aprehendidos este mes</p>
        </div>
        <div class="icon">
          <i class="fa fa-fw fa-shield"></i>
        </div>
        {{-- <a href="#" class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </a> --}}
      </div>
    </div>
    <!-- ./col -->
    {{-- <div class="col-lg-4 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3>65</h3>

          <p>Unique Visitors</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="#" class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div> --}}
    <!-- ./col -->
  </div>
@endsection