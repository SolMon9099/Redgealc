<?php
$pais_terms = wp_get_post_terms($post->ID, 'pais');
if (is_tax(['pais'])) {
    $cat = get_queried_object();
    $pais_terms = [$cat];
}
foreach ($pais_terms as $pais_term) {
    $persona_query = new WP_Query([
        'post_type' => 'persona',
        'posts_per_page' => -1,
        'order' => 'ASC',
        'hide_empty' => true, // change to true if you don't want empty terms
        'tax_query' => [
        'relation' => 'AND',
            [
                'taxonomy' => 'pais',
                'order' => 'ASC',
                'field' => 'slug',
                'terms' => [$pais_term->slug],
                'operator' => 'IN',
            ],
            [
                'taxonomy' => 'tipo_de_persona',
                'order' => 'ASC',
                'field' => 'slug',
                'terms' => 'integrante-de-la-red',
                'operator' => 'IN',
            ],
        ],
    ]);

    $pais_id = $pais_term->term_id;
    $pais_bandera = get_field('bandera', 'pais_'.$pais_id); ?>

	<?php if ($persona_query->have_posts()) { ?>
		<?php if (is_page_template('page-personas_x_pais.php')) { ?>


				<h2 class="h3_listado">
					<?php if (!empty($pais_bandera)) { ?>
					<!--<img class="country-flag" src="<?php echo $pais_bandera; ?>'" alt="<?php echo $pais_term->name; ?>">-->
					<div class="country-flag" style="background-image: url('<?php echo $pais_bandera; ?>')"> </div>

					<?php } else { ?>
					<img class="country-flag" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/bandera.jpg" alt="<?php echo $pais_term->name; ?>">
					<?php }  ?>

					<?php echo $pais_term->name; ?>
				</h2>


		<?php } else {?>
		<h3><?php pll_e('Autoridades de gobierno electrónico en'); ?>&nbsp;&nbsp;<?php echo $pais_term->name; ?></h3>
		<?php } ?>

		<?php
        while ($persona_query->have_posts()) {
            $persona_query->the_post();
            $person_avatar = get_the_post_thumbnail_url($post->ID, 'thumbnail'); ?>
		<div class="row country-person-details">
			<div class="col-lg-2 col-3">
				<?php if (!empty($person_avatar)) { ?>
				<div class="person-img"  style="background-image: url('<?php echo $person_avatar; ?>')"></div>
				<?php } else { ?>
				<div class="person-img"  style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/img/avatar.png')"></div>
				<?php } ?>
			</div>
			<div class=" col-lg-10 col-9  person-details">
				<div class="person-name">
					<?php echo the_title(); ?>
				</div>
				<?php echo the_content(); ?>
			</div>
		</div>
		<?php
        }
    } ?>
	<?php
    //}

    // Reset things, for good measure
    $persona_query = null;
    wp_reset_postdata();
}

?>