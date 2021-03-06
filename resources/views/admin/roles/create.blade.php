@extends('admin.layout')

@section('content')
    <div class="row">
        <div class=" col-md-offset-3 col-md-6">
                    <div class="box box-primary">
                        <div class="box-body">
                          @include('admin.partials.error-messages')
                            <div class="box-header with-border">
                                <h3>Crear role</h3>
                            </div>
                            <div class="box-body">
                                <form action="{{ route('admin.roles.store') }}" method="POST">
                                    @csrf
                                   @include('admin.roles.form')
                                    <button class="btn btn-primary btn-block">Crear role</button>
                                </form>
                            </div>
                        </div>
                    </div>
             </div>
    </div>
@endsection