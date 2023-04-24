<aside class="col-lg-3">
	<div class="aside-content">
		<?php	if (!is_front_page()) { ?>

		<div class="aside-top-search p-4 mb-4">
			<h3><?php pll_e('BUSCADOR'); ?></h3>
			<div class="buscador-field">
				<form action="/" method="get">
					<label for="search" class="d-none"><?php pll_e('Buscar en REDGEALC'); ?></label>
					<input type="text" class="buscador-input" name="s" id="search" value="<?php the_search_query(); ?>" />
					<button  alt="Search" style="display: flex"> <i class="buscador-input-icon fa-solid fa-magnifying-glass"></i> </button>
				</form>
			</div>
		</div>
<?php	} ?>

<?php
if (is_page_template('page-lineas.php')) {
    get_template_part('template-parts/sidebar-sitios-linea_de_trabajo', 'none');
} else {
    get_template_part('template-parts/sidebar-paises', 'none');
}
?>
</div>
<?php
$lang = get_locale();
if ($lang == 'es_MX') {
    if (is_active_sidebar('sidebar_1')) {
        dynamic_sidebar('sidebar_1');
    }
} elseif ($lang = 'en_US') {
    if (is_active_sidebar('sidebar_2')) {
        dynamic_sidebar('sidebar_2');
    }
}

?>

</aside>