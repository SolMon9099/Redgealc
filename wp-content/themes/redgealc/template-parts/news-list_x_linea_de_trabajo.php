<?php
$linea_de_trabajo_terms = wp_get_post_terms($post->ID, 'linea_de_trabajo');
$terms_ids = [];

foreach ($linea_de_trabajo_terms as $linea_de_trabajo_term) {
    $terms_ids[] = $linea_de_trabajo_term->slug;
}

$catego = 48; /*ID Categoría noticias */
$catego2 = 69; /*ID Categoría eventos */
$cantidad = 12;
$args = [
    'post_type' => 'post',
    'orderby' => 'date',
    'order' => 'DESC',
    'category__in' => [$catego, $catego2], /*not + eventos*/
    'posts_per_page' => $cantidad,
    'tax_query' => [
        [
            'taxonomy' => 'linea_de_trabajo',
            'order' => 'ASC',
            'field' => 'slug',
            'terms' => $terms_ids,
            'operator' => 'IN',
        ],
    ],
];

$the_query = new WP_Query($args);
if ($the_query->have_posts()) {
    $the_posts = get_posts($args); ?>

<div id="ult_not" class="news_list">
	<div class="row">
		<div class="col-12">
			<h2 class="orange">Hitos destacados en torno a <?php echo $linea_de_trabajo_term->name; ?>
					</h2>
		</div>
	</div>

	<div id="" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-3 my-1">
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
