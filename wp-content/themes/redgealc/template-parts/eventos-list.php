<?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$catego = 69; /*ID Categoría Eventos */
//$cantidad = 12;
$args = array(
	'post_type' => 'post',
	'orderby' => 'date',
	'order' => 'DESC',
	'cat' => 69, /*cat */
	//'posts_per_page' => $cantidad,
	'paged' => $paged,
	//'posts_per_page' => $cantidad,



);

$wp_query = new WP_Query( $args );
if ( $wp_query->have_posts() ):
	//$the_posts = get_posts( $args );?>

	<div id="eventos" class="eventos_list">
		<div class="row">
			<div class="col-6">
				<h2 class="orange">Últimos eventos
					</h2>
			</div>
			<div class="col-6 d-flex justify-content-end align-items-end">
			</div>
		</div>

		<div id="ult_eventos" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-3 my-1">


			<?php while ( $wp_query->have_posts() ): $wp_query->the_post();



		
		
		$thetitle = cortar( get_the_title(), 77 );
		$theexcer = cortar( get_the_excerpt(), 80 );
		$fecini = get_field( 'fechaini' );
		$fecfin = get_field( 'fechafin' );
		if ( $fecini == $fecfin || $fecfin == '' ) {
			$fecfin = $fecclass = '';
			$fecha = $fecini;
		} else {
			$fecclass = 'doble';
			$fecha = $fecini . ' - ' . $fecfin;
		}
		$paises = get_the_terms( $post->ID, 'pais' );
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
					<div class="card-header">

						<?php  if (!empty($fecha))  { ?>
						<div class="date <?php echo $fecclass; ?>">
							<?php echo $fecha; ?>
						</div>
						<?php } ?>
					</div>

					<div class="card-body">
						<a href="<?php the_permalink(); ?>" class="card-text">
							<?php echo $thetitle; ?>
						</a>
					</div>
					<div class="card-footer">
						<div>
							<?php
							foreach ( $banderas as $bandera ) {
								echo '<div class="flag" style="background-image: url(' . $bandera . ')"> </div>';
							}
							?>
						</div>
						<a href="<?php the_permalink(); ?>" class="read-more float-end stretched-link"> <span class="fa-stack fa-2x">
							<i class="fa-solid fa-circle fa-stack-2x"></i>
							<i class="fa-solid fa-chevron-right fa-stack-1x fa-inverse"></i>
 						</span></a>
					
					</div>
				</div>
			</div>

			<?php
			endwhile;

			?>
		</div>
		<div class="row" id="pagination">
			<div class="col d-flex justify-content-center">
				<?php echo wpk_get_the_posts_pagination(); ?>
			</div>
		</div>
	</div>
<?php wp_reset_postdata(); ?>

<?php
endif;
?>