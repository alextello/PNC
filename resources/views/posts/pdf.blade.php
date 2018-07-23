<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p class="title">{{ $post->title }}</p>
    <p class="body">{!! $post->body !!} Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia officiis accusamus perferendis, quos doloremque sed doloribus aspernatur ad amet, ab vero saepe soluta! Eveniet rerum vel, asperiores quam totam beatae.</p>
    <p class="body">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae voluptatibus, quis enim tempora beatae perspiciatis quod dolores, consectetur, illum esse ratione libero voluptas incidunt sed quidem unde ab quaerat nulla!
Aspernatur quaerat inventore beatae dolorum nobis sunt natus quam eveniet tempora, vero consectetur molestias aliquam eaque corrupti sapiente id nam a modi fugiat obcaecati. Facere maiores veniam beatae doloribus quibusdam.
Neque consectetur ex molestiae quis sint vitae, pariatur nemo! Omnis exercitationem magni asperiores, magnam mollitia rerum quaerat libero soluta totam ut corporis illo nisi nihil eos incidunt, maiores quo praesentium.
Harum, accusamus mollitia? Ratione distinctio placeat tempora atque molestias. Enim aspernatur nulla libero earum ut, nobis dolorum ducimus aliquid quo minus voluptates fugit eaque alias tenetur accusamus distinctio voluptas omnis?
Maxime quod accusamus exercitationem, incidunt accusantium minus nam sint quos cumque. Ea mollitia nemo aliquid? Minima maxime dolore sapiente quos iste sit consequuntur soluta. Ullam cum deleniti necessitatibus incidunt magni!
Expedita saepe aliquid laboriosam cupiditate commodi, assumenda aut non atque consequuntur iusto inventore deserunt nesciunt quisquam molestiae suscipit, iste explicabo eveniet at fugit ex voluptatibus impedit. Ratione libero reiciendis commodi?
Laboriosam ratione nemo totam velit tenetur incidunt ab recusandae quia dolor beatae eveniet blanditiis commodi ipsam obcaecati ea delectus aperiam culpa, atque sapiente illo eos dignissimos. Perferendis, ex. Nulla, cumque.
Deleniti, laborum nostrum dolor, commodi nesciunt sapiente numquam possimus officiis consectetur est quas esse voluptatem saepe rerum voluptate, vel assumenda! Praesentium dolores saepe ducimus. Nihil, id obcaecati. Quam, ipsam fuga!</p>
<div class="split left">
    <div class="centered">
      <img src="/storage/posts/eCvQwgX8wNrb1Mec2UNb4HUEyKwjqpFEbwIJGklt.png" alt="Avatar woman">
    </div>
  </div>
  
  <div class="split right">
    <div class="centered">
      <img src="/storage/posts/Q7ZVFt6N1S1IKuzmu8tqwdCdzYRXL6t1rxcnAKab.png" alt="Avatar man">
    </div>
  </div>
</body>
</html>

<style>
    .title{
        font-size: 12;
        text-align: center;
        font: bold;
    }
    .body{
        text-align: justify;
        text-justify: inter-word;
    }

    .split {
  height: 100%;
  width: 50%;
  position: fixed;
  overflow-x: hidden;
  padding-top: 20px;
}

/* Control the left side */
.left {
  left: 0;
}

/* Control the right side */
.right {
  right: 0;
}

/* If you want the content centered horizontally and vertically */
.centered {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
}

/* Style the image inside the centered container, if needed */
.centered img {
  
}
</style>