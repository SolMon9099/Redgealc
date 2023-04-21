<?php

// get the terms, ordered by name
// https://developer.wordpress.org/reference/functions/get_terms/
// https://developer.wordpress.org/reference/classes/wp_term_query/__construct/
$taxonomy = 'ano';
$taxonomy2 = 'linea_de_trabajo';
$taxonomy3 = 'tipo_de_actividad';
$counter = 0;
$showContents = 0;
$mostrar = '';

$tax_terms = get_terms(
    [
        'taxonomy' => $taxonomy,
        'hide_empty' => true, // change to true if you don't want empty terms
        'orderby' => 'name',
        'order' => 'DESC',
        'fields' => 'names', // return the term names only
    ]
);

//if (is_array($tax_terms) && !empty($tax_terms)) {
if (!empty($tax_terms)) {
    $mostrar = '<h3>Acciones</h3>
<div class="accordion accordion-flush" id="accordion_acciones"><!--OPEN wrapper_accordion -->';

    foreach ($tax_terms as $tax_term) { // loop through the terms
    $terms = wp_get_post_terms($post->ID, $taxonomy2); // linea de trabajo
    $terms_ids = [];

        foreach ($terms as $term) {
            $terms_ids[] = $term->term_id;
        }

        // The Query: docs y links
        $args = [
        'post_type' => 'enlaces_y_documentos',
        'tax_query' => [
            'relation' => 'AND',
            [
                'taxonomy' => $taxonomy2,
                'field' => 'ID',
                'terms' => $terms_ids,
                'operator' => 'IN',
            ],
            [
                'taxonomy' => $taxonomy,
                'field' => 'slug',
                'terms' => $tax_term,
            ],
            [
                'taxonomy' => $taxonomy3,
                'field' => 'slug',
                'terms' => 'acciones',
            ],
        ],
        'post_status' => 'publish',
        'posts_per_page' => 8,
        'orderby' => 'date',
        'order' => 'ASC',
    ];

        $the_query = new WP_Query($args);

        // The Loop
        if ($the_query->have_posts()) {
            $showContents = 1;
            $mostrar .= '<div class="accordion-item "><!-- OPEN accordion-item -->';

            ++$counter;

            $mostrar .= '
		<h2 class="accordion-header" id="heading-docs_acciones-'.$counter.'"><button class="accordion-button accordion-icon-left ';
            if ($counter > 1) {
                $mostrar .= 'collapsed';
            }
            $mostrar .= '" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-docs_acciones-'.$counter.'" aria-expanded="true" aria-controls="collapse-docs_acciones-'.$counter.'">'.$tax_term.'</button></h2>

		<div id="collapse-docs_acciones-'.$counter.'" class="wrapper_doc accordion-collapse collapse ';
            if ($counter === 1) {
                $mostrar .= 'show';
            }
            $mostrar .= '" aria-labelledby="heading-docs_acciones-'.$counter.'" data-bs-parent="#accordion_acciones"><!-- OPEN wrapper_doc --><div class="accordion-body">
		';

            while ($the_query->have_posts()) {
                $the_query->the_post();

                /* BUSCA DOCUMENTOS */
                if (have_rows('documentos_list') or ('enlaces_list')) {
                    while (have_rows('documentos_list')) {
                        the_row();
                        $mostrar .= '<div class="doc_version"><!-- OPEN doc_version-->';
                        $mostrar .= '<i class="fa-regular fa-fw fa-file-lines"></i>';
                        // Get parent value.
                        $titulo_del_documento = get_sub_field('titulo_del_documento');
                        $mostrar .= ' '.$titulo_del_documento;

                        // Loop over sub repeater rows.
                        if (have_rows('documento_files')) {
                            while (have_rows('documento_files')) {
                                the_row();
                                $nombre_de_la_version_del_documento = get_sub_field('version_del_documento');
                                $archivo_documento = get_sub_field('archivo_documento');
                                $mostrar .= '<a href="'.$archivo_documento.'" class = "btn btn-sm btn-outline-primary  ms-2" target = "_blank">'.$nombre_de_la_version_del_documento.'</a>';
                            }
                        }

                        $mostrar .= '</div><!--END doc_version-->';
                    }
                }
                /* FIN BUSCA DOCUMENTOS */
                /* BUSCA ENLACES */
                if (have_rows('enlaces_list')) {
                    while (have_rows('enlaces_list')) {
                        the_row();
                        $mostrar .= '<div class="doc_version"><!-- OPEN doc_version-->';
                        $mostrar .= '<i class="fa-solid fa-fw fa-link"></i>';
                        // Get parent value.
                        $titulo_del_enlace = get_sub_field('titulo_del_enlace');
                        $mostrar .= ' '.$titulo_del_enlace;

                        // Loop over sub repeater rows.
                        if (have_rows('enlace_urls')) {
                            while (have_rows('enlace_urls')) {
                                the_row();
                                $nombre_de_la_version_del_enlace = get_sub_field('version_del_enlace');
                                $enlace_URL = get_sub_field('url_del_enlace');
                                $mostrar .= '<a href="'.$enlace_URL.'" class = "btn btn-sm btn-outline-primary  ms-2" target = "_blank">'.$nombre_de_la_version_del_enlace.' </a>';
                            }
                        }

                        $mostrar .= '</div><!--END doc_version-->';
                    }
                }
                /* FIN BUSCA ENLACES */
            }
            $mostrar .= '</div></div><!-- END wrapper_doc-->';
            $mostrar .= '</div><!-- END accordion-item-->';
        } else {
            //echo '';
        }
    }

    $mostrar .= '</div><!-- END wrapper_accordion-->';
    if ($showContents == 1) {
        echo $mostrar;
    }
} else {
    echo 'vacio';
}
