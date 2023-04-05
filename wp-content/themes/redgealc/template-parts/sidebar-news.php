<aside class="col-lg-4">
	
<div id="tags_news" class="aside-content">
	
<? $tags = wp_get_post_tags($post->ID);
if($tags) {
	echo '<h4>Etiquetado como:</h4>';
	
} 
	  foreach ($tags as $tag) {
		  $tag_link = get_tag_link( $tag ) ;
		  $tag_name = $tag->name; 
echo'<a href="'. $tag_link.'" class="tag_link"> '. $tag_name.' </a>';		  
		  
	  }
 
	
	?>

	
	</div>
	
	
	
	
<?php 
/* FRONT-PAGE SLIDER WITH ACF GALLERY AND BOOTSTRAP 4 CAROUSEL */

$images = get_field('galeria_de_fotos');
$count=0;
$count1=0;

if($images) : ?>	
	
	<div id="galeria_news" class="aside-content">

		<h4>Galería de fotos</h4>

		
		
		<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
			<div class="carousel-indicators">
				<!-- Indicators -->
				<?php foreach( $images as $image ): ?>
				<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo $count; ?>" <?php if($count==0) : ?> class="active"<?php endif; ?> aria-current="true" aria-label="Slide <?php echo $count; ?>"></button>
				<?php 
		$count++;
        endforeach; ?>
			</div>

			<!-- Wrapper for slides -->
			<div class="carousel-inner">

				<?php foreach( $images as $image ): ?>
				<div class="carousel-item <?php if($count1==0) : echo ' active'; endif; ?>">
					<img src="<?php echo esc_url($image['sizes']['home-thumb']); ?>" class="d-block w-100"/>
				</div>
				<!-- item -->
				<?php $count1++; ?>
				<?php endforeach; ?>

			</div>
			<!-- carousel inner -->


			<?php /* CAROUSEL CONTROL PREVIOUS & NEXT */ ?>

			<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
		

			<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
		

		</div>
		<!-- #carousel -->
	</div>

		<?php endif; ?>		




		<?php get_template_part('template-parts/docs_y_links-news', 'none'); ?>

	
	

</aside>