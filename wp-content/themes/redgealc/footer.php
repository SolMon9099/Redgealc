<?php

/**
 * The theme footer
 * 
 * @package redgealc
 */
?>

<?php if (is_front_page()) {?>
	<footer>
		<div class="container">
			<div class="row">
				<?php
				$footcol = 12;
				if (is_active_sidebar('footer_1') && is_active_sidebar('footer_2')) {
					$footcol = 6;
				}
				if (is_active_sidebar('footer_1')) :
				?>
					<div class="col-<?php echo $footcol; ?>">
						<?php
						dynamic_sidebar('footer_1');
						?>
					</div>
				<?php endif;
				if (is_active_sidebar('footer_2')) :
				?>
					<div class="col-<?php echo $footcol; ?> redes">
						<?php
						dynamic_sidebar('footer_2');
						?>
					</div>
				<?php endif; ?>


			</div>
		</div>
	</footer>
<?php } else { ?>
	<footer class="footer py-3 py-md-4 py-lg-5">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-12 col-md-6 col-lg-2 d-flex flex-column justify-content-center align-items-center">
					<?php if (is_active_sidebar('footer_3_1')) :
						dynamic_sidebar('footer_3_1');
					endif; ?>
				</div>
				<div class="col-12 col-md-6 col-lg-5 d-flex flex-column justify-content-center align-items-center justify-content-center">
					<div class="d-flex gap-1 align-items-center">
						<?php if (is_active_sidebar('footer_3_2')) :
							dynamic_sidebar('footer_3_2');
						endif; ?>
					</div>
				</div>
				<div class="col-12 col-md-6 col-lg-3 d-flex flex-column justify-content-center align-items-center footer-menu mb-3 mb-lg-0">
				<?php if (is_active_sidebar('footer_3_3')) :
							dynamic_sidebar('footer_3_3');
						endif; ?>
				</div>
				<div class="col-12 col-md-6 col-lg-2">
					<div class="row d-flex flex-column justify-content-center align-items-center g-3">
					<?php if (is_active_sidebar('footer_3_4')) :
							dynamic_sidebar('footer_3_4');
						endif; ?>
					</div>
				</div>
			</div>
		</div>
	</footer>
<?php } ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
<script src="<?php echo get_stylesheet_directory_uri() ?>/assets/js/accordion.js"></script>

<script>
	function filter_data(id, type) {
		// Declare variables
		var input, filter, ul, li, a, i;
		input = document.getElementById(id);
		filter = input.value.toUpperCase();
		ul = document.getElementById(id + "-ul");
		li = ul.getElementsByTagName('li');

		// Loop through all list items, and hide those who don't match the search query
		for (i = 0; i < li.length; i++) {
			a = li[i].getElementsByTagName(type)[0];
			if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
				li[i].style.display = "";
				li[i].getElementsByTagName(type)[0].classList.remove("hidden");
				//            console.log(li[i].getElementsByTagName(type)[0]);
				//            li[i].removeClass("hidden");
			} else {
				li[i].style.display = "none";
				li[i].getElementsByTagName(type)[0].classList.add("hidden");
			}
		}
	}
</script>




</body>

</html>