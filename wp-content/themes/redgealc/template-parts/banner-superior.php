        <!-- Section Banner -->
<section class="banner-section">
	<? if ( is_page_template( 'page-con_banner.php' ) ) {
			
			the_post_thumbnail('post-thumbnail', ['class' => 'banner-img', 'title' => 'Banner', 'size' => 'full',]); 
}
			
	   if ( is_tax( 'pais' ) ) {
				   $cat2 =  get_queried_object();

	$pais_id2 = $cat2->term_id;
	$pais_img = get_field( 'imagen_del_pais', 'pais_' . $pais_id2 );?>

	<? if (!empty($pais_img)) 	{	?>
	<div class="banner-img-pais" style="background-image: url(<? echo $pais_img ?>)"> </div>




	<? }	}	?>

</section>
        <!-- Section Banner  -->