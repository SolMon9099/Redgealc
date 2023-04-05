<script type="text/javascript" src="assets-mapa/js/jquery-3.5.1.min.js"></script>

<script>
$(document).ready(function(){
  $('.pais').on("click", function(e){
    var divid = $(this).attr('id');
		$('.datos').hide();
    $('#div-'+divid).show();
  });
  $('.pais').on("mouseover", function(e){
    var divid = $(this).attr('id');
		$('.paisnombre').hide();
    $('#divnom-'+divid).show();
  });
  $('.pais').on("mouseout", function(e){
    var divid = $(this).attr('id');
    $('#divnom-'+divid).hide();
  });
});
function zonaout(){
  $('.datos').hide();
}
function mostrarLineas(id){
  $('.mapa-caja').hide();
  $('#lineas-'+id).show();
}
function mostrarLinks(linea,pais){
  /*$('.mob-linea').hide();*/
  $('#links-'+linea+'-'+pais).show();
}
function ocultar(div){
  $('#'+div).hide();
}

</script>

