<?php
$pais_terms = wp_get_post_terms( $post->ID, 'pais' );
foreach ( $pais_terms as $pais_term ) {
  $pais_id = $pais_term->term_id;
  $image = get_field('bandera', 'pais_' . $pais_id);
  if (!empty($image)) {
    $catimg = $image;
  } else {
    $catimg = get_stylesheet_directory_uri() . '/assets/img/bandera.jpg';
  }

}


$linea_de_trabajo_terms = wp_get_post_terms( $post->ID, 'linea_de_trabajo' );

foreach ( $linea_de_trabajo_terms as $linea_de_trabajo_term ) {

	$persona_query = new WP_Query( array(
		'post_type' => 'persona',
		'posts_per_page' => -1,
		'order' => 'ASC',
		'hide_empty' => true, // change to true if you don't want empty terms
		'tax_query' => array(
			array(
				'taxonomy' => 'linea_de_trabajo',
				'order' => 'ASC',
				'field' => 'slug',
				'terms' => array( $persona_term->slug ),
				'operator' => 'IN',

			)
		)
	) );

	?>

	<?php
	// if ( count( get_term_children( $member_group_term->term_id, 'tipo_de_persona' ) ) > 0 ) {
	// The term is children
	//if ($member_group_term->parent != 0) {

	?>
	<h2>
		<?php echo $linea_de_trabajo_term->name; ?>
	</h2>

	<ul>
		<?php
		if ( $persona_query->have_posts() ): while ( $persona_query->have_posts() ): $persona_query->the_post();
		?>
		<div class="row country-person-details mb-5">

			<div class="col-lg-2 col-3 person-img">
				<?php echo the_post_thumbnail('thumbnail'); ?>
			</div>
			<div class=" col-lg-10 col-9  person-details">
				<div class="person-name">
					<img class="country-flag" src="<?php echo $catimg; ?>'" alt="<?php echo $cat->name; ?>"> <?php echo the_title(); ?>
				</div>
				<?php echo the_content();?>
			</div>
		</div>
		<?php endwhile;
		endif; ?>
	</ul>
	<?php

	//}

	// Reset things, for good measure
	$persona_query = null;
	wp_reset_postdata();
}



?>