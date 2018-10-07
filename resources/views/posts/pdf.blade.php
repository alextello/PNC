<html>
<head>
  <style>
    @page { margin: 0.3cm 2.5cm 2.5cm 2.5cm; }
    header { position: fixed;  left: 0px; right: 0px; display: block}
  </style>
</head>
<body style="background: white;">
  <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
  <header>
  <img src={{asset('/storage/'.'banner/banner.jpg')}} style="width: 18cm; height: 2.5cm" alt="">
  </header>
  <main style="padding-top: 3cm; text-align: justify; width:16cm">
  <p style="text-align: right">Oficio: {{$post->oficio}}</p>
  <p style="text-align: right">Ref. {{strtolower(optional($post->owner)->reference)}}/{{strtoupper(optional($post->jefeDeTurno)->reference)}}</p>
  <h2 style="text-align: center;">{{$post->title}}</h2>
  <p style="text-align: justify">{!!$post->body!!}</p>
  <br><br>
  <p class="page-break"></p>
  @if($post->photos->count())
  <div class="text-center">
  @foreach($post->photos as $photo)
     <img style="width: 5cm; height: 5cm; padding-right: 10px; padding-bottom: 10px; padding-top:10px;" src="{{asset('/storage/'.$photo->url)}}" alt="">
     @endforeach
  </div>
  @endif
  <br><br><br><br>
  <p style="text-align: center; margin: 0;">f._______________________________</p>
  <p style="text-align: center; margin: 0;">{{optional($post->jefeDeTurno)->name}}</p>
  <p style="text-align: center; margin: 0;">Jefe de turno</p>
  <p style="text-align: center; margin: 0;">Subcomisaria 41-31 San Juan Ostuncalco</p>
  </main>
</body>
</html>
{{-- <style>
p { margin:0 }
</style> --}}