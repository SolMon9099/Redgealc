<?php
/**
 * The Search template file
 */
?>

<?php get_header(); ?>

<!-----------------------------------------
-- -- -- -- -- -- -- -- -- - MAIN-- -- -- -- -- -- -- --
-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -->
<main>
	<section id="#">

		<?php get_template_part('template-parts/heading-taxonomy', 'none'); ?>


		<div class="container main-content">
			<div class="row">
				<div class="col-lg-12">
					<div id="ult_not" class="news_list">

					<!--<div class="row">
						<div class="col-6">
							<h2 class="orange">Resultados para "<?php echo get_search_query(); ?>" </h2>
						</div>
						<div class="col-6 d-flex justify-content-end align-items-end">
						</div>
					</div>-->


						<?php if ( have_posts() ): ?>
						<div id="" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-3 my-1">

						<?php while( have_posts() ): ?>
						<?php the_post(); ?>

						<?php

						$thetitle = cortar( get_the_title(), 77 );
						$theexcer = cortar( get_the_excerpt(), 80 );
						$paises = get_the_terms( $post->ID, 'pais' );
						$imgurl = get_stylesheet_directory_uri() . '/assets/img/nopic.jpg';
						if ( has_post_thumbnail( $post->ID ) ) {
							$imgurl = wp_get_attachment_image_url( get_post_thumbnail_id( $post->ID ), 'home-thumb' );
						}

						$banderas = array( get_template_directory_uri() . '/assets/img/iso_logo.jpg' );
						if ( is_array( $paises ) ) {
							$banderas = array();
							foreach ( $paises as $pais ) {
								$banderas[] = get_field( 'bandera', 'pais_' . $pais->term_id );
							}
						}

						?>
						<div class="col">
							<div class="card h-100">


								<div class="ratio ratio-4x3">
									<div style="background: url(<?php echo $imgurl;?>) no-repeat center center; background-size:cover"></div>
								</div>




								<div class="card-header">
									<?php echo get_the_date("j F Y");?>
								</div>
								<div class="card-body">
									<p class="card-text">
										<a class="stretched-link" href="<?php the_permalink(); ?>">
											<?php echo $thetitle;?>
										</a>
									</p>
									<div class="d-flex justify-content-between align-items-center"> </div>
								</div>
							</div>
						</div>



						<?php endwhile; ?>
					</div>
						<div class="row" id="pagination"><div class="col d-flex justify-content-center"><?php echo wpk_get_the_posts_pagination(); ?>
</div></div>

						<?php else: ?>
						<p>
							<?php _e( 'No se han encontrado resultados', 'nd_dosth' ); ?>
						</p>
						
						
						
						
							<?php endif; ?>

				</div>
				</div>
			</div>
		</div>
	</section>
</main>
<?php get_footer(); ?>