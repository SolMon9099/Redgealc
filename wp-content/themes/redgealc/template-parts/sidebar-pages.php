<aside class="col-lg-3">

	<div class="aside-content">

		<?	if (!is_front_page()) { ?>

		<div class="aside-top-search p-4 mb-4">
			<h3>BUSCADOR</h3>
			<div class="buscador-field">
				<form action="/" method="get">
	<label for="search" class="d-none">Buscar en REDGEALC</label>
	<input type="text" class="buscador-input" name="s" id="search" value="<?php the_search_query(); ?>" />
	<button  alt="Search" style="display: flex"> <i class="buscador-input-icon fa-solid fa-magnifying-glass"></i> </button>
</form>

				
				
				
			</div>
		</div>

		<?	} ?>


					<?	if (is_page_template('page-lineas.php')) { 
			 get_template_part('template-parts/sidebar-sitios-linea_de_trabajo', 'none');
}
			else {
			get_template_part('template-parts/sidebar-paises', 'none');
			}
			?>
			

	</div>



	<?php

	if ( is_active_sidebar( 'sidebar_1' ) ):
		dynamic_sidebar( 'sidebar_1' );
	endif;
	?>



</aside>