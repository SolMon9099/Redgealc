<?php 
/* FRONT-PAGE SLIDER WITH ACF GALLERY AND BOOTSTRAP 4 CAROUSEL */

$images = get_field('galeria_de_fotos');
$count=0;
$count1=0;

if($images) : ?>
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

		<?php endif; ?>