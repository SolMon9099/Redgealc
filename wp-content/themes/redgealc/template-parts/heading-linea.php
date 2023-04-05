<!-- Section Banner -->
<section class="heading-section py-3 py-md-5">
	<div class="container">
		
			<?php 
			$linea_image = get_the_post_thumbnail_url($post->ID, 'thumbnail');?>
			<img class="redicon" src="<?php echo $linea_image; ?>'" alt="Ícono de <?php the_title(); ?>">

		
		<div class="text-box">
			<?php $parent = get_post_ancestors($post->ID);
			if ($parent) {
				$parent = get_post($parent[0]);
				$parent = $parent->post_title; ?>
				<span class="subheading"><?php echo $parent; ?></span>
			<?php } ?>
			<h1 class="primary-heading m-0"><? the_title(); ?></h1>
		</div>
	</div>
</section>
<!-- Section Banner -->