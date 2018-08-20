@extends('admin.layout')

@section('content')

<div class="box box-primary">
        <div class="box-body">
            <div class="box-header with-border">
                <h3>Tabla estadistica</h3>
            </div>
            <div class="box-body">
                    <table id="posts-table" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                              <th>No.</th>
                              <th>Año</th>
                              <th>Mes</th>
                              <th>Día</th>
                              <th>Fecha</th>
                              <th>Hora</th>
                              <th>Detenidos</th>
                              <th>Edad</th>
                              <th>Direccion</th>
                              <th>Municipio</th>
                              <th>Motivo</th>
                              <th>Delito</th>
                            </tr>
                            </thead>
                            <tbody id="miTabla">
                                @php $i=1; @endphp
                                @foreach ($posts as $post)
                                    @if($post->involucrados->count() > 1)
                                        @foreach($post->involucrados as $involucrado)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td> {{ $post->published_at->format('Y') }} </td>
                                    <td>{{  $post->published_at->format('M') }}</td>
                                    <td>{{  $post->published_at->format('l') }} </td>
                                    <td>{{  $post->published_at->format('d-m-Y') }} </td>
                                    <td>{{ $post->time }}</td>
                                    <td>{{ $involucrado->name }}</td>
                                    <td>{{ $involucrado->age }}</td>
                                    <td>{{ $post->address->name }}</td>
                                    <td>{{ $post->address->aldea->name }}</td>
                                    <td>{{ $post->tags->name }}</td>
                                    <td>{{ $post->tags->name }}</td>
                                </tr>
                                    @php $i++ @endphp
                                        @endforeach
                                @else
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td> {{ $post->published_at->format('Y') }} </td>
                                        <td>{{  $post->published_at->format('M') }}</td>
                                        <td>{{  $post->published_at->format('l') }} </td>
                                        <td>{{  $post->published_at->format('d-m-Y') }} </td>
                                        <td>{{ $post->time }}</td>
                                        <td>{{ optional($post->involucrado)->name }}</td>
                                        <td>{{ optional($post->involucrado)->age }}</td>
                                        <td>{{ $post->address->name }}</td>
                                        <td>{{ $post->address->aldea->name }}</td>
                                        <td>{{ $post->tags->name }}</td>
                                        <td>{{ $post->tags->name }}</td>
                                    </tr>   
                                    @php $i++ @endphp
                                    @endif
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
@endpush