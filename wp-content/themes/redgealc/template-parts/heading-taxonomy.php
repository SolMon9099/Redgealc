<!-- Section Banner -->
<?php $cat = get_queried_object();
    $this_tax_name = get_taxonomy($cat->taxonomy);
    $pais_id = $cat->term_id;
    $pais_bandera = get_field('bandera', 'pais_'.$pais_id);
?>

<section class="heading-section py-3 py-md-5">
	<div class="container">
		<?php if (is_tax(['pais'])) { ?>
		<img class="country_flag_profile" src="<?php echo $pais_bandera; ?>" alt="<?php echo $cat->name; ?>">
		<?php }  ?>
		<div class="text-box">
			<?php if (is_tax(['pais'])) { ?>
				<span class="subheading" style="text-transform: capitalize"><?php pll_e('País'); ?> </span>
			<?php } else {  ?>
				<span class="subheading" style="text-transform: capitalize"><?php echo $this_tax_name->labels->singular_name; ?> </span>
			<?php } ?>
			<h1 class="primary-heading m-0"><?php echo $cat->name; ?></h1>
		</div>
	</div>
</section>
<!-- Section Banner -->