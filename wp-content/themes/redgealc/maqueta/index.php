<?php $fechactu = date("Y-m-d-H"); ?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Mapa Redgealc</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet">
	-->
	<link href="assets-mapa/bootstrap.min.css " rel="stylesheet">
	<link href="assets-mapa/css2.css?fh=<?php echo $fechactu; ?>" rel="stylesheet">
	<link href="assets/css/styles.css" rel="stylesheet">
	<script src="assets-mapa/bootstrap.bundle.min.js"></script>
	<link href="assets-mapa/css/mapa.css?fh=<?php echo $fechactu; ?>" rel="stylesheet">

</head>

<body>
	<main>

		<!-----------------------------------------
-------------------HEADER 1----------------
------------------------------------------>

		<section id="header1">
			<div class="container">
				<header class="d-flex flex-wrap justify-content-center py-3 mb-4"> <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none"> <span class="me-2">Nuestros impulsores</span> <img src="assets/img/logo_impulsores.jpg" alt="Logos BID y OEA" /></a>
					<!-- <a href="#" class="nav-link">LOGIN</a> <span class="pe-2 ps-2">|</span> <a
						href="#" class="nav-link">SPANISH</a> -->
				</header>
			</div>
		</section>
		<!-----------------------------------------
-------------------HEADER 2----------------
------------------------------------------>
		<section id="header2" class="border-bottom">
			<nav class="navbar navbar-expand-lg" aria-label="navbar">
				<div class="container"> <a class="navbar-brand" href="#"> <img src="assets/img/logo_redgealc.jpg" alt="Logo Redgealc" /> </a>

					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
					<div class="collapse navbar-collapse" id="navbar">
						<ul class="navbar-nav me-auto mb-2 mb-lg-0">
							<li class="nav-item"> <a class="nav-link active" aria-current="page" href="#">SOBRE NOSOTROS</a> </li>
							<li class="nav-item"> <a class="nav-link" href="#">NUESTRAS ACTIVIDADES</a> </li>
							<li class="nav-item"> <a class="nav-link" href="#">LÍNEAS DE TRABAJO</a> </li>
							<li class="nav-item"> <a class="nav-link" href="#">PAÍSES</a> </li>
							<li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">RECURSOS DIGITALES</a>
								<ul class="dropdown-menu">
									<li><a class="dropdown-item" href="#">Action</a></li>
									<li><a class="dropdown-item" href="#">Another action</a></li>
									<li><a class="dropdown-item" href="#">Something else here</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</section>

		<!-----------------------------------------
-------------------MAIN----------------
------------------------------------------>
		<main>
			<?php include("inc/map-datos.php"); ?>
			<section class="banner-section" id="mapa">
				<div class="container" style="padding-top:25px">
					<h5>Nuestras</h5>
					<h2>LINEAS DE TRABAJO</h2>
					<div class="row" style="padding: 50px 0;">
						<div class="d-block d-md-none col-12">
							<div class="sandwich navbar" onclick="ocultar('mapaimg')">
								<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mapdata" aria-controls="mapdata" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
							</div>
							<div class="collapse navbar-collapse" id="mapdata">
								<?php
								foreach ($pais as $infos) {
									echo $infos['mobi'];
								}
								?>
							</div>
						</div>
						<div class="col-sm-12 col-md-8" id="mapaimg">
							<?php include("mapasvg.php"); ?>
						</div>
						<div class="col-4 textomapa d-none d-sm-block">
							<div class="row">
								<?php
								foreach ($pais as $infos) {
									echo $infos['desk'];
								}
								?>
							</div>
						</div>
					</div>

			</section>

			<?php //include("inactivos.php");
			?>

			<footer>
				<div class="container">
					<div class="row">
						<div class="col-6"><img src="assets/img/logo_gealc_footer.jpg" alt="logo" class="logo" /></div>
						<div class="col-6 redes"><a href="#" class="btn_rrss"> <img src="assets/img/SVG/ico_rs_fb.svg" alt="Seguinos en Facebook" /></a><a href="#" class="btn_rrss"> <img src="assets/img/SVG/ico_rs_ig.svg" alt="Seguinos en Instagram" /></a><a href="#" class="btn_rrss"> <img src="assets/img/SVG/ico_rs_yt.svg" alt="Seguinos en Youtube" /></a></div>
					</div>
				</div>
			</footer>
		</main>
		<?php include("inc/js.php"); ?>
</body>

</html>