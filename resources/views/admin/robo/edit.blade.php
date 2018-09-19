@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                            <div class="box-header with-border">
                                <h3>Datos</h3>
                            </div>
                            <div class="box-body">
                                <form action="{{ route('admin.robo.update', $inc) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="post" value="{{$post}}">
                                    <div class="form-group">
                                        <label for="">Descripcion:</label>
                                        <textarea name="descripcion" id="descricion" cols="30" class="form-control" rows="10">{{ old('descripcion', $inc->descripcion)}}</textarea>
                                    </div>
                                    <button class="btn btn-primary btn-block">Actualizar</button>
                                </form>
                            </div>
                    </div>
                </div>
        </div>
    </div>
@endsection
