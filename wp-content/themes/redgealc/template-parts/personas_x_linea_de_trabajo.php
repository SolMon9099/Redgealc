<?php

$linea_de_trabajo_terms = wp_get_post_terms($post->ID, 'linea_de_trabajo');

$counter = 0;

foreach ($linea_de_trabajo_terms as $linea_de_trabajo_term) {
	$persona_query = new WP_Query(array(
		'post_type' => 'persona',
		'posts_per_page' => -1,
		'order' => 'ASC',
		'hide_empty' => true, // change to true if you don't want empty terms
		'tax_query' => array(
			array(
				'taxonomy' => 'linea_de_trabajo',
				'order' => 'ASC',
				'field' => 'slug',
				'terms' => array($linea_de_trabajo_term->slug),
				'operator' => 'IN',

			)
		)
	));

	if ($persona_query->have_posts()) { ?>
		<? if (is_page_template('page-lineas.php')) { ?>
			<h3>Grupo de trabajo</h3>
		<? } ?>

		<div class="accordion accordion-flush" id="accordion_personas_linea">
			<!--OPEN wrapper_accordion -->

			<?php $counter++;  ?>
			<div class="accordion-item ">
				<!-- OPEN accordion-item -->
				<h2 class="accordion-header" id="heading-<?php echo $counter; ?>"><button class="accordion-button accordion-icon-left <?php if ($counter > 1) {
																																																																echo 'collapsed';
																																																															} ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-personas_linea-<?php echo $counter; ?>" aria-expanded="true" aria-controls="collapse-personas_linea-<?php echo $counter; ?>">
						<?php if (is_page_template('page-lineas.php')) {
							echo 'Grupo de trabajo de ';
						} ?><?php echo $linea_de_trabajo_term->name; ?></button></h2>


				<div id="collapse-personas_linea-<?php echo $counter; ?>" class="wrapper_doc accordion-collapse collapse <?php if ($counter === 1) {
																																																										echo 'show';
																																																									} ?>" aria-labelledby="heading<?php echo $counter; ?>" data-bs-parent="#accordion_personas_linea">
					<!-- OPEN wrapper_doc -->
					<div class="accordion-body">

						<?php
						while ($persona_query->have_posts()) : $persona_query->the_post();


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

								<div class="col-lg-3 col-4">
									<?php if (!empty($person_avatar)) { ?>
										<div class="person-img" style="background-image: url('<?php echo $person_avatar; ?>')"></div>
									<?php } else { ?>
										<div class="person-img" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/img/avatar.png')"></div>
									<?php }  ?>
								</div>
								<div class=" col-lg-9 col-8  person-details">
									<div class="person-name">
										<?php if (!empty($pais_bandera)) { ?>
											<div class="country-flag" style="background-image: url('<?php echo $pais_bandera; ?>')"> </div>
										<?php } else { ?>
											<img class="country-flag" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/bandera.jpg" alt="<?php echo $pais_term->name; ?>">
										<?php }  ?>

										<?php the_title(); ?>
									</div>
									<?php the_content(); ?>
								</div>
							</div>

						<?php

						endwhile;
						?>
					</div> <!-- END accordion-body-->
				</div> <!-- END collapse persona-->
				<!-- END wrapper_doc-->
			</div> <!-- END accordion-item-->
		</div> <!-- END accordion-flash-->
	<?php } // END IF HAVE POSTS

	// Reset things, for good measure
	$persona_query = null;
	wp_reset_postdata(); ?>
<?php } ?>