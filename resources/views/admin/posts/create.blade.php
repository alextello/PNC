<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <form action={{ route('admin.posts.store', '#create')}} method="POST">
        @csrf
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Agregue el titulo de su nuevo reporte</h4>
        </div>
        <div class="modal-body">
            <div class="form-group {{$errors->has('title') ? 'has-error' : ''}}" >
                <label for="">Titulo del reporte</label>
                <input type="text" class="form-control" placeholder="Ingrese aquí el titulo del reporte" id="title" name="title"  autofocus>
                {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button class="btn btn-primary">Crear</button>
        </div>
      </div>
    </div>
    </form>
  </div>
