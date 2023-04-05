<?php	

$persona_terms = wp_get_post_terms( $post->ID, 'linea_de_trabajo' );
					
foreach ( $persona_terms as $persona_term ) {
	
    $persona_query = new WP_Query( array(
        'post_type' => 'persona',
		'order' => 'ASC', 
		//'parent' => '0',
        'tax_query' => array(
            array(
                'taxonomy' => 'linea_de_trabajo',
				//'child_of'   => 'autoridades',
                'order' => 'ASC', 
				'field' => 'slug',
                'terms' => array( $persona_term->slug ),
                'operator' => 'IN',
				
            )
        )
    ) );
	
    ?>
					
	<?php			
 // if ( count( get_term_children( $member_group_term->term_id, 'tipo_de_persona' ) ) > 0 ) {
    // The term is children
  	//if ($member_group_term->parent != 0) {

	 ?>	
	<h2><?php echo $persona_term->name; ?></h2>
					  
    <ul>
    <?php
    if ( $persona_query->have_posts() ) : while ( $persona_query->have_posts() ) : $persona_query->the_post(); ?>
        <li>
			<?php
		echo the_title(); 
		echo get_the_post_thumbnail();
		echo the_content();
			?>
		</li>
    <?php endwhile;
		endif; ?>
    </ul>
    <?php
		
	//}
	
    // Reset things, for good measure
    $persona_query = null;
    wp_reset_postdata();
}

				
			
			?>