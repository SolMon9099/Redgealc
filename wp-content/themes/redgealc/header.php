<!DOCTYPE html>
<!--[if lt IE 7]>  <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>     <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>     <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" <?php language_attributes(); ?>>
<!--<![endif]-->

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="Cache-Control" content="no-store" />

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<!-- CSS Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

	<!--G Fonts-->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

	<!--Icons font-->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet">




	<!--custom styles, added time() so that it wont cache the css file -->
	<link href="<?php echo get_stylesheet_directory_uri(); ?>/style.css?v=<?php echo time(); ?>" rel="stylesheet">
	<link href="<?php echo get_stylesheet_directory_uri(); ?>/style.css?v=<?php echo time(); ?>" rel="stylesheet">
	<link href="<?php echo get_stylesheet_directory_uri(); ?>/assets/fontawesome/css/fontawesome.min.css" rel="stylesheet">
	<link href="<?php echo get_stylesheet_directory_uri(); ?>/assets/fontawesome/css/brands.min.css" rel="stylesheet">
	<link href="<?php echo get_stylesheet_directory_uri(); ?>/assets/fontawesome/css/solid.min.css" rel="stylesheet">
	<?php if (is_page_template('page-mapa.php')) { ?>
		<link href="<?php echo get_stylesheet_directory_uri(); ?>/assets-mapa/css/fonts.css" rel="stylesheet">
		<link href="<?php echo get_stylesheet_directory_uri(); ?>/assets-mapa/css/mapa.css" rel="stylesheet">
	<?php } ?>

	<!--wordpress head-->
	<?php wp_head();
    ?>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-109584578-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());
		gtag('config', 'UA-109584578-1');
	</script>
</head>

<body <?php body_class(); ?>>

	<section id="header1">
		<div class="container">
			<header class="d-flex flex-wrap justify-content-center py-3">
				<?php
                if (is_active_sidebar('header_1')) {
                    dynamic_sidebar('header_1');
                }
                ?>
				<a href="<?php echo wp_login_url(); ?>" class="nav-link">LOGIN</a> <span class="pe-2 ps-2">|</span>
				<?php pll_the_languages(['show_flags' => 0, 'show_names' => 1, 'dropdown' => 1]); ?>
			</header>

		</div>
	</section>
	<section id="header2" class="border-bottom bg-light sticky-top">
		<nav class="navbar primary-nav navbar-expand-lg bg-light navbar-light  " aria-label="navbar">
			<?php
            $imgurl = get_stylesheet_directory_uri().'/assets/img/logo_redgealc.jpg';
            $custom_logo_id = get_theme_mod('custom_logo');
            $image = wp_get_attachment_image_src($custom_logo_id, 'full');
            if ($image) {
                if ($image[0] != '') {
                    $imgurl = $image[0];
                }
            }
            ?>
			<div class="container"> <a class="navbar-brand" href="<?php echo get_home_url(); ?>"><img src="<?php echo $imgurl; ?>" alt="Logo Redgealc" /> </a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
				<div class="collapse navbar-collapse" id="navbar">
					<?php
                    wp_nav_menu([
                        'theme_location' => 'main-menu',
                        'container' => false,
                        'menu_class' => '',
                        'fallback_cb' => '__return_false',
                        'items_wrap' => '<ul id="%1$s" class="navbar-nav me-auto mb-2 mb-lg-0 %2$s">%3$s</ul>',
                        'depth' => 3,
                        'walker' => new bs5_Walker(),
                    ]);
                    ?>
				</div>

			</div>
		</nav>
	</section>