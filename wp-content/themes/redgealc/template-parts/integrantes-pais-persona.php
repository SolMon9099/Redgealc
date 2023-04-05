<?php
$args = array(
  'taxonomy' => 'pais',
  'orderby' => 'name',
  'order'   => 'ASC'
);

$cats = get_categories($args);
foreach ($cats as $cat) {
  $hay_personas = 0;
  $pais_id = $cat->term_id;
  $image = get_field('bandera', 'pais_' . $pais_id);
  if (!empty($image)) {
    $catimg = $image;
  } else {
    $catimg = get_stylesheet_directory_uri() . '/assets/img/bandera.jpg';
  }
  $show = '
      <hr>
      <div class="row">
        <div class="col-12 mb-3">
          <div class="country-title">
            <img class="country-flag" src="'.$catimg.'" alt="'.$cat->name.'">
            <h4 class="country-name">'.$cat->name.'</h4>
          </div>
        </div>
      </div>
        <div class="row">
        ';

  //$catego = 160;
  $cantidad = 99;
  $catpais = $pais_id;
  $args = array(
    'post_type' => 'persona',
    'orderby' => 'date',
    'order' => 'DESC',
    'posts_per_page' => $cantidad,
    'tax_query' => array(
      'relation' => 'AND',
      array(
        'taxonomy' => 'pais',
        'field'    => 'id',
        'terms'    => $catpais,
      ),
      array(
        'taxonomy' => 'tipo_de_persona',
        'field'    => 'slug',
        'terms'    => array('integrante-de-la-red'),
      ),
    )
  );
  $the_query = new WP_Query($args);
  //print_r($the_query);
  if ($the_query->have_posts()) :
    $hay_personas = 1;
    $the_posts = get_posts($args);
    
    foreach ($the_posts as $post) :
      setup_postdata($post);
      $thetitle = get_the_title();
      $thetext = get_the_content();
      $perfoto = $catimg;
      if (has_post_thumbnail( $post->ID ) ){
        $perfoto = wp_get_attachment_image_url(get_post_thumbnail_id($post->ID));
      }
      $show .= '
        <div class="col-12 country-person-details mb-5">
          <div class="person-img">
            <img src="'.$perfoto.'" alt="'.$thetitle.'">
          </div>
          <div class="person-details">
            <p class="person-name">'.$thetitle.'</p>
            '.$thetext.'
          </div>
        </div>
        ';
    endforeach;
    wp_reset_postdata();
    
  endif;
  $show.= '</div>';
  if($hay_personas == 1){echo $show;}
  //echo $show;
}
