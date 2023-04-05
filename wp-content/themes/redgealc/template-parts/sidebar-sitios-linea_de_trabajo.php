<?php
$terms = wp_get_post_terms( $post->ID, 'linea_de_trabajo' );

$terms_ids = [];

foreach ( $terms as $term ) {
	$terms_ids[] = $term->term_id;
}

// The Query: docs y links
$args = array(
	'post_type' => 'enlaces_y_documentos',
	'tax_query' => array(
		'relation' => 'AND',
		array(
			'taxonomy' => 'linea_de_trabajo',
			'field' => 'ID',
			'terms' => $term->term_id,
			//'operator' => 'IN',

		),
		array(
			'taxonomy' => 'tipo_de_recurso',
			'field' => 'slug',
			'terms' => 'sitios',
			'operator' => 'IN',
		),

	),
	'post_status' => 'publish',
	'posts_per_page' => -1,
	'orderby' => 'date',
	'order' => 'ASC',
	'exclude' => $post->ID,

);

$the_query = new WP_Query( $args );
$linea_de_trabajo_name = $term->name;


// The Loop
if ( $the_query->have_posts() ) {
	?>

		<div class="aside-country-select pt-4 ps-4 pb-1 pe-4 mb-4">

	<h4>Sitios de<br>
  <? echo $linea_de_trabajo_name;?></h4>

	<h5>por país</h5>
	<div class="input-group filtro-form">
		<input type="text" class="form-control" placeholder="Buscar País" id="list-paises" onkeyup="filter_data('list-paises', 'a')">
		<!--<input type="text" class="form-control" placeholder="Buscar País" id="list-paises" >-->
		<span class="input-group-btn">
    <button class="btn btn-default btn_buscar_dark" type="button" onclick="filter_data('list-paises', 'a')"></button>
  </span>
	
	</div>
	<ul id="list-paises-ul" class="country-list scroll-custom-01">

		<? 
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		
		
/* BUSCA ENLACES */
		while ( have_rows( 'enlaces_list' ) ): the_row();
		
/* BANDERA */
				$pais_terms = wp_get_post_terms( $post->ID, 'pais' );
				foreach ( $pais_terms as $pais_term ) {
					$pais_id = $pais_term->term_id;
					$pais_name = $pais_term->name;
					$pais_bandera = get_field( 'bandera', 'pais_' . $pais_id );
				}
				/* FIN BANDERA */
		
		
		
		// Get parent value.
		//$titulo_del_enlace = get_sub_field( 'titulo_del_enlace' );?>



		<?php // Loop over sub repeater rows.
		if ( have_rows( 'enlace_urls' ) ):
			while ( have_rows( 'enlace_urls' ) ): the_row();
		$nombre_de_la_version_del_enlace = get_sub_field( 'version_del_enlace' );
		$enlace_URL = get_sub_field( 'url_del_enlace' );
		?>
		<li class="country-item">
			<div class="country-flag" style="background-image: url('<?php echo $pais_bandera; ?>')"> </div>
			<a class="pais-href" href="<? echo $enlace_URL; ?>" title="<?php echo the_title(); ?>" target="_blank">
				<?php echo $pais_name; ?>
			</a>
		</li>

		<?
		endwhile;
		endif;
	
				
endwhile;
			/* FIN BUSCA ENLACES */	
		
 	}		?>


	</ul>
					</div>

	<?
} else {
	echo '';
}
/* Restore original Post Data */
wp_reset_postdata();
?>