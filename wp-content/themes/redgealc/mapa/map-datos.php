<?php
function normaliza($nom)
{
  $or = array(" ", "á", "é", "í", "ó", "ú", "ñ");
  $de = array("_", "a", "e", "i", "o", "u", "n");
  return str_replace($or, $de, strtolower($nom));
}
function zonas($nom, $lineas, $links)
{
  $id = normaliza($nom);
  //echo '<br>'.$id;
  $ret = array();
  $dev = $mobile = '';
  // PAISES
  $mobile .= '<div class="mob-pais map-lists text-uppercase" onclick="mostrarLineas(\'' . $id . '\')">' . $nom . '</div>';
  // CAJA DE LINEAS
  $mobile .= '<div class="mapa-caja lineas-pais" id="lineas-' . $id . '">';
  // CADA LINEA DEL PAIS
  foreach ($lineas as $lineaID => $lineaNom) {
    //if ($linum == 3) { // SOLO MOSTRAMOS SOFTWARE PUBLICO. QUITAR PARA VER TODO.
    $haylink = 0;
    $linclass = '';
    if (!empty($links[$lineaID])) {
      $haylink = 1;
      $linclass = 'active';
    }
    $mobile .= '<div class="mob-linea map-lists text-uppercase ' . $linclass . '"';
    if ($haylink == 1) {
      $mobile .= 'onclick="mostrarLinks(' . $lineaID . ',\'' . $id . '\')"';
    }
    $mobile .= '>';
    $mobile .= $lineaNom;
    $mobile .= '</div>';
    // LINKS DE LA LINEA
    if ($haylink == 1) {
      $mobile .= '<div class="mapa-caja links-pais" id="links-' . $lineaID . '-' . $id . '">';
      //$mobile.= '<h2>'.$nom.'</h2><br><h4>'.$linea.'</h4>';
      foreach ($links[$lineaID] as $link) {
        $datolink = explode("***", $link);
        $mobile .= '<div class="map-data"><a target="_blank" href="' . $datolink[0] . '">' . $datolink[1] . '</a></div>';
      }
      $mobile .= '</div>';
    }
  }
  //}
  $mobile .= '</div>';
  /*$dev =.'
  <div id="divnom-' . $id . '" class="texto datos paisnombre col-4">
  <div class="datit">' . $nom . '</div>
  </div>';*/
  $dev .= '<div id="div-' . $id . '" class="texto datos col-8">
    <div class="datce"><button class="btn btn-cerrar" onclick="zonaout()">X</button></div>
    <div class="datit">' . $nom . '</div>
    <div class="accordion" id="lineasPaises">
    ';
  foreach ($lineas as $lineaID => $lineaNom) {
    if (!empty($links[$lineaID])) {
      $dev .= '
    
    <div class="accordion-item">
      <h2 class="accordion-header lineas_tit" id="heading' . $lineaID . '">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' . $lineaID . '" aria-expanded="true" aria-controls="collapse' . $lineaID . '">
        ' . $lineaNom . '
        </button>
      </h2>
      <div id="collapse' . $lineaID . '" class="accordion-collapse collapse" aria-labelledby="heading' . $lineaID . '" data-bs-parent="#lineasPaises">
        <div class="accordion-body datmi">
          <ul>
        ';
      foreach ($links[$lineaID] as $link) {
        $datolink = explode("***", $link);
        if($datolink[1] == ''){$datolink[1] = $datolink[0];} // Si no hay título, muestra el link
        $dev .= '<li><a target="_blank" href="' . $datolink[0] . '">' . $datolink[1] . '</a>';
      }
      $dev .= '
          </ul>
        </div>
      </div>
    </div>
    ';
    }
  }
  $dev .= '</div></div>';
  $ret['desk'] = $dev;
  $ret['mobi'] = $mobile;
  return $ret;
}

//$lineas = array('Firma Digital', 'Interoperabilidad', 'Innovación', 'Software Público', 'Tecnologías Emergentes', 'Datos Abiertos', 'Ciberseguridad', 'Mediciones', 'Coronavirus');

$args = array(
  "hide_empty" => false,
  'taxonomy' => 'linea_de_trabajo',
  'orderby' => 'name',
  'order'   => 'ASC'
);
$lineas = array();
$cats = get_categories($args);
foreach ($cats as $cat) {
  $lin_id = $cat->term_id;
  $lin_nom = $cat->name;
  $lineas[$lin_id] = $lin_nom;
}
//print_r($lineas);
//$paises = array('Argentina', 'Bolivia', 'Brasil', 'Chile', 'Colombia', 'Ecuador', 'Paraguay', 'Perú', 'Uruguay');

