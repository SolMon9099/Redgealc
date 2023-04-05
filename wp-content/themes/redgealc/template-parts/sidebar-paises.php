<div class="aside-country-select ">

	<h4 class="mb-0">PAÍSES DE LA<br>
  RED GEALC</h4>

	<h5>PERFILES Y ACTIVIDADES</h5>

	<div class="input-group filtro-form">
		<input type="text" class="form-control" placeholder="Buscar País" id="list-paises" onkeyup="filter_data('list-paises', 'a')">
		<!--<input type="text" class="form-control" placeholder="Buscar País" id="list-paises" >-->
		<span class="input-group-btn">
    <button class="btn btn-default btn_buscar_dark" type="button" onclick="filter_data('list-paises', 'a')"></button>
  </span>
	
	</div>

	<ul id="list-paises-ul" class="country-list scroll-custom-01">

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
		<li class="country-item">
			<a class="pais-href" href="<?php echo get_category_link($pais_id); ?>"> <img src="<?php echo $catimg; ?>" alt="<?php echo $cat->name; ?>">
    
        <?php echo $cat->name; ?>
      </a>
		</li>
		<?php
		}
		?>

	</ul>
</div>