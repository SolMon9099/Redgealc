<?php
$docs = get_field('documentos_list');
$links = get_field('enlaces_list');


	
if ( !empty( $docs ) or ( $links ) ) {

	//if ( have_rows( 'documentos_list' ) or ( 'enlaces_list' ) ) {
?>

<div id="enlaces_y_docs-news" class="aside-content">
	<h4>Documentos y enlaces</h4>


	<? /* BUSCA DOCUMENTOS */
while ( have_rows( 'documentos_list' ) ): the_row();

		echo '<div class="doc_version"><!-- OPEN doc_version-->';
		// Get parent value.
		$titulo_del_documento = get_sub_field( 'titulo_del_documento' );
		echo  '<i class="fa-regular fa-fw fa-file-lines"></i> </strong> '. $titulo_del_documento . '</strong> <br> ';

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
		echo  '<i class="fa-solid fa-fw fa-link"></i> </strong> '. $titulo_del_enlace . '</strong> <br>';

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

</div>
<?
}

?>