$args = array(
  "hide_empty" => 0,
  'taxonomy' => 'pais',
  'orderby' => 'name',
  'order'   => 'ASC'
);

$cats = get_categories($args);
$paises = array();
foreach ($cats as $cat) {
  $pais_id = $cat->term_id;
  $pais_nom = $cat->name;
  $paises[$pais_id] = $pais_nom;
}
//print_r($paises);
/*
$paises = array('Antigua and Barbuda', 'Argentina', 'Bahamas', 'Barbados', 'Belice', 'Bolivia', 'Brasil', 'Canadá', 'Chile', 'Colombia', 'Costa Rica', 'Dominica', 'Ecuador', 'El Salvador', 'Grenada', 'Guatemala', 'Haití', 'Honduras', 'Jamaica', 'México', 'Nicaragua', 'Panamá', 'Paraguay', 'Perú', 'República Dominicana', 'St. Kitts Nevis', 'St. Lucía', 'Suriname', 'Trinidad and Tobado', 'Uruguay', 'Venezuela');
*/
$pais = array();

// Primero pasamos países sin datos para que aparezcan en el mapa
/*
foreach ($paises as $id => $nompais) {
  $empty = array();
  $pais[$id] = zonas($paises[$id], $lineas, $empty);
}
*/








foreach ($paises as $PaisID => $nompais) {
  //foreach ($lineas as $lineaID => $nomlin) {

  /*
    $args = array(
      'post_type' => 'enlaces_y_documentos',
      'tax_query' => array(
        'relation' => 'AND',
        array(
          'taxonomy' => 'tipo_de_recurso',
          'field'    => 'slug',
          'terms'    => 'mapa'
        ),
        array(
          'taxonomy' => 'pais',
          'field'    => 'ID',
          'terms'    => $PaisID
        )
      )
    );
    */

  $args = array(
    'post_type' => 'enlaces_y_documentos',
    'tax_query' => array(
      'relation' => 'AND',
      array(
        'taxonomy' => 'pais',
        'field'    => 'ID',
        'terms'    => $PaisID
      )
    )
  );


  $the_query = new WP_Query($args);

  // The Loop
  if ($the_query->have_posts()) {
    //echo '<br>Pais: ' . $nompais;
    //echo '<br>Linea: ' . $nomlin;
    $counter = 0;
    $links = array();
    while ($the_query->have_posts()) {
      $the_query->the_post();
      /*
        echo '<pre>';
        print_r($the_query);
        echo '</pre>';
        */
      $postid = get_the_ID();
      $post_lineas = get_the_terms($postid, 'linea_de_trabajo');
      if(isset($post_lineas[0])){
      
        /*
        echo '<pre>';
        print_r($post_lineas[0]);
        echo '</pre>';
        */
        //echo $post_lineas[0] -> name;
        $lineaID = $post_lineas[0]->term_id;
        //echo '<br>Linea: '.$lineaID;
        if (get_field('enlaces_list', $postid)) {
          //echo '<ul>';
          /*
            echo '<pre>';
            print_r(get_field('enlaces_list', $postid));
            echo '</pre>';
            */
          while (the_repeater_field('enlaces_list', $postid)) {
            $linktit = get_sub_field('titulo_del_enlace');
            //echo '<li>Titulo = ' . $linktit;
            $enlacefull = get_sub_field('enlace_urls');
            $linkurl = $enlacefull[0]['url_del_enlace'];
            //echo '<li>Link = ' . $linkurl;

            $links[$lineaID][] = $linkurl . '***' . $linktit;

            //echo '</li>';
          }
          //echo '</ul>';
        }
      }
    }
    /*
      echo '<br>Links: ';
      print_r($links);
      */
    $pais[$PaisID] = zonas($paises[$PaisID], $lineas, $links);
  }
  //}
}















