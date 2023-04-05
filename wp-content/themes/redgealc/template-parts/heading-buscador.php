<!-- Section Banner -->
<section class="heading-section py-3 py-md-5">
	<div class="container">
		
			

		<?php
    $first_post = absint( $wp_query->get('paged') - 1 ) * $wp_query->get('posts_per_page') + 1;
    $last_post = $first_post + $wp_query->post_count;
    $all_posts = $wp_query->found_posts;
?>
		<div class="text-box">
			<span class="subheading">Se han encontrado <?php echo $all_posts; ?> resultados</span>
<!--<h1 class="primary-heading m-0">"<?php echo get_search_query(); ?>"</h1>-->
						<div class="buscador-field">
				<form action="/" method="get">
	<label for="search" class="d-none">Buscar en REDGEALC</label>
	<input type="text" class="buscador-input" name="s" id="search" value="<?php the_search_query(); ?>" />
	<button  alt="Search" style="display: flex; border: 0"> <i class="buscador-input-icon fa-solid fa-magnifying-glass"></i> </button>
</form>

				
				
				
			</div>

					
			
			
			
		

		</div>
	</div>
</section>
<!-- Section Banner -->
