<div class="">


	<? the_content(); ?>

	

	<div id="paises_list" class="row">

		<?php

		$args = array(
			"hide_empty" => 0,
			'taxonomy' => 'pais',
			'orderby' => 'name',
			'order' => 'ASC'
		);



		$cats = get_categories( $args );

		foreach ( $cats as $cat ) {
			$pais_id = $cat->term_id;
			$image = get_field( 'bandera', 'pais_' . $pais_id );
			if ( !empty( $image ) ) {
				$catimg = $image;
			} else {
				$catimg = get_stylesheet_directory_uri() . '/assets/img/bandera.jpg';
			}
			?>
		<div class="col-md-4 col-sm-6 mb-4 country-item">
			<a class="pais-href" href="<?php echo get_category_link($pais_id); ?>"> <img src="<?php echo $catimg; ?>" alt="<?php echo $cat->name; ?>">
    
        <?php echo $cat->name; ?>
      </a>
		</div>
		<?php
		}
		?>

	</div>
</div>