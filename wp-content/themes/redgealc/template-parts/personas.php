<?php

$persona_terms = wp_get_post_terms( $post->ID, 'tipo_de_persona' );

foreach ( $persona_terms as $persona_term ) {

	$persona_query = new WP_Query( array(
		'post_type' => 'persona',
		'posts_per_page' => -1,
		'order' => 'ASC',
		'hide_empty' => true, // change to true if you don't want empty terms
		'tax_query' => array(
			array(
				'taxonomy' => 'tipo_de_persona',
				'order' => 'ASC',
				'field' => 'slug',
				'terms' => array( $persona_term->slug ),
				'operator' => 'IN',

			)
		)
	) );

	?>

	<?php

	?>
	<!--<h2><?php echo $persona_term->name; ?></h2>-->

	<div>
		<?php
		if ( $persona_query->have_posts() ): while ( $persona_query->have_posts() ): $persona_query->the_post();
	/* BANDERA */
$pais_terms = wp_get_post_terms( $post->ID, 'pais' );
foreach ( $pais_terms as $pais_term ) {
  $pais_id = $pais_term->term_id;
  $pais_bandera = get_field('bandera', 'pais_' . $pais_id);
				$person_avatar = get_the_post_thumbnail_url($post->ID, 'thumbnail');
}
/* FIN BANDERA */
		?>
		<div class="row country-person-details">

			<div class="col-lg-2 col-3">
				<?php if (!empty($person_avatar)) { ?>
				<div class="person-img"  style="background-image: url('<?php echo $person_avatar; ?>')"></div>
				<?php } else { ?>
				<div class="person-img"  style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/img/avatar.png')"></div>
				<?php }  ?>
			</div>
					
			
			<div class=" col-lg-10 col-9  person-details">
				<div class="person-name">
					<?php if (!empty($pais_bandera)) { ?>
						<div class="country-flag" style="background-image: url('<?php echo $pais_bandera; ?>')"> </div>
					 <?php } else { ?>
					<img class="country-flag" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/bandera.jpg" alt="RedGEALC">
					<?php }  ?>
					
					
					<?php echo the_title(); ?>
				</div>
				<?php echo the_content();?>
			</div>
		</div>
		<?php endwhile;
		endif; ?>
	</div>
	<?php

	//}

	// Reset things, for good measure
	$persona_query = null;
	wp_reset_postdata();
}



?>