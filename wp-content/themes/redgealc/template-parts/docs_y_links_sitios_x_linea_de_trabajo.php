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


// The Loop
if ( $the_query->have_posts() ) { ?>
<h3>Sitios web</h3>
	<div class="accordion accordion-flush" id="accordion_docs_linea_sitios"><!--OPEN wrapper_accordion -->

	<? $counter = 0;

	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		?>
		<div class="accordion-item ">
			<!-- OPEN accordion-item -->
			<? $counter++;
		?>
			<h2 class="accordion-header" id="heading-docs_linea-sitios-<?php echo $counter; ?>"><button class="accordion-button accordion-icon-left <?php if ($counter >1) { echo 'collapsed';} ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-docs_linea-sitios-<?php echo $counter; ?>" aria-expanded="true" aria-controls="collapse-docs_linea-sitios-<?php echo $counter; ?>"><?php echo the_title(); ?></button></h2>
			<?
		// Check rows exist DOCUMENTOS.
		if ( have_rows( 'documentos_list' ) or ( 'enlaces_list' ) ):?>
			<div id="collapse-docs_linea-sitios-<?php echo $counter; ?>" class="wrapper_doc accordion-collapse collapse <?php if ($counter ===1) { echo 'show';} ?>" aria-labelledby="heading-docs_linea-sitios-<?php echo $counter; ?>" data-bs-parent="#accordion_docs_linea_sitios">
				<!-- OPEN wrapper_doc -->
				<div class="accordion-body"> <!-- OPEN accordion-body -->
		
		<? /* BUSCA DOCUMENTOS */
		while ( have_rows( 'documentos_list' ) ): the_row();
		echo '<div class="doc_version"><!-- OPEN doc_version-->';
		// Get parent value.
		$titulo_del_documento = get_sub_field( 'titulo_del_documento' );
		echo  '<i class="fa-regular fa-fw fa-file-lines"></i> </strong> '. $titulo_del_documento . '</strong> ';

		// Loop over sub repeater rows.
		if ( have_rows( 'documento_files' ) ):
			while ( have_rows( 'documento_files' ) ): the_row();
		$nombre_de_la_version_del_documento = get_sub_field( 'version_del_documento' );
		$archivo_documento = get_sub_field( 'archivo_documento' );
		?>
					<a href="<? echo $archivo_documento; ?>" class="btn btn-sm btn-outline-primary ms-2" target="_blank">
						<? echo $nombre_de_la_version_del_documento; ?>
					</a>
					<?
		endwhile;
		endif;
	
				echo '</div><!--END doc_version-->';
endwhile;
				/* FIN BUSCA DOCUMENTOS */
	
		
			/* BUSCA ENLACES */
		while ( have_rows( 'enlaces_list' ) ): the_row();
		echo '<div class="doc_version"><!-- OPEN doc_version-->';
		
/* BANDERA */
				$pais_terms = wp_get_post_terms( $post->ID, 'pais' );
				foreach ( $pais_terms as $pais_term ) {
					$pais_id = $pais_term->term_id;
					$pais_bandera = get_field( 'bandera', 'pais_' . $pais_id );
					$person_avatar = get_the_post_thumbnail_url($post->ID, 'thumbnail');
				}
				/* FIN BANDERA */
		
		
		
		// Get parent value.
		$titulo_del_enlace = get_sub_field( 'titulo_del_enlace' );?>

		<?php if (!empty($pais_bandera)) { ?>
						<div class="country-flag" style="background-image: url('<?php echo $pais_bandera; ?>')"> </div>
							<?php } else { ?>
							<img class="country-flag" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/bandera.jpg" alt="<?php echo $pais_term->name; ?>">
							<?php }  ?>
		
		
		<?php // Loop over sub repeater rows.
		if ( have_rows( 'enlace_urls' ) ):
			while ( have_rows( 'enlace_urls' ) ): the_row();
		$nombre_de_la_version_del_enlace = get_sub_field( 'version_del_enlace' );
		$enlace_URL = get_sub_field( 'url_del_enlace' );
		?>
					<a href="<? echo $enlace_URL; ?>" class="btn btn-sm btn-outline-primary ms-2" target="_blank">
						<? echo $nombre_de_la_version_del_enlace; ?>
					</a>
					<?
		endwhile;
		endif;
	
				echo '</div><!--END doc_version-->';
endwhile;
			/* FIN BUSCA ENLACES */
	?>


				</div><!-- END accordion-body-->
			</div> <!-- END wrapper_doc-->
			
		



		<?
		endif; ?>
		
		</div> <!-- END accordion-item-->
	<? } ?>
	</div><!-- END wrapper_accordion-->
<? } else {
	echo '';
}
/* Restore original Post Data */
wp_reset_postdata();
?>