/*


$links = array();
$links[3] = array(
  'https://gitlab.com/dna2' => 'DNA',
  'https://github.com/argob/poncho' => 'Poncho',
  'https://github.com/argob/cofra' => 'Cofra',
  'https://github.com/argob/barra-de-accesibilidad' => 'Barra de accesibilidad',
  'https://github.com/datosgobar/consulta-publica' => 'Consulta pública',
  'https://github.com/argob/elk-bi' => 'ELK',
  'https://github.com/datosgobar/textar' => 'Textar'
);
$idp = 1;
$pais[$idp] = zonas($paises[$idp], $lineas, $links); // Argentina

$links = array();
$links[3] = array(
  'https://gitlab.softwarelibre.gob.bo/albertoinch/node-pdfsig' => 'Firma Digital',
  'https://gitlab.softwarelibre.gob.bo/adsib/jacobitus' => 'Firma Digital 2',
  'https://gitlab.softwarelibre.gob.bo/Franco/reserva-ambientes' => 'Gestión',
  'https://gitlab.softwarelibre.gob.bo/adsib/verificar_firma_documento' => 'Firma Digital 3'
);
$idp = 5;
$pais[$idp] = zonas($paises[$idp], $lineas, $links); // Bolivia

$links = array();
$links[3] = array(
  'https://www.gov.br/pt-br/apps/coronavirus-sus' => 'Aplicación Coronavirus-SUS',
  'https://github.com/spbgovbr/gepnet' => 'Gepnet',
  'https://www.gov.br/governodigital/pt-br/software-publico/catalogo/modulosSEI' => 'Módulos para el SEI',
  'https://github.com/spbgovbr/Sistema_Programa_de_Gestao_Susep' => 'Sistema: Programa de Gestión SUSEP',
  'https://github.com/spbgovbr/Sistema_Programa_de_Gestao_de_Demandas_CGU-MMA' => 'Sistema: Programa de Gestión de la Demanda CGU/MMA'
);
$idp = 6;
$pais[$idp] = zonas($paises[$idp], $lineas, $links); // Brasil

$links = array();
$links[3] = array('https://simple.gob.cl/' => 'Simple');
$idp = 8;
$pais[$idp] = zonas($paises[$idp], $lineas, $links); // Chile

$links = array();
$links[3] = array(
  'https://youtu.be/XRDVaAOGMmc' => 'Datos',
  'https://youtu.be/lOYTuWnnEV8' => 'Business Intelligence',
  'https://youtu.be/ZSvoPpSdKGs' => 'Datos',
  'https://youtu.be/najpXgFKThM' => 'Datos',
  'https://www.youtube.com/watch?v=bI_rwoDw4f4&t=15s' => 'Tecnologías Emergentes',
  'https://youtu.be/QU-eQeRslMo' => 'Base de Datos',
  'https://www.youtube.com/watch?v=zwWZWkDu_RE' => 'Datos Abiertos',
  'https://www.youtube.com/watch?v=pCN36Un6kVM' => 'Datos',
  'https://youtu.be/qfqvj1JFe-I' => 'Tecnologías Emergentes',
  'https://www.youtube.com/watch?v=ZBTp6byQB38' => 'Interoperabilidad'
);
$idp = 9;
$pais[$idp] = zonas($paises[$idp], $lineas, $links); // Colombia

$links = array();
$links[3] = array(
  'https://www.softwarepublico.gob.ec/gestion-de-archivos/' => 'SISTEMA DE ARCHIVO',
  'https://www.softwarepublico.gob.ec/gestion-de-archivos/#1' => 'ARCHIVO VIRTUAL',
  'https://www.softwarepublico.gob.ec/barra-web-politica-de-privacidad/' => 'Barra web - Política de privacidad',
  'https://www.softwarepublico.gob.ec/gestion-de-correspondencia/' => 'Gestión de correspondencia',
  'https://www.softwarepublico.gob.ec/despliegue-de-informacion/#1' => 'BIBLIOTECA DIGITAL',
  'https://www.softwarepublico.gob.ec/despliegue-de-informacion/#2' => 'GENERACIÓN DE FIRMA INSTITUCIONAL',
  'https://www.softwarepublico.gob.ec/despliegue-de-informacion/#3' => 'SISTEMA DE AGENDA MINISTERIAL',
  'https://www.softwarepublico.gob.ec/despliegue-de-informacion/#4' => 'SISTEMA DE GESTIÓN DE FORMULARIOS',
  'https://www.softwarepublico.gob.ec/despliegue-de-informacion/#5' => 'SISTEMA DE SEGUIMIENTO DE DISPOSICIONES MINISTERIALES ',
  'https://www.softwarepublico.gob.ec/gestion-de-documentos/' => 'SISTEMA DE GESTIÓN DOCUMENTAL QUIPUX',
  'https://www.softwarepublico.gob.ec/gestion-de-documentos/#1' => 'SISTEMA DE GESTIÓN DOCUMENTAL CHASQUI',
  'https://www.softwarepublico.gob.ec/gestion-de-documentos/#2' => 'GESTIÓN DOCUMENTAL',
  'https://www.softwarepublico.gob.ec/gestion-de-documentos/#3' => 'CONTENEDOR DE ARCHIVOS LOTAIP',
  'https://www.softwarepublico.gob.ec/gestion-de-documentos/#4' => 'SISTEMA DE GESTIÓN DOCUMENTAL DE LA POLICÍA NACIONAL DEL ECUADOR (DOCPOL2)',
  'https://www.softwarepublico.gob.ec/gestion-de-documentos/#5' => 'SISTEMA DOCUMENTAL',
  'https://www.softwarepublico.gob.ec/gestion-empresarial/' => 'SIR SISTEMA INTEGRAL DE RIESGO',
  'https://www.softwarepublico.gob.ec/gestion-empresarial/#1' => 'SOFTWARE DE ESTUDIO DE MERCADO',
  'https://www.softwarepublico.gob.ec/gestion-empresarial/#2' => 'ADDIS',
  'https://www.softwarepublico.gob.ec/gestion-empresarial/#3' => 'SISTEMA DE CONTRATACIÓN DE TECNOLOGÍAS DE LA INFORMACIÓN, CTI',
  'https://www.softwarepublico.gob.ec/gestion-empresarial/#4' => 'PLATAFORMA PARA EL REGISTRO ÚNICO DE TRÁMITES Y REGULACIONES (RUTER)',
  'https://www.softwarepublico.gob.ec/gestion-empresarial/#5' => 'PLANTILLAS WEB GUBERNAMENTALES HOMOLOGADAS',
  'https://www.softwarepublico.gob.ec/gestion-empresarial/#6' => 'SISTEMA SIADI',
  'https://www.softwarepublico.gob.ec/gestion-empresarial/#7' => 'SISTEMA INDICADORES GPR',
  'https://www.softwarepublico.gob.ec/gestion-empresarial/#8' => 'PANEL DE REPORTES',
  'https://minka.gob.ec/mintel/ge/firmaec' => 'FirmaEC',
  'https://www.softwarepublico.gob.ec/gestion-juridica/' => 'SISTEMA DE PÓLIZAS',
  'https://www.softwarepublico.gob.ec/gestion-juridica/#1' => 'JUICIOS',
  'https://www.softwarepublico.gob.ec/gestion-juridica/#2' => 'SYSGARANTIAS',
  'https://www.softwarepublico.gob.ec/gestion-juridica/#3' => 'SISTEMA JURÍDICO',
  'https://www.softwarepublico.gob.ec/gestion-financiera-2/' => 'SISTEMA INFORMÁTICO PARA LA ECONOMÍA POPULAR Y SOLIDARIA',
  'https://www.softwarepublico.gob.ec/gestion-financiera-2/#1' => 'SISTEMA INTEGRADO DE RECAUDACIÓN - SIR',
  'https://www.softwarepublico.gob.ec/gestion-financiera-2/#2' => 'SISTEMA ADMINISTRATIVO FINANCIERO - SAF',
  'https://www.softwarepublico.gob.ec/gestion-financiera-2/#3' => 'SISTEMA INTEGRADO DE OPERACIONES Y NEGOCIOS SION',
  'https://www.softwarepublico.gob.ec/sistema-de-gestion-de-procesos-internos/' => 'CMI (CUADRO MANDO INTEGRAL)',
  'https://www.softwarepublico.gob.ec/sistema-de-gestion-de-procesos-internos/#1' => 'APLICATIVO DE REGISTRO DE ACTORES SOCIALES ( AGUA POTABLE - RIEGO)',
  'https://www.softwarepublico.gob.ec/gestion-de-inventarios/' => 'SISTEMA DE BODEGAS',
  'https://www.softwarepublico.gob.ec/gestion-de-inventarios/#1' => 'SISTEMA DE ADMINISTRACIÓN DE BIENES',
  'https://www.softwarepublico.gob.ec/gestion-de-inventarios/#2' => 'SISTEMA DE SUMINISTROS',
  'https://www.softwarepublico.gob.ec/gestion-de-inventarios/#3' => 'MD-SOS',
  'https://www.softwarepublico.gob.ec/gestion-de-inventarios/#4' => 'APLICATIVO DE GESTIÓN DE VEHÍCULOS',
  'https://www.softwarepublico.gob.ec/gestion-de-inventarios/#5' => 'SISTEMA DE INVENTARIO DE SOFTWARE DEL SECTOR PÚBLICO',
  'https://www.softwarepublico.gob.ec/gestion-de-inventarios/#6' => 'INVENTARIO IP',
  'https://www.softwarepublico.gob.ec/gestion-de-inventarios/#7' => 'SISTEMA DE BIENES',
  'https://www.softwarepublico.gob.ec/gestion-de-inventarios/#8' => 'SISTEMA DE INSUMOS',
  'https://www.softwarepublico.gob.ec/gestion-de-inventarios/#9' => 'SIGAFI',
  'https://www.softwarepublico.gob.ec/gestion-de-inventarios/#10' => 'INVENTARIO INMUEBLES',
  'https://www.softwarepublico.gob.ec/gestion-de-inventarios/#11' => 'SISTEMA ADMINISTRACIÓN BIENES INMUEBLES',
  'https://www.softwarepublico.gob.ec/gestion-de-inventarios/#12' => 'SISTEMA DE INVENTARIO DE BIENES Y ASISTENCIA HUMANITARIA',
  'https://www.softwarepublico.gob.ec/gestion-de-proyectos-2/' => 'INDICADORES DE LAS EMPRESAS PÚBLICAS',
  'https://www.softwarepublico.gob.ec/gestion-de-proyectos-2/#2' => 'PORTAL MESA DE DIALOGO',
  'https://www.softwarepublico.gob.ec/gestion-de-proyectos-2/#3' => 'PORTAL PLAN PARA TODOS',
  'https://www.softwarepublico.gob.ec/gestion-de-proyectos-2/#4' => 'SISTEMA DE INFORMACIÓN PARA LOS GOBIERNOS AUTÓNOMOS DESCENTRALIZADOS-SIGAD ( SIGAD3)',
  'https://www.softwarepublico.gob.ec/gestion-de-proyectos-2/#5' => 'ADP SEGUIMIENTO',
  'https://www.softwarepublico.gob.ec/software-de-aplicacion/' => 'AYUDAS TÉCNICAS - DESPACHO',
  'https://www.softwarepublico.gob.ec/software-de-aplicacion/#1' => 'FORMULARIO DE SATISFACCIÓN USUARIO',
  'https://www.softwarepublico.gob.ec/software-de-aplicacion/#2' => 'GEOSALUD',
  'https://www.softwarepublico.gob.ec/software-de-sistemas/' => 'SISCRIEG',
  'https://www.softwarepublico.gob.ec/software-de-sistemas/#1' => 'SISTEMA DE AGENDAMIENTO DE TURNOS MÉDICOS',
  'https://www.softwarepublico.gob.ec/gestion-de-talento-humano/#1' => 'SISTEMA DE GESTIÓN DE TALENTO HUMANO ARCH',
  'https://www.softwarepublico.gob.ec/gestion-de-talento-humano/#2' => 'SISTEMA DE PERMISOS',
  'https://www.softwarepublico.gob.ec/gestion-de-talento-humano/#3' => 'APLICACIÓN DE MARCACIONES',
  'https://www.softwarepublico.gob.ec/gestion-de-talento-humano/#4' => 'APLICATIVO DE TALENTO HUMANO',
  'https://www.softwarepublico.gob.ec/gestion-de-talento-humano/#5' => 'SISTEMA DE VACACIONES Y PERMISOS',
  'https://www.softwarepublico.gob.ec/gestion-de-talento-humano/#6' => 'FORMULARIO WEB PARA CARGAR HOJAS DE VIDA SOLICITADO POR TALENTO HUMANO',
  'https://www.softwarepublico.gob.ec/gestion-de-talento-humano/#7' => 'FORMULARIOS TALENTO HUMANO',
  'https://www.softwarepublico.gob.ec/gestion-de-talento-humano/#8' => 'APLICACIÓN DE ROLES DE PAGO Y PERMISOS',
  'https://www.softwarepublico.gob.ec/gestion-de-talento-humano/#9' => 'SISTEMA DE TALENTO HUMANO SITHU',
  'https://www.softwarepublico.gob.ec/gestion-de-talento-humano/#10' => 'KARDEX PERSONAL',
  'https://www.softwarepublico.gob.ec/gestion-de-talento-humano/#11' => 'SISTEMA DE GESTIÓN DE TALENTO HUMANO',
  'https://www.softwarepublico.gob.ec/gestion-de-talento-humano/#12' => 'APLICATIVO PARA SOLICITUD DE PERMISOS',
  'https://www.softwarepublico.gob.ec/gestion-de-talento-humano/#13' => 'SISTEMA DE CONTROL DE SALIDAS',
  'https://www.softwarepublico.gob.ec/gestion-de-talento-humano/#14' => 'SISTEMA DE REGISTRO Y GESTIÓN DE VIÁTICOS',
  'https://www.softwarepublico.gob.ec/gestion-de-talento-humano/#15' => 'BUZÓN VIRTUAL',
  'https://www.softwarepublico.gob.ec/gestion-de-talento-humano/#16' => 'SISTEMA DE VIÁTICOS',
  'https://www.softwarepublico.gob.ec/gestion-de-transporte/' => 'SISTEMA DE CONTROL DE ACCESO',
  'https://www.softwarepublico.gob.ec/gestion-de-transporte/#1' => 'SISTEMA DE GESTIÓN DE TRANSPORTE',
  'https://www.softwarepublico.gob.ec/gestion-de-transporte/#2' => 'PARQUE AUTOMOTOR',
  'https://www.softwarepublico.gob.ec/gestion-de-transporte/#3' => 'SISTEMA DE VEHÍCULOS',
  'https://www.softwarepublico.gob.ec/gestion-de-transporte/#4' => 'SISTEMA DE GESTIÓN INSTITUCIONAL'

);
$idp = 12;
$pais[$idp] = zonas($paises[$idp], $lineas, $links); // Ecuador

$links = array();
$links[3] = array(
  'https://softwarepublico.gov.py/project/portal-de-datos-abiertos-gubernamentales/' => 'Portal de Datos Abiertos Gubernamentales',
  'https://softwarepublico.gov.py/project/sistema-de-gestion-de-recursos-humanos/' => 'Sistema de Gestión de Recursos Humanos',
  'https://softwarepublico.gov.py/project/sistema-de-patrimonio/' => 'Sistema de Patrimonio',
  'https://softwarepublico.gov.py/project/cliente-del-sistema-de-intercambio-sii/' => 'Cliente del Sistema de Intercambio (SII)',
  'https://softwarepublico.gov.py/project/portal-institucional-de-gobierno/' => 'Portal Institucional de Gobierno',
  'https://softwarepublico.gov.py/project/traductor-espanol-guarani/' => 'Traductor Español - Guaraní',
  'https://softwarepublico.gov.py/project/simple-modificaciones-paraguay/' => 'SIMPLE (modificaciones Paraguay)'
);
$idp = 22;
$pais[$idp] = zonas($paises[$idp], $lineas, $links); // Paraguay

$links = array();
$links[3] = array(
  'https://www.gob.pe/institucion/pcm/informes-publicaciones/2002679-sistema-de-gestion-documental-onpe-2017' => 'Sistema de Gestión Documental - ONPE 2017',
  'https://www.gob.pe/institucion/pcm/informes-publicaciones/2002690-sistema-de-coordinacion-de-la-ops' => 'Sistema de Coordinación de la OPs',
  'https://www.gob.pe/institucion/pcm/informes-publicaciones/2002691-sistema-de-contrataciones-cas' => 'Sistema de Contrataciones CAS',
  'https://www.gob.pe/institucion/pcm/informes-publicaciones/2002692-sistema-de-comisiones-multisectoriales' => 'Sistema de Comisiones Multisectoriales',
  'https://www.gob.pe/institucion/pcm/informes-publicaciones/2002693-sistema-de-administracion-documentaria-sisad' => 'Sistema de Administración Documentaria - SISAD',
  'https://www.gob.pe/institucion/pcm/informes-publicaciones/2002694-sistema-de-administracion-de-horas-extras' => 'Sistema de Administración de Horas Extras',
  'https://www.gob.pe/institucion/pcm/informes-publicaciones/2002695-plataforma-de-interoperabilidad-oefa' => 'Plataforma de Interoperabilidad - OEFA',
  'https://www.gob.pe/institucion/pcm/informes-publicaciones/2002696-plataforma-de-gestion-documental' => 'Plataforma de Gestión Documental',
  'https://www.gob.pe/institucion/pcm/informes-publicaciones/2002697-modulo-de-registro-control-y-seguimiento-de-recomendaciones-morec' => 'Modulo de Registro, Control y Seguimiento de Recomendaciones - MOREC',
  'https://www.gob.pe/institucion/pcm/informes-publicaciones/2002699-intranet-oefa' => 'Intranet - OEFA',
  'https://www.gob.pe/institucion/pcm/informes-publicaciones/2002700-gestion-hospitalaria-openclinic' => 'Gestión Hospitalaria OpenClinic',
  'https://www.gob.pe/institucion/pcm/informes-publicaciones/2899353-sistema-de-gestion-documental-dp' => 'Sistema de Gestión Documental - DP',
  'https://www.gob.pe/institucion/pcm/informes-publicaciones/2820816-sistema-de-salud-y-control-de-accesos' => 'Sistema de Salud y Control de Accesos',
  'https://www.gob.pe/institucion/pcm/informes-publicaciones/2806898-modulo-de-reportes-sgd-irtp' => 'Módulo de Reportes SGD - IRTP',

  'https://www.gob.pe/institucion/inen/informes-publicaciones/2745816-sistema-de-emision-de-constancias-con-firma-digital' => 'Sistema de Emisión de Constancias con Firma Digital',
  'https://www.gob.pe/institucion/pcm/informes-publicaciones/2002678-software-de-firma-de-la-smv-smvsign' => 'Software de Firma de la SMV (SMVSign)',
  'https://www.gob.pe/institucion/pcm/informes-publicaciones/2002677-software-de-compras-menores-o-iguales-a-8-uit' => 'Software de compras menores o iguales a 8 UIT',
  'https://www.gob.pe/institucion/pcm/informes-publicaciones/2002676-sistema-integrado-de-gestion-administrativa-siga-gestor-del-mincetur' => 'Sistema Integrado de Gestión Administrativa (SIGA -Gestor) del Mincetur',
  'https://www.gob.pe/institucion/pcm/informes-publicaciones/2002675-sistema-integrado-de-gestion-administrativa-para-oefa-sigaoefa' => 'Sistema Integrado de Gestión Administrativa para OEFA – SIGAOEFA',
  'https://www.gob.pe/institucion/pcm/informes-publicaciones/2002674-sistema-integrado-de-administracion-de-rrhh-siarrhh' => 'Sistema Integrado de Administración de RRHH – SIARRHH',
  'https://www.gob.pe/institucion/pcm/informes-publicaciones/2002673-sistema-informatico-de-monitoreo-de-expedientes-simex' => 'Sistema Informático de Monitoreo de Expedientes – SIMEX',
  'https://www.gob.pe/institucion/pcm/informes-publicaciones/2002680-sistema-de-tramite-documentario-y-mesa-partes-virtual' => 'Sistema de Tramite Documentario y mesa partes virtual',
  'https://www.gob.pe/institucion/pcm/informes-publicaciones/2002683-sistema-de-tramite-documentario-sitradoc' => 'Sistema de Trámite Documentario – SITRADOC',
  'https://www.gob.pe/institucion/pcm/informes-publicaciones/2002684-sistema-de-tramite-documentario-gore-loreto' => 'Sistema de Trámite Documentario - Gore Loreto',
  'https://www.gob.pe/institucion/pcm/informes-publicaciones/2002681-sistema-de-tramite-documentario-del-ministerio-de-relaciones-exteriores' => 'Sistema de Trámite Documentario del Ministerio de Relaciones Exteriores',
  'https://www.gob.pe/institucion/pcm/informes-publicaciones/2002682-sistema-de-tramite-documentario-del-ministerio-de-comercio-exterior-y-turismo' => 'Sistema de trámite documentario del Ministerio de Comercio Exterior y Turismo',
  'https://www.gob.pe/institucion/pcm/informes-publicaciones/2002685-sistema-de-registro-de-visitas' => 'Sistema de Registro de Visitas',
  'https://www.gob.pe/institucion/pcm/informes-publicaciones/2002686-sistema-de-registro-de-descansos-medicos' => 'Sistema de Registro de Descansos Médicos',
  'https://www.gob.pe/institucion/pcm/informes-publicaciones/2002687-sistema-de-notificaciones-electronicas' => 'Sistema de Notificaciones Electrónicas',
  'https://www.gob.pe/institucion/pcm/informes-publicaciones/2002688-sistema-de-gestion-electronica-de-documentos-siged' => 'Sistema de Gestión Electrónica de Documentos - SIGED',
  'https://www.gob.pe/institucion/pcm/informes-publicaciones/2002689-sistema-de-gestion-documental-ositran' => 'Sistema de Gestión Documental - OSITRAN'
);
$idp = 23;
$pais[$idp] = zonas($paises[$idp], $lineas, $links); //Perú

$links = array();
$links[3] = array(
  'https://www.gub.uy/agencia-gobierno-electronico-sociedad-informacion-conocimiento/politicas-y-gestion/sistema-inventario-activos?hrt=626' => 'Sistema de Inventario de Activos',
  'https://www.gub.uy/agencia-gobierno-electronico-sociedad-informacion-conocimiento/politicas-y-gestion/siges-seguimiento-control-portfolios?hrt=624' => 'SIGES: Seguimiento y Control de Portfolios',
  'https://www.gub.uy/agencia-gobierno-electronico-sociedad-informacion-conocimiento/politicas-y-gestion/visualizador-mapas-geopostal?hrt=631' => 'Visualizador de mapas - geoPostal',
  'https://www.gub.uy/agencia-gobierno-electronico-sociedad-informacion-conocimiento/politicas-y-gestion/control-versiones?hrt=775' => 'Control de versiones',
  'https://www.gub.uy/agencia-gobierno-electronico-sociedad-informacion-conocimiento/politicas-y-gestion/evaluacion-impacto-algoritmico?hrt=775' => 'Evaluación de impacto algorítmico',
  'https://www.gub.uy/agencia-gobierno-electronico-sociedad-informacion-conocimiento/politicas-y-gestion/openfisca?hrt=775' => 'OpenFisca',
  'https://www.gub.uy/agencia-gobierno-electronico-sociedad-informacion-conocimiento/politicas-y-gestion/ruteo-plataforma-interoperabilidad?hrt=775' => 'Ruteo de la Plataforma de Interoperabilidad',
  'https://www.gub.uy/agencia-gobierno-electronico-sociedad-informacion-conocimiento/politicas-y-gestion/sdk-id-uruguay?hrt=775' => 'SDK Id Uruguay',
  'https://www.gub.uy/agencia-gobierno-electronico-sociedad-informacion-conocimiento/politicas-y-gestion/servicio-novedades-plataforma-interoperabilidad?hrt=775' => 'Servicio de Novedades de Plataforma de Interoperabilidad',
  'https://www.gub.uy/agencia-gobierno-electronico-sociedad-informacion-conocimiento/politicas-y-gestion/gitlab-stats?hrt=629' => 'GitLab Stats',
  'https://www.gub.uy/agencia-gobierno-electronico-sociedad-informacion-conocimiento/politicas-y-gestion/trazabilidad?hrt=629' => 'Trazabilidad',
  'https://www.gub.uy/agencia-gobierno-electronico-sociedad-informacion-conocimiento/politicas-y-gestion/servicio-direcciones-1?hrt=749' => 'Servicio de direcciones',
  'https://www.gub.uy/agencia-gobierno-electronico-sociedad-informacion-conocimiento/politicas-y-gestion/convocatorias-inscripciones?hrt=749' => 'Convocatorias e Inscripciones',
  'https://www.gub.uy/agencia-gobierno-electronico-sociedad-informacion-conocimiento/politicas-y-gestion/conector-pge?hrt=749' => 'Conector PGE',
  'https://www.gub.uy/agencia-gobierno-electronico-sociedad-informacion-conocimiento/politicas-y-gestion/applet-firma-electronica-avanzada?hrt=749' => 'Applet de Firma Electrónica Avanzada',
  'https://www.gub.uy/agencia-gobierno-electronico-sociedad-informacion-conocimiento/politicas-y-gestion/cliente-java-para-plataforma-interoperabilidad?hrt=749' => 'Cliente Java para Plataforma de Interoperabilidad',
  'https://www.gub.uy/agencia-gobierno-electronico-sociedad-informacion-conocimiento/politicas-y-gestion/sistema-para-implementacion-procesos-ligeramente-estandarizados?hrt=749' => 'Sistema para la Implementación de Procesos Ligeramente Estandarizados',
  'https://www.gub.uy/agencia-gobierno-electronico-sociedad-informacion-conocimiento/politicas-y-gestion/sistema-inscripcion-llamados-sorteos-cupos?hrt=749' => 'Sistema de Inscripción a llamados y sorteos de cupos',
  'https://www.gub.uy/agencia-gobierno-electronico-sociedad-informacion-conocimiento/politicas-y-gestion/voto-electronico-presupuesto-participativo?hrt=749' => 'Voto electrónico: presupuesto participativo',
  'https://www.gub.uy/agencia-gobierno-electronico-sociedad-informacion-conocimiento/politicas-y-gestion/status?hrt=749' => 'e-status',
  'https://www.gub.uy/agencia-gobierno-electronico-sociedad-informacion-conocimiento/politicas-y-gestion/abredatos?hrt=749' => 'Abredatos',
  'https://www.gub.uy/agencia-gobierno-electronico-sociedad-informacion-conocimiento/politicas-y-gestion/nomenclator-digital' => 'Nomenclator Digital',
  'https://www.gub.uy/agencia-gobierno-electronico-sociedad-informacion-conocimiento/politicas-y-gestion/sistema-agenda-electronica' => 'Sistema de Agenda Electrónica',
  'https://www.gub.uy/agencia-gobierno-electronico-sociedad-informacion-conocimiento/politicas-y-gestion/gestor-certificados' => 'Gestor de Certificados'
);
$idp = 29;
$pais[$idp] = zonas($paises[$idp], $lineas, $links); // Uruguay
*/