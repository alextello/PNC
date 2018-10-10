<div class="buttons-social-media-share">
        <ul class="share-buttons">
          <li><a href="{{ route('file.word', $post->id) }}"><span class="fa fa-file-word-o"></span></a></li>
          <li><a href="{{ route('file.pdf', [$post->id, 'carta']) }}"><span class="fa fa-file-pdf-o"></span><small>carta</small></a></li>
          <li><a href="{{ route('file.pdf', [$post->id, 'oficio']) }}"><span class="fa fa-file-pdf-o"></span><small>oficio</small></a></li>
          @if(Auth::check() && (Auth::user()->hasRole('Admin') || Auth::user()->hasPermissionTo('Editar reportes')))
          <li><a href="{{ route('admin.posts.edit', $post->url) }}"><span class="fa fa-edit"></span></a></li>
          @endif
        </ul>
      </div>