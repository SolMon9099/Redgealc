<?php get_header(); ?>

<!-----------------------------------------
-- -- -- -- -- -- -- -- -- - MAIN-- -- -- -- -- -- -- --
-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -->
<main>
	<section id="">

		<?php get_template_part('template-parts/heading', 'none'); ?>


		<div class="container main-content">
			<div class="row g-5">
				<div class="col-lg-8">
					<!--TITULO-->
					<h2 class="mb-5">
						<?php the_title();  ?>
					</h2>
					<!--IMAGEN-->
					<?php the_post_thumbnail('post-thumbnail', ['class' => 'img-responsive w-100 h-auto mb-5']);?>
					
					
					<div class="meta-info">
						<!--AUTOR / PAIS-->
<div class="meta-autor"> Por
					<?php
					$pais_terms = wp_get_post_terms( $post->ID, 'pais' );
						
	if ( !empty( $pais_terms ) ) {
					foreach ( $pais_terms as $pais_term ) {
						$pais_id = $pais_term->term_id;
						
					$pais_bandera = get_field( 'bandera', 'pais_' . $pais_id );
						$pais_bandera_img = $pais_bandera;
						$pais_name = $pais_term->name;
						$pais_link = get_term_link( $pais_term );?>
					
					 <a href="<?php echo $pais_link; ?> " target="_self"><span class="country-flag" style="background-image: url('<?php  echo esc_url($pais_bandera_img); ?>')" alt="<?php echo $pais_name ?>"> </span> 
						<?php echo $pais_name; ?></a>
					
					<? } 
						}
	
	
	
							
							else {
						$pais_bandera_img = get_stylesheet_directory_uri() . '/assets/img/bandera.jpg';
						$pais_name = 'REDGEALC';
						$pais_link = '#';
						
							
	
	?>
	
					 <a href="<?php echo $pais_link; ?> " target="_self"><span class="country-flag" style="background-image: url('<?php  echo esc_url($pais_bandera_img); ?>')" alt="<?php echo $pais_name ?>"> </span> 
						<?php echo $pais_name; ?></a>
						
						
						<?   } ?>
						
						</div>
						
						<!--SHARE-->
						<? echo do_shortcode( '[addtoany]' );?>

</div>
					
					
					
					<!--TAGS-->

						
					<!--FECHA-->
						


						
						
				
					
				










					<?php the_content(); ?>


				</div>







				<?php get_template_part('template-parts/sidebar-news', 'none'); ?>




			</div>
		</div>
	</section>

	<?php get_footer(); ?>
</main>
<script>
	function filter_data( id, type ) {
		// Declare variables
		var input, filter, ul, li, a, i;
		input = document.getElementById( id );
		filter = input.value.toUpperCase();
		ul = document.getElementById( id + "-ul" );
		li = ul.getElementsByTagName( 'li' );

		// Loop through all list items, and hide those who don't match the search query
		for ( i = 0; i < li.length; i++ ) {
			a = li[ i ].getElementsByTagName( type )[ 0 ];
			if ( a.innerHTML.toUpperCase().indexOf( filter ) > -1 ) {
				li[ i ].style.display = "";
				li[ i ].getElementsByTagName( type )[ 0 ].classList.remove( "hidden" );
				//            console.log(li[i].getElementsByTagName(type)[0]);
				//            li[i].removeClass("hidden");
			} else {
				li[ i ].style.display = "none";
				li[ i ].getElementsByTagName( type )[ 0 ].classList.add( "hidden" );
			}
		}
	}
</script>