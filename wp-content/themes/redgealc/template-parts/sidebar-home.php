<aside class="col-lg-3">

  <div class="aside-content">
	  

  <?php

  if (is_active_sidebar('sidebar_1')) {

	 get_template_part('template-parts/sidebar-paises', 'none');}
	  else {}
	  ?>

  </div>



  <?php

  if (is_active_sidebar('sidebar_1')) :

    dynamic_sidebar('sidebar_1');

  endif; ?>



</aside>