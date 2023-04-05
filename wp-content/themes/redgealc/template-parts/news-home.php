<?php
$catego = 48;
$destac = 275;


if ( get_locale() == 'en_US' ) {
	$catego = 48;
	$destac = 283;
}

$cantidad = 6;
$args = array(

	'post_type' => 'post',
	'orderby' => 'date',
	'order' => 'DESC',
	'category__and' => array( $catego, $destac ),
	'posts_per_page' => $cantidad

);

$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ):
	$the_posts = get_posts( $args );
?>
<div class="row">
	<div class="col-6">
		<h2 class="orange">Últimas<br>NOTICIAS</h2>
	</div>
	<div class="col-6 d-flex justify-content-end align-items-end">
		<button type="button" class="btn btn-primary">VER TODAS</button>
	</div>
</div>
<div id="ult_not" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mt-3 mb-3">

	<?php

	foreach ( $the_posts as $post ):
		setup_postdata( $post );
	$thetitle = get_the_title();
	$imgurl = get_stylesheet_directory_uri() . '/assets/img/nopic.jpg';
	if ( has_post_thumbnail( $post->ID ) ) {
		$imgurl = wp_get_attachment_image_url( get_post_thumbnail_id( $post->ID ), 'home-thumb' );
	}
	?>
	<div class="col">
		<div class="card h-100"> 
				<img src="<?php echo $imgurl;?>" alt="<?php echo $thetitle;?>">

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
	<?php
	endforeach;
	wp_reset_postdata();
	?>
</div>
<?php
endif;