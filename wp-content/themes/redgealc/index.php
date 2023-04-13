<?php get_header(); ?>

<!-----------------------------------------
-------------------MAIN----------------
------------------------------------------>
<main>
  <section id="noticias" class="pt-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-9">
          <?php get_template_part('template-parts/news-list-destacados', 'none'); ?>
        </div>
        <?php get_template_part('template-parts/sidebar-pages', 'none'); ?>
      </div>
    </div>
  </section>
  <!-----------------------------------------
-------------------BUSCADOR----------------
------------------------------------------>
  <section id="buscador">
    <div class="container">
      <div class="row">
        <div class="col">
          <h2><?php pll_e('BUSCADOR'); ?></h2>
          <form class="buscador-form" role="search">
            <input class="form-control me-2 " name="s" type="search"  value="<?php the_search_query(); ?>" placeholder="" aria-label="Search">
            <button class="btn btn_buscar" type="submit"></button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-----------------------------------------
-------------------Lineas----------------
------------------------------------------>
  <?php
  /*
  $catego = 64;
  $cantidad = 30;
  $args = array(
    'post_type' => 'post',
    'orderby' => 'name',
    'order' => 'ASC',
    'cat' => $catego,
    'posts_per_page' => $cantidad
  );

  $the_query = new WP_Query($args);
  if ($the_query->have_posts()) :
    $the_posts = get_posts($args);
*/

  $args = [
    'hide_empty' => false,
    'taxonomy' => 'linea_de_trabajo',
    'orderby' => 'name',
    'order' => 'ASC',
  ];

  $cats = get_categories($args);
  if ($cats) {
      ?>
    <section id="features" class="bg-gris">
      <div class="container">
        <h2><?php pll_e('Nuestras'); ?><br>
        <?php pll_e('LÍNEAS DE TRABAJO'); ?></h2>
        <div class="row d-flex justify-content-center">
          <?php
          //foreach ($the_posts as $post) :
          foreach ($cats as $cat) {
              //echo '<br>'.$cat->term_id;
              $catnam = $cat->name;
              $image = get_field('icono', 'linea_de_trabajo_'.$cat->term_id);
              if (!empty($image)) {
                  $catimg = $image;
              } else {
                  $catimg = get_stylesheet_directory_uri().'/assets/img/nopic.jpg';
              }
              $caturl = '/lineas-de-trabajo/'.$cat->slug; ?>
          
			
			<div class="col-2 card feature_item no_deco_link">
              <div class="ratio ratio-1x1">

                <div>
                  <a href="<?php echo $caturl; ?>" class="rounded-circle bg-orange feature_circle" title="<?php echo $catnam; ?>" alt="<?php echo $catnam; ?>">
                  <img src="<?php echo $catimg; ?>" />
                  </a>
                </div>

              </div>
              <h3><a href="<?php echo $caturl; ?>" title="<?php echo $catnam; ?>" alt="<?php echo $catnam; ?>" class="stretched-link"><?php echo $catnam; ?></a></h3>
            </div>
			
			
			
          <?php
          } ?>
        </div>
        <!-- /.row -->
      </div>
    </section>

  <?php
  } ?>

  <section id="">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <?php get_template_part('template-parts/eventos-home', 'none'); ?>
        </div>
      </div>
    </div>
  </section>

  <?php get_footer(); ?>
</main>
<script>
  function filter_data(id, type) {
    // Declare variables
    var input, filter, ul, li, a, i;
    input = document.getElementById(id);
    filter = input.value.toUpperCase();
    ul = document.getElementById(id + "-ul");
    li = ul.getElementsByTagName('li');

    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < li.length; i++) {
      a = li[i].getElementsByTagName(type)[0];
      if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
        li[i].style.display = "";
        li[i].getElementsByTagName(type)[0].classList.remove("hidden");
        //            console.log(li[i].getElementsByTagName(type)[0]);
        //            li[i].removeClass("hidden");
      } else {
        li[i].style.display = "none";
        li[i].getElementsByTagName(type)[0].classList.add("hidden");
      }
    }
  }
</script>