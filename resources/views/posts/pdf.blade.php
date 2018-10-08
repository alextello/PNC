<html>
<head>
  <style type="text/css">
   @page {
            margin-top: 100px;
            margin-bottom: 50pxcm;
            margin-left: 2.5cm;
            margin-right: 2.5cm;
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
  footer { position: fixed; bottom: -60px; left: 0px; right: 0px; background-color: lightblue; height: 50px; }
  .footer { position: fixed; bottom: 0px; }
  /* .pagenum:before { content: "Página " counter(page) " de " counter(pages); } */
  p:last-child { page-break-after: never; }
    #header { position: fixed; top: -100px; left: 0px; right: 0px; height: 50px; padding: .5em; text-align: center; }
  </style>
<link rel="stylesheet" href="{{ asset('/css/app.css') }}">
</head>
<body style="background: white;">
  <header class="header" id="header">
  <img src={{asset('/storage/'.'banner/banner.png')}} style="width: 100%; height: 2.5cm" alt="">
  </header>
  <div class="footer"><span class="pagenum"></span></div>
  <main style="text-align: justify; width:16cm">
  <p style="text-align: right">Oficio: {{$post->oficio}}</p>
  <p style="text-align: right">Ref. {{strtolower(optional($post->owner)->reference)}}/{{strtoupper(optional($post->jefeDeTurno)->reference)}}</p>
  <h2 style="text-align: center;" class="flyleaf">{{$post->title}}</h2>

  <p style="text-align: justify;">{!!$post->body!!}</p>

  @if($post->photos->count())
  <div class="text-center">
  @foreach($post->photos as $photo)
     <img style="width: 5cm; height: 5cm; padding-right: 10px; padding-bottom: 10px; padding-top:10px; margin-top: 0.5cm" src="{{asset('/storage/'.$photo->url)}}" alt="">
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
<script type="text/php">
  if ( isset($pdf) ) {
      $font = Font_Metrics::get_font("helvetica", "bold");
      $pdf->page_text(72, 18, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0));
  }
</script> 
</html>
{{-- <style>
p { margin:0 }
</style> --}}