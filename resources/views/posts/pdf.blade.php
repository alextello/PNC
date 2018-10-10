<html>
<head>
  <style type="text/css">
   @page {
            margin-top: 100px;
            margin-bottom: 100px;
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
  <main style="text-align: justify; width:16cm">
  <p style="text-align: right">Oficio: {{$post->oficio}}</p>
  <p style="text-align: right">Ref. {{strtolower(optional($post->owner)->reference)}}/{{strtoupper(optional($post->jefeDeTurno)->reference)}}</p>
  <h2 style="text-align: center;" class="flyleaf">{{$post->title}}</h2>

  <p style="text-align: justify;">{!!$post->body!!}</p>
  <p style="text-align: justify;">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repellendus consequatur quaerat dolor, doloribus doloremque voluptatum veritatis ut sapiente deserunt! Vitae vero tenetur ullam ad repudiandae excepturi itaque, explicabo ducimus alias?
  Voluptas facilis dolor excepturi a ipsam quasi totam cumque! Tempora ipsum tempore quo ex voluptatum excepturi perspiciatis fuga accusamus enim assumenda. Assumenda maiores corrupti hic molestias, ea facilis expedita odio!
  Architecto veniam dolor sed necessitatibus libero commodi labore doloremque ipsa laborum! Illum neque amet ex consequatur! Ratione, voluptatem soluta! Corrupti beatae placeat ratione? Iste dignissimos laborum debitis, soluta blanditiis recusandae?
  Magnam labore sapiente sed, hic ad adipisci voluptatum amet sint, voluptatibus blanditiis, eius enim itaque totam perferendis quidem odio architecto nesciunt officiis quia error doloremque? Earum autem accusantium fuga ipsam.
  Illum ipsa explicabo nesciunt omnis ipsum quae. Reprehenderit nisi accusamus pariatur tempora maiores ad voluptate ipsa nam id, eveniet non animi voluptatem laboriosam nihil reiciendis aspernatur deleniti quo sapiente neque.
  Maxime magnam, veniam perspiciatis, fuga inventore vitae sequi accusamus eveniet dolores qui fugit? Blanditiis totam impedit aperiam cum quod exercitationem, culpa, corporis, repellendus error ut minima ullam eum aspernatur ex.
  Adipisci corrupti aliquid dignissimos iure dicta possimus. Autem quas, vero quisquam labore odio aliquid nulla quod ut dicta eaque officiis, repellendus eveniet mollitia porro velit at facere harum consectetur ipsum.
  Eaque laboriosam nobis hic? Quod deserunt reiciendis atque. Delectus vel dolorem laudantium eum repellendus. Numquam minus dicta totam iste enim error repudiandae maxime ducimus repellendus corporis, quo ipsam omnis nobis.
  Velit perferendis assumenda iusto. Fuga repellat quam necessitatibus pariatur sequi laudantium autem. Facilis ipsum reprehenderit totam exercitationem impedit sunt pariatur sapiente quaerat perspiciatis qui, eius debitis quod sint architecto ipsam?
  Accusantium debitis corporis nemo neque sit cum eius, modi ipsum earum in voluptates explicabo? Ipsa minus modi, eaque illo ducimus, tempore est ab quas quae, voluptatibus explicabo cupiditate repudiandae aspernatur.
  Maxime, sunt. Dignissimos, ex rerum. Repellat amet maxime soluta! Quia veritatis quis omnis! Fuga assumenda quis error amet culpa doloremque sapiente quo, animi aut, fugiat nulla in non laudantium. Magni!
  Atque ducimus distinctio, sint, necessitatibus aspernatur quos veritatis porro quaerat ipsum dolorum natus dolore dignissimos assumenda labore cumque quis cupiditate quam aliquam, rem corrupti itaque deleniti doloribus illum. Eaque, provident.
  Obcaecati doloribus reprehenderit illum, quod dolor voluptas quo libero alias tempora ut explicabo quam error aspernatur tenetur delectus, mollitia id assumenda quas autem esse, accusantium architecto. Dolorum rem nihil corrupti.
  Nesciunt totam dignissimos deleniti blanditiis eum. Nemo fugit, eligendi sequi libero commodi officiis tenetur ratione dolorum? Placeat fugiat saepe delectus veniam repudiandae itaque quasi, ex dolores blanditiis hic recusandae ullam!
  Laudantium, tempore. Cum ea, perspiciatis assumenda magnam perferendis aspernatur alias. Quidem omnis, illo corporis quos debitis minima laborum animi, enim deserunt fugit cupiditate! Exercitationem nesciunt qui ab officia. Adipisci, commodi!
  Dignissimos neque, omnis excepturi recusandae fuga quisquam veritatis in, sint corrupti amet itaque atque impedit asperiores dolores pariatur error natus quo eveniet laboriosam, possimus ipsum! Ipsam ratione quas praesentium similique!
  Fugiat nihil nisi eligendi! Tempore odio nobis dolor voluptates quisquam repellendus exercitationem itaque ipsum iste, eligendi nam, dolores fuga distinctio nostrum cupiditate! Ut aspernatur quisquam, velit fuga sapiente voluptatum quasi.
  Esse ipsa veritatis iste vel vitae tempora eum rem commodi quidem quos ex quaerat magnam, id provident eaque itaque quia quibusdam quam culpa a saepe cupiditate? Assumenda suscipit fuga facilis!
  Nobis, fugit. Nobis, id praesentium beatae saepe dicta commodi iusto eligendi non voluptatem mollitia laudantium. Assumenda eius odio unde, et excepturi amet nemo temporibus. Nihil facilis deleniti minima molestias ab.
  Officia, tenetur quidem! Vel reiciendis eum obcaecati atque exercitationem quibusdam nemo, rem dolores pariatur, similique laboriosam sunt excepturi debitis nihil dolor sapiente saepe autem! Accusamus quia mollitia eaque impedit natus.
  Ratione at commodi, eaque ipsum amet cupiditate alias maxime repellendus. Eveniet aliquam exercitationem non. Quasi, beatae unde? Quis dignissimos molestias nam architecto expedita aliquid, obcaecati quasi consectetur cumque. Iusto, inventore?
  Itaque error blanditiis quae nam unde nostrum magnam magni eveniet! Dolores sit error labore recusandae provident maiores tenetur similique quisquam nisi animi omnis, dolor assumenda obcaecati nostrum, ex beatae ea!
  Sint excepturi aut culpa architecto voluptatem quidem asperiores recusandae molestiae fugiat, commodi cupiditate facilis, laudantium illo placeat dignissimos eos facere, iure accusamus! Odio, magni! Quasi, vero? Deserunt corporis placeat minus.
  Harum maiores ea eos eum recusandae nulla ipsam consequatur veritatis facere. Quam similique nostrum atque aliquid animi, facilis odit itaque velit voluptatem odio dignissimos aspernatur tempore! Magnam suscipit officia porro.
  Tempore voluptatibus at autem consequatur animi amet quidem error corrupti tempora, distinctio obcaecati porro dolore ipsam unde mollitia, cumque doloribus molestias qui similique maxime. Quidem officiis rerum dicta et veritatis.
  Sit praesentium possimus qui eum consectetur perferendis aspernatur delectus nulla quis obcaecati et doloremque architecto impedit, inventore similique reiciendis dolores suscipit. Hic harum quisquam quam expedita nemo fuga nihil quasi!
  Quaerat aperiam unde nisi, ea cumque magni vitae ad similique rerum quod exercitationem libero? Modi quam ipsam fugiat consequuntur itaque. Perspiciatis et numquam consectetur ratione hic. Culpa unde quaerat corporis?
  Nostrum quidem tempore nulla saepe laborum ab, ullam, pariatur excepturi placeat magni quas! Deleniti perspiciatis mollitia, ea iure pariatur libero magni quam dolore obcaecati excepturi optio explicabo sit odit. Modi!
  Consequatur impedit ipsa fuga! Expedita recusandae rerum pariatur? Ab exercitationem quasi, mollitia deleniti alias praesentium molestias. Tempore, atque, deleniti error consectetur deserunt voluptas eaque a ea hic laudantium impedit dolorem.
  Reprehenderit, debitis quia. Maiores error repellat molestiae voluptatem? Repudiandae officia ipsum, alias id dicta illum, esse tempora explicabo sequi, fugiat at iste? Dicta reiciendis sequi placeat ipsa aperiam id quia.
  Expedita error dicta assumenda dignissimos omnis quibusdam explicabo cum, suscipit pariatur est culpa? Animi suscipit esse ipsa, sint consequuntur est magni, deserunt quibusdam, aperiam perferendis soluta ducimus harum delectus quos.
  Reiciendis cumque ipsum magni maxime id accusantium quidem vero sit nobis quos similique accusamus odit autem qui, assumenda necessitatibus, veritatis possimus voluptate, totam error dolores eveniet aut illo aliquid! Voluptatibus.
  Fugit quae omnis laudantium quaerat! Autem laudantium minus eos atque maxime sint veritatis id tenetur repudiandae facere quo ipsa labore excepturi harum doloremque assumenda, iure fugiat ipsum aspernatur architecto laborum?
  Asperiores aspernatur assumenda laudantium laborum iure ex laboriosam est aut quaerat amet? Ex reiciendis magni non! Officia autem veniam veritatis esse reiciendis sint aut ipsam a quae, totam eos possimus?
  Ipsum, corporis aspernatur, pariatur consequatur quo amet, tempore ea maiores quos eligendi eum ex quia libero dignissimos! Autem deleniti et eaque. Ducimus et iusto neque distinctio fugit aut laudantium unde!
  Nulla tempore voluptatum harum commodi accusantium, excepturi dolor dicta facilis nobis quia hic exercitationem quae? Soluta odio labore fuga? Obcaecati non quas perferendis facilis magni aliquam accusamus minima perspiciatis ab?
  Facere sit eligendi maiores? Mollitia eius eligendi facilis a in ullam ea consectetur sed quod soluta! Alias vitae eaque perferendis deserunt quod, aut, inventore est, eveniet ad assumenda dicta suscipit?
  Voluptatem perferendis ratione eveniet. Asperiores iure sunt doloremque illo adipisci fuga consectetur rem eveniet numquam aliquid, dolore repellat reprehenderit? Voluptate atque, distinctio fugit explicabo assumenda nesciunt doloremque at minus doloribus.
  Iure numquam beatae sapiente molestias delectus, tempore, assumenda dolores rem esse dolorum facilis fugiat eos eaque qui. Fugit architecto et ipsam iusto nulla porro explicabo quo obcaecati? Deleniti, blanditiis reiciendis?
  Totam nulla quis rerum, corrupti neque earum laudantium nesciunt soluta eligendi hic nisi quisquam dolor placeat at possimus voluptate accusantium aliquam illo odit aut sequi? Fugiat dolores voluptatum consectetur laboriosam.</p>

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