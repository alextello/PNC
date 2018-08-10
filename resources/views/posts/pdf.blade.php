<html>
<head>
  <style>
    @page { margin: 0.3cm 2.5cm 2.5cm 2.5cm; }
    header { position: fixed;  left: 0px; right: 0px; display: block}
  </style>
</head>
<body>
  <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
  <header>
  <img src="http://pnc.test/storage/banner/banner.jpg" style="width: 18cm; height: 2.5cm" alt="">
  </header>
  <main style="padding-top: 3cm; text-align: justify; width:16cm">
  <p style="text-align: right">Oficio: {{$post->oficio}}</p>
  <h2 style="text-align: center;">{{$post->title}}</h2>
  <p style="text-align: justify">{!!$post->body!!}</p>
  <br><br>
  <p class="page-break"></p>
  @if($post->photos->count())
  @foreach($post->photos as $photo)
    <img style="width: 5cm; height: 5cm" src="http://pnc.test/storage/{{$photo->url}}" alt="">
  @endforeach
  @endif
  </main>
</body>
</html>