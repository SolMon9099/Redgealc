<?php /* Template Name: Con banner superior */ ?>

<?php get_header(); ?>

<!-----------------------------------------
-------------------MAIN----------------
------------------------------------------>
<main>
  <?php get_template_part('template-parts/heading', 'none'); ?>
  <?php get_template_part('template-parts/banner-superior', 'none'); ?>
  <section class="section-notice py-3 py-md-5">
    <div class="container">
      <div class="row gy-4">
        <div class="col-md-7 col-lg-8">
          <?php $extracto = get_field('extracto');
          if($extracto != ''){echo '<h6 class="description-primary mb-2 mb-md-4">'.$extracto.'</h6>';} ?>
          <?php the_content(); ?>
        </div>
        <?php get_template_part('template-parts/sidebar-pages', 'none'); ?>
      </div>
    </div>
  </section>

  <?php get_footer(); ?>
</main>
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