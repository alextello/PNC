@extends('admin.layout')

@section('content')

    <div class="box box-primary">
        <div class="box-body">
            <div class="box-header with-border">
                <h3>Elija la etiqueta</h3>
            </div>
            <div class="box-body">
                <form action="{{route('buscar.tag')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <select name="tag" id="tag" class="form-control select2">
                            <option value="">Seleccione una etiqueta</option>
                            @foreach($tags as $tag)
                            <option value="{{$tag->id}}">{{$tag->subcategory}} / {{$tag->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <button class="form-control btn btn-info">Buscar</button>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('styles')
<link rel="stylesheet" href={{asset("/adminlte/bower_components/select2/dist/css/select2.min.css")}}>
@endpush

@push('scripts')
<script src={{asset("/adminlte/bower_components/select2/dist/js/select2.full.min.js")}}></script>
<script>
        $('.select2').select2({});
</script>
@endpush