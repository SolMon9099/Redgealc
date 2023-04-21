<?php /* Template Name: Mapa */ ?>

<?php get_header(); ?>

<!-----------------------------------------
-- -- -- -- -- -- -- -- -- - MAIN-- -- -- -- -- -- -- --
-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -->
<main>
  <?php include 'mapa/map-datos.php'; ?>
  <section class="banner-section" id="mapa">
    <div class="container" style="padding-top:25px">
      <h5><?php pll_e('Nuestras'); ?></h5>
      
      <h2><?php pll_e('LÍNEAS DE TRABAJO'); ?></h2>
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
          <?php include 'mapa/mapasvg.php'; ?>
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

  <?php get_footer(); ?>
</main>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/assets-mapa/js/jquery-3.5.1.min.js"></script>
<script>
  $(document).ready(function() {
    $('.pais').on("click", function(e) {
      var divid = $(this).attr('id');
      $('.datos').hide();
      $('#div-' + divid).show();
      $('html, body').animate({
        scrollTop: $('#header1').position().top
      }, 500);
    });
    $('.pais').on("mouseover", function(e) {
      var divid = $(this).attr('id');
      $('.paisnombre').hide();
      $('#divnom-' + divid).show();
    });
    $('.pais').on("mouseout", function(e) {
      var divid = $(this).attr('id');
      $('#divnom-' + divid).hide();
    });
  });

  function zonaout() {
    $('.datos').hide();
  }

  function mostrarLineas(id) {
    $('.mapa-caja').hide();
    $('#lineas-' + id).show();
  }

  function mostrarLinks(linea, pais) {
    /*$('.mob-linea').hide();*/
    $('#links-' + linea + '-' + pais).show();
  }

  function ocultar(div) {
    $('#' + div).hide();
  }
</script>