<?php
// get the terms, ordered by name
// https://developer.wordpress.org/reference/functions/get_terms/
// https://developer.wordpress.org/reference/classes/wp_term_query/__construct/
$taxonomy = 'ano';
$taxonomy2 = 'tipo_de_recurso';
$counter = 0;


$tax_terms = get_terms(
	array(
		'taxonomy' => $taxonomy,
		'hide_empty' => true, // change to true if you don't want empty terms
		'orderby' => 'name',
		'order' => 'DESC',
		'fields' => 'names', // return the term names only
	)
);
		echo '<div class="accordion accordion-flush" id="wrapper_accordion"><!--OPEN wrapper_accordion -->';

foreach ( $tax_terms as $tax_term ) { // loop through the terms



	$terms = wp_get_post_terms( $post->ID, $taxonomy2 );
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
				'taxonomy' => $taxonomy2,
				'field' => 'ID',
				'terms' => $term->term_id
			),
			array(
				'taxonomy' => $taxonomy,
				'field' => 'slug',
				'terms' => $tax_term,
			),
		),
		'post_status' => 'publish',
		'posts_per_page' => 8,
		'orderby' => 'date',
		'order' => 'ASC',
	);

	$the_query = new WP_Query( $args );


	// The Loop
	if ( $the_query->have_posts() ) {
		echo '<div class="accordion-item "><!-- OPEN accordion-item -->';

		$counter++;
?>
		<h2 class="accordion-header" id="heading-<?php echo $counter; ?>"><button class="accordion-button accordion-icon-left <?php if ($counter >1) { echo 'collapsed';} ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo $counter; ?>" aria-expanded="true" aria-controls="collapse-<?php echo $counter; ?>"><?php echo $tax_term; ?></button></h2>

		<div id="collapse-<?php echo $counter; ?>" class="wrapper_doc accordion-collapse collapse <?php if ($counter ===1) { echo 'show';} ?>" aria-labelledby="heading<?php echo $counter; ?>" data-bs-parent="#wrapper_accordion"><!-- OPEN wrapper_doc --><div class="accordion-body">
<?

		while ( $the_query->have_posts() ) {
			$the_query->the_post();

			/* BUSCA DOCUMENTOS */
		if ( have_rows( 'documentos_list' ) or ( 'enlaces_list' ) ):
			while ( have_rows( 'documentos_list' ) ): the_row();
			echo '<div class="doc_version"><!-- OPEN doc_version-->';
			echo '<i class="fa-regular fa-fw fa-file-lines"></i> <strong>' .get_the_title(). '</strong> ';
			// Get parent value.
			$titulo_del_documento = get_sub_field( 'titulo_del_documento' );
			echo '| '. $titulo_del_documento;

			// Loop over sub repeater rows.
			if ( have_rows( 'documento_files' ) ):
				while ( have_rows( 'documento_files' ) ): the_row();
			$nombre_de_la_version_del_documento = get_sub_field( 'version_del_documento' );
			$archivo_documento = get_sub_field( 'archivo_documento' );	?> 
         <a href="<? echo $archivo_documento; ?>" class = "btn btn-sm btn-outline-primary  ms-2" target = "_blank"> <? echo $nombre_de_la_version_del_documento; ?> </a>
          <?
			endwhile;
			endif;

			echo '</div><!--END doc_version-->';
			endwhile;
			endif;	
			/* FIN BUSCA DOCUMENTOS */
			/* BUSCA ENLACES */
			if ( have_rows( 'enlaces_list' ) ):
			while ( have_rows( 'enlaces_list' ) ): the_row();
			echo '<div class="doc_version"><!-- OPEN doc_version-->';
			echo '<i class="fa-solid fa-fw fa-link"></i> <strong>' .get_the_title(). '</strong> ';
			// Get parent value.
			$titulo_del_enlace = get_sub_field( 'titulo_del_enlace' );
			echo '| '. $titulo_del_enlace;

			// Loop over sub repeater rows.
			if ( have_rows( 'enlace_urls' ) ):
				while ( have_rows( 'enlace_urls' ) ): the_row();
			$nombre_de_la_version_del_enlace = get_sub_field( 'version_del_enlace' );
			$enlace_URL = get_sub_field( 'url_del_enlace' );	?> 
         <a href="<? echo $enlace_URL; ?>" class = "btn btn-sm btn-outline-primary  ms-2" target = "_blank"> <? echo $nombre_de_la_version_del_enlace; ?> </a>
          <?
			endwhile;
			endif;

			echo '</div><!--END doc_version-->';
			endwhile;
			endif;	
			/* FIN BUSCA ENLACES */

		}
			echo '</div></div><!-- END wrapper_doc-->';
			echo '</div><!-- END accordion-item-->';

	} else {
		echo '';
	}

}			echo '</div><!-- END wrapper_accordion-->';

?>