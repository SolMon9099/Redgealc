<?php
$terms = wp_get_post_terms( $post->ID, 'tipo_de_actividad' );
$pais = wp_get_post_terms( $post->ID, 'pais' );

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
			'taxonomy' => 'tipo_de_actividad',
			'field' => 'ID',
			'terms' => $term->term_id
		)
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
	<div class="accordion accordion-flush" id="wrapper_accordion"><!--OPEN wrapper_accordion -->

	<? $counter = 0;

	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		?>
		<div class="accordion-item ">
			<!-- OPEN accordion-item -->
			<? $counter++;
		?>
			<h2 class="accordion-header" id="heading-<?php echo $counter; ?>"><button class="accordion-button accordion-icon-left <?php if ($counter >1) { echo 'collapsed';} ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo $counter; ?>" aria-expanded="true" aria-controls="collapse-<?php echo $counter; ?>"><?php echo the_title(); ?></button></h2>
			<?
		// Check rows exist DOCUMENTOS.
		if ( have_rows( 'documentos_list' ) or ( 'enlaces_list' ) ):?>
			<div id="collapse-<?php echo $counter; ?>" class="wrapper_doc accordion-collapse collapse <?php if ($counter ===1) { echo 'show';} ?>" aria-labelledby="heading-<?php echo $counter; ?>" data-bs-parent="#wrapper_accordion">
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
		// Get parent value.
		$titulo_del_enlace = get_sub_field( 'titulo_del_enlace' );
		echo  '<i class="fa-solid fa-fw fa-link"></i> </strong> '. $titulo_del_enlace . '</strong> ';

		// Loop over sub repeater rows.
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