<?php

$catego = 48; /*ID Categoría */
if (is_front_page()) {
    $cantidad = 6;
} else {
    $cantidad = 3;
}

$args = [
    'post_type' => 'post',
    'orderby' => 'date',
    'order' => 'DESC',
    'category__and' => [$catego, 275], /*cat + destacadas*/
    'posts_per_page' => $cantidad,
];

$the_query = new WP_Query($args);
if ($the_query->have_posts()) {
    $the_posts = get_posts($args); ?>

<div id="noticias_destacadas" class="news_list">
	<div class="row">
		<?php	if (is_front_page()) { ?>
		<div class="col-6">
			<h2 class="orange mb-0"><?php pll_e('Últimas'); ?><br><?php pll_e('NOTICIAS'); ?></h2>
		</div>
		<div class="col-6 d-flex justify-content-end align-items-end">
			<button type="button" class="btn btn-primary"><?php pll_e('VER TODAS'); ?></button>
		</div>

		<?php } else { ?>
		<div class="col-6">
			<h2 class="orange"><?php pll_e('Destacadas'); ?></h2>
		</div>
		<div class="col-6 d-flex justify-content-end align-items-end">
		</div>
		<?php } ?>
	</div>
	<div id="" class="row row-cols-1 row-cols-lg-3 g-3 my-1">
		<?php
        foreach ($the_posts as $post) {
            setup_postdata($post);
            $thetitle = cortar(get_the_title(), 77);
            $theexcer = cortar(get_the_excerpt(), 80);
            $paises = get_the_terms($post->ID, 'pais');

            $imgurl = get_stylesheet_directory_uri().'/assets/img/nopic.jpg';
            if (has_post_thumbnail($post->ID)) {
                $imgurl = wp_get_attachment_image_url(get_post_thumbnail_id($post->ID), 'home-thumb');
            }

            $banderas = [get_template_directory_uri().'/assets/img/iso_logo.jpg'];
            if (is_array($paises)) {
                $banderas = [];
                foreach ($paises as $pais) {
                    $banderas[] = get_field('bandera', 'pais_'.$pais->term_id);
                }
            } ?>
		<div class="col">
			<div class="card h-100">
				<div class="ratio ratio-4x3">
					<div style="background: url(<?php echo $imgurl; ?>) no-repeat center center; background-size:cover"></div>
				</div>
				<div class="card-header">
					<?php echo get_the_date('j F Y'); ?>
				</div>
				<div class="card-body">
					<p class="card-text">
						<a class="stretched-link" href="<?php the_permalink(); ?>">
							<?php echo $thetitle; ?>
						</a>
					</p>
					<div class="d-flex justify-content-between align-items-center"> </div>
				</div>
			</div>
		</div>

		<?php
        }
    wp_reset_postdata(); ?>
	</div>
</div>
<?php
}
