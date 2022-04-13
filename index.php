<!DOCTYPE html>
<html <?php language_attributes() ?>>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo App::uri('assets/dist/css/app.css') ?>">
  <?php wp_head() ?>
</head>

<body <?php body_class() ?>>

  <div id="wp_app">

    <h1>Hello World!</h1>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium cupiditate odit quam vero nesciunt delectus voluptates. Esse autem perferendis cupiditate, repudiandae est mollitia asperiores facere voluptate qui nulla eum saepe.
      Recusandae quos id numquam exercitationem quibusdam officiis deleniti quam distinctio, iusto blanditiis. Dolor consectetur harum blanditiis velit sunt libero nisi beatae unde. Cum deserunt reiciendis itaque dolorem nihil, voluptatem recusandae.</p>
  </div>


  <?php
  if (have_posts()) :

    while (have_posts()) :
      the_post();
      // include PARTDIR . "/post/post-full.php";
    endwhile;

  endif;
  ?>


  <?php wp_footer() ?>
  <script src="<?php echo App::uri('assets/dist/js/app.js') ?>"></script>
</body>

</html>