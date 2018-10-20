<html>
<head>
  <style type="text/css">
   @page {
            margin-top: 100px;
            margin-bottom: 100px;
            margin-left: 2cm;
            margin-right: 2cm;
            /* @bottom-left {
            content: counter(page) "/" counter(pages);
        } */
            /* @top-center {
                content: element(header);
            } */
        }
  body{
    padding: 1rem;
  }
  footer { position: fixed; bottom: -50px; left: 0px; right: 0px; height: 50px; padding: .5em; text-align: center; }
    /* p { page-break-after: always; } */
    p:last-child { page-break-after: never; }
    #header { position: fixed; top: -100px; left: 0px; right: 0px; height: 50px; padding: .5em; text-align: center; }
  </style>
<link rel="stylesheet" href="{{ asset('/css/app.css') }}">
</head>
<body style="background: white;">
  @if($header->default_footer)
  <footer>
    <img src="{{asset('/storage/banner/footer.jpg')}}" style="width: 100%; height: 2.5cm; opacity: 0.5;" alt="">
  </footer>
  @else
  <footer>
    <img src="{{asset('/storage/'.$header->footer)}}" style="width: 100%; height: 2.5cm; opacity: 0.5;" alt="">
  </footer>
  @endif

  @if($header->default_header)
  <header class="header" id="header">
  <img src={{asset('/storage/banner/banner.jpg')}} style="width: 100%; height: 2.5cm; opacity: 0.5;" alt="">
  </header>
  @else
  <header class="header" id="header">
    <img src={{asset('/storage/'.$header->header)}} style="width: 100%; height: 2.5cm; opacity: 0.5;" alt="">
    </header>
  @endif
  <div class="footer"><span class="pagenum"></span></div>
  <main>
  <p style="text-align: center"><strong>Dirección General Policía Nacional Civil</strong></p><br><br>
  <p style="text-align: left"><strong>Dependencia policial:</strong><u>41-31 San Juan Ostuncalco, Quetzaltenango</u></p><br>
  <p style="text-align: right"><strong>Acta de Prevención No.</strong><u>{{$post->oficio}}</u></p><br>
  {{-- <h2 style="text-align: center;" class="flyleaf">{{$post->title}}</h2> --}}

  {!!$post->body!!}
  
  @if($post->photos->count())
  <div class="text-center">
  @foreach($post->photos as $photo)
     <img style="width: 5cm; height: 5cm; padding-right: 10px; padding-bottom: 10px; padding-top:10px; margin-top: 0.5cm" src="{{asset('/storage/'.$photo->url)}}" alt="">
     @endforeach
  </div>
  @endif
  </main>
</body>

</html>
{{-- <style>
p { margin:0 }
</style> --}}