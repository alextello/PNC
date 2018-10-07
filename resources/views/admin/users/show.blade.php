@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-md-6"><div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="/adminlte/img/pnc.jpg" alt="{{$user->name}}">

            <h3 class="profile-username text-center">{{$user->name}}</h3>

              <p class="text-muted text-center">{{$user->codigo}}</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                <b>Usuario</b> <a class="pull-right">{{ $user->email }}</a>
                </li>
                <li class="list-group-item">
                <b>Telefono</b> <a class="pull-right">{{ $user->telefono }}</a>
                </li>
                <li class="list-group-item">
                <b>Pubicaciones</b> <a class="pull-right">{{ $user->created_by()->count() }}</a>
                </li>
                <li class="list-group-item">
                <a class="btn btn-default" href="{{route('admin.users.edit', $user)}}">Editar <i class="fa fa-edit"></i></a>
                </li>
              </ul>

              {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
            </div>
            <!-- /.box-body -->
          </div></div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Publicaciones</h3>
                </div>
                <div class="box-body">
                    @forelse($user->created_by as $post)
                        <a href="{{ route('posts.show', $post) }}" target="_blank">
                        <strong>{{ $post->title }}</strong>
                        </a><br>
                        <small class="text-muted">Publicado el {{ optional($post->published_at)->format('d/M/Y')}}</small>
                        @unless ($loop->last)
                        <hr>
                        @endunless
                        @empty
                        <p class="text-muted">Sin publicaciones</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection