<?php
// get the terms, ordered by name
// https://developer.wordpress.org/reference/functions/get_terms/
// https://developer.wordpress.org/reference/classes/wp_term_query/__construct/
$taxonomy = 'ano';
$taxonomy2 = 'tipo_de_persona';
$counter = 0;



$tax_terms = get_terms(
	array(
		'taxonomy' => $taxonomy,
		'post_type' => 'persona',
		'hide_empty' => true, // change to true if you don't want empty terms
		'orderby' => 'name',
		'order' => 'DESC',
		'fields' => 'all', // return all the fields
	)
);


echo '<div class="accordion accordion-flush" id="wrapper_accordion"><!--OPEN wrapper_accordion -->';

// 
$persona_terms = wp_get_post_terms($post->ID, $taxonomy2);
/*
echo '<pre>';
print_r($persona_terms);
echo '</pre>';
*/
foreach ($persona_terms as $persona_term) {
}

foreach ($tax_terms as $tax_term) {
	// loop through the terms
	$args = array(
		'post_type' => 'persona',
		'include_children' => true,
		'hide_empty' => true, // change to true if you don't want empty terms
		'tax_query' => array(
			'relation' => 'AND',
			array(
				'taxonomy' => $taxonomy,
				'field' => 'ID',
				'terms' => $tax_term->term_id,

			),
			array(
				'taxonomy' => $taxonomy2,
				'field' => 'ID',
				'terms' => $persona_term->term_id,
			),

		),
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'orderby' => 'title',
		'order' => 'DESC',
	);

	$the_query = new WP_Query($args);
	// The Loop
	if ($the_query->have_posts()) {
		echo '<div class="accordion-item "><!-- OPEN accordion-item -->';

		$counter++;
?>

		<h2 class="accordion-header " id="heading-<?php echo $counter; ?>"><button class="accordion-button accordion-icon-left  <?php if ($counter > 1) {
																																																															echo 'collapsed';
																																																														} ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo $counter; ?>" aria-expanded="true" aria-controls="collapse-<?php echo $counter; ?>"><?php echo $tax_term->name; ?></button></h2>

		<div id="collapse-<?php echo $counter; ?>" class="wrapper_doc accordion-collapse collapse <?php if ($counter === 1) {
																																																echo 'show';
																																															} ?>" aria-labelledby="heading-<?php echo $counter; ?>" data-bs-parent="#wrapper_accordion">
			<!-- OPEN wrapper_doc -->
			<div class="accordion-body">

				<?


				//This gets top layer terms only.  This is done by setting parent to 0.  
				$parent_terms = get_terms($taxonomy2, array('parent' => 0, 'orderby' => 'title', 'hide_empty' => true));

				foreach ($parent_terms as $pterm) {
					//Get the Child terms
					$p_terms = get_terms($taxonomy2, array('parent' => $pterm->term_id, 'orderby' => 'title', 'order' => 'DESC',  'hide_empty' => true));
					foreach ($p_terms as $p_term) {
						//$terms_ids[] = $p_term->term_id;

						$inner_args = array(
							'post_type' => 'persona',
							'include_children' => true,
							'tax_query' => array(
								'relation' => 'AND',
								array(
									'taxonomy' => $taxonomy,
									'field' => 'ID',
									'terms' => $tax_term->term_id,

								),
								array(
									'taxonomy' => $taxonomy2,
									'field' => 'ID',
									'terms' => $p_term->term_id,
								),

							),
							'post_status' => 'publish',
							'posts_per_page' => -1,
							'orderby' => 'title',
							'order' => 'DESC',
						);

						$inner_query = new WP_Query($inner_args);
						if ($inner_query->have_posts()) {


							echo '<h3>' . $p_term->name . '</h3>';

							while ($inner_query->have_posts()) {

								$inner_query->the_post();


								/* BANDERA */
								$pais_terms = wp_get_post_terms($post->ID, 'pais');
								foreach ($pais_terms as $pais_term) {
									$pais_id = $pais_term->term_id;
									$pais_bandera = get_field('bandera', 'pais_' . $pais_id);
									$person_avatar = get_the_post_thumbnail_url($post->ID, 'thumbnail');
								}
								/* FIN BANDERA */

				?>


								<div class="row country-person-details">

									<div class="col-lg-2 col-3">
										<?php if (!empty($person_avatar)) { ?>
											<div class="person-img" style="background-image: url('<?php echo $person_avatar; ?>')"></div>
										<?php } else { ?>
											<div class="person-img" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/img/avatar.png')"></div>
										<?php }  ?>
									</div>
									<div class=" col-lg-10 col-9 person-details">
										<div class="person-name">
											<?php if (!empty($pais_bandera)) { ?>
												<div class="country-flag" style="background-image: url('<?php echo $pais_bandera; ?>')"> </div>
											<?php } else { ?>
												<img class="country-flag" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/bandera.jpg" alt="<?php echo $pais_term->name; ?>">
											<?php }  ?>
											<?php echo the_title(); ?>
										</div>
										<?php echo the_content(); ?>
									</div>
								</div>
		<?
							}
						}
					}
				}

				echo '</div></div><!-- END wrapper_doc-->';
				echo '</div><!-- END accordion-item-->';
			} else {
			}
		}
		echo '</div><!-- END wrapper_accordion-->';
		?>