<?php

/******************************************************************************
 * 
 * 
 * Creación de páginas generales.
 * 
 * 
 *****************************************************************************/
$login = get_posts([
    'post_type' => 'page',
    'name' => 'login',
    'post_status' => 'publish',
]);
if (count($login) > 0) {
} else {
    $post_data = array(
        'post_type' => 'page',
        'post_title' => 'Login',
        'post_name' => 'login',
        'post_status' => 'publish',
    );
    wp_insert_post($post_data);
}
$noingresado = get_posts([
    'post_type' => 'page',
    'post_status' => 'publish',
    'name' => 'noingresado',
]);
if (count($noingresado) > 0) {
} else {
    $post_data = array(
        'post_type' => 'page',
        'post_title' => 'Favor Ingresar a la aplicación',
        'post_name' => 'noingresado',
        'post_status' => 'publish',
    );
    wp_insert_post($post_data);
}
/******************************************************************************
 * 
 * 
 * Obtener Atributos de las páginas y los posts.
 * 
 * 
 *****************************************************************************/
if (!function_exists('mcssca_get_page_att')) {
    function mcssca_get_page_att($postType = '', $fullpage = false)
    {
        $atributos = [];
        $usuario = wp_get_current_user();
        $usuarioRoles = $usuario->roles;
        if (isset($_GET['cpt'])) {
            $postType = sanitize_text_field($_GET['cpt']);
        }
        if (is_front_page()) {
            if (get_the_post_thumbnail_url()) {
                $atributos['imagen'] = get_the_post_thumbnail_url();
            } else {
                $atributos['imagen'] = get_template_directory_uri() . '/assets/img/bg.jpg';
            }
            if ($fullpage) {
                $atributos['height'] = "100vh";
            } else {
                $atributos['height'] = '60vh';
            }
            $atributos['titulo'] = get_the_title();
            $atributos['subtitulo'] = '';
            $atributos['subtitulo2'] = '';
        } elseif (is_home()) {
            $atributos = mcssca_get_post_att($postType);
        } elseif (is_single()) {
            $atributos = mcssca_get_post_att($postType);
            if (get_post_meta(get_the_ID(), '_backdrop_path', true)) {
                $atributos['imagen'] = str_replace("w342", "w1280", get_post_meta(get_the_ID(), '_backdrop_path', true));
            }
            if (is_singular('acuerdo')) {
                $atributos['titulo'] = get_post(get_post_meta(get_the_ID(), '_comite_id', true))->post_title;
                $atributos['subtitulo'] = get_the_title();
                $atributos['subtitulo2'] = 'Asginado a: ' . get_user_by('ID', get_post_meta(get_the_ID(), '_asignar_id', true))->display_name;
            }
            $atributos['div3'] = "";
            $atributos['div4'] = "";
        } elseif (is_archive()) {
            $atributos = mcssca_get_post_att($postType);
            if ($fullpage) {
                $atributos['height'] = '100vh';
            }
        } else {
            if (get_the_post_thumbnail_url()) {
                $atributos['imagen'] = get_the_post_thumbnail_url();
            } else {
                $atributos['imagen'] = get_template_directory_uri() . '/assets/img/bg.jpg';
            }
            if ($fullpage) {
                $atributos['height'] = '100vh';
            } else {
                $atributos['height'] = '60vh';
            }
            $atributos['titulo'] = get_the_title();
            $atributos['subtitulo'] = '';
            $atributos['subtitulo2'] = '';
        }
        if (in_array('administrator', $usuarioRoles) || in_array('author', $usuarioRoles)) {
            $atributos['userAdmin'] = true;
        } else {
            $atributos['userAdmin'] = false;
        }
        return $atributos;
    }
}

if (!function_exists('mcssca_get_post_att')) {
    function mcssca_get_post_att($post_type)
    {
        $atributos = [];
        if (isset(explode("/", $_SERVER['REQUEST_URI'])[3])) {
            if (is_numeric(explode("/", $_SERVER['REQUEST_URI'])[3])) {
                $atributos['pag'] = explode("/", $_SERVER['REQUEST_URI'])[3];
            } else {
                $atributos['pag'] = '1';
            }
        } else {
            $atributos['pag'] = '1';
        }
        if (isset($_GET['pag_ant'])) {
            $atributos['pag_ant'] = sanitize_text_field($_GET['pag_ant']);
        } else {
            $atributos['pag_ant'] = '1';
        }
        switch ($post_type) {
            case 'post':
                if (get_the_post_thumbnail_url()) {
                    $atributos['imagen'] = get_the_post_thumbnail_url();
                } else {
                    $atributos['imagen'] = get_template_directory_uri() . '/assets/img/bg.jpg';
                }
                $atributos['titulo'] = 'Blog';
                if (get_the_archive_title() == 'Archives') {
                    $atributos['subtitulo'] = '';
                } else {
                    $atributos['subtitulo'] = str_replace('Tag', 'Clasificación', get_the_archive_title(), $count);
                }
                $atributos['height'] = '60vh';
                $atributos['subtitulo2'] = '';
                $atributos['div1'] = '';
                $atributos['div2'] = '';
                $atributos['div3'] = 'row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4';
                $atributos['div4'] = '';
                $atributos['div5'] = '';
                $atributos['agregarpost'] = '';
                $atributos['barra'] = '';
                $atributos['regresar'] = 'post';
                break;
            case 'comite':
                if (get_the_post_thumbnail_url()) {
                    $atributos['imagen'] = get_the_post_thumbnail_url();
                } else {
                    $atributos['imagen'] = get_template_directory_uri() . '/assets/img/bg.jpg';
                }
                $atributos['titulo'] = 'Comités';
                $atributos['subtitulo'] = '';
                $atributos['subtitulo2'] = '';
                $atributos['display'] = 'display-4';
                $atributos['displaysub'] = '';
                $atributos['height'] = '60vh';
                $atributos['div1'] = "row";
                $atributos['div2'] = "col-xl-8";
                $atributos['div3'] = "row row-cols-1 row-cols-lg-2 g-2 g-lg-5";
                $atributos['div4'] = "";
                $atributos['div5'] = 'col-xl-4';
                $atributos['agregarpost'] = 'template-parts/comite-mantenimiento';
                $atributos['barra'] = 'template-parts/sca-busquedas';
                $atributos['regresar'] = 'comite';
                break;
            case 'acta':
                if (get_the_post_thumbnail_url()) {
                    $atributos['imagen'] = get_the_post_thumbnail_url();
                } else {
                    $atributos['imagen'] = get_template_directory_uri() . '/assets/img/bg.jpg';
                }
                if (isset($_GET['comite_id']) != null) {
                    $comite_id = sanitize_text_field($_GET['comite_id']);
                    $comite = get_post($comite_id)->post_title;
                    if (preg_match("/Junta/i", $comite)) {
                        $atributos['titulo'] = "Actas de " . $comite;
                        $atributos['prefijo'] = 'Acta';
                    } else {
                        $atributos['titulo'] = "Minutas del " . $comite;
                        $atributos['prefijo'] = 'Minuta';
                    }
                    global $wpdb;
                    $qryconsecutivo = $wpdb->get_var(
                        "
                        SELECT MAX(cast(t01.meta_value as unsigned))+1 consecutivo
                        FROM wp_posts
                        INNER JOIN wp_postmeta t01 ON (ID = t01.post_id)
                        INNER JOIN wp_postmeta t02 ON (ID = t02.post_id)
                        WHERE 1=1
                        AND (
                        (t01.meta_key = '_n_acta')
                        AND (t02.meta_key = '_comite_id' and t02.meta_value = " . $comite_id . ")
                        )
                        AND post_type = 'acta' AND post_status = 'publish'
                        "
                    );

                    $qry_n_actas = $wpdb->get_results(
                        "
                        SELECT t01.meta_value
                        FROM wp_posts
                        INNER JOIN wp_postmeta t01 ON (ID = t01.post_id)
                        INNER JOIN wp_postmeta t02 ON (ID = t02.post_id)
                        WHERE 1 = 1
                        AND (
                        (t01.meta_key = '_n_acta' AND t01.meta_value != '')
                        AND (t02.meta_key = '_comite_id' and t02.meta_value = " . $comite_id . ")
                        )
                        AND post_type = 'acta' and post_status = 'publish'
                        ",
                        ARRAY_A
                    );
                    $num_actas = '';
                    foreach ($qry_n_actas as $acta) {
                        $num_actas .= $acta['meta_value'] . ',';
                    }
                    $atributos['consecutivo'] = $qryconsecutivo;
                    $atributos['n_actas'] = $qry_n_actas;
                    $atributos['num_actas'] = $num_actas;
                    $atributos['btn_agregar'] = true;
                } else {
                    $atributos['titulo'] = 'Minutas y Actas';
                    $atributos['prefijo'] = 'Minutas o Actas';
                    $atributos['btn_agregar'] = false;
                }
                $atributos['subtitulo'] = '';
                $atributos['subtitulo2'] = '';
                $atributos['display'] = 'display-6';
                $atributos['displaysub'] = 'display-6';
                $atributos['height'] = '60vh';
                $atributos['div1'] = "row";
                $atributos['div2'] = "col-xl-8";
                $atributos['div3'] = "row row-cols-1 row-cols-md-2 g-4 mb-5";
                $atributos['div4'] = "";
                $atributos['div5'] = 'col-xl-4';
                $atributos['agregarpost'] = 'template-parts/acta-mantenimiento';
                $atributos['barra'] = 'template-parts/sca-busquedas';
                $atributos['regresar'] = 'acta';
                break;
            case 'acuerdo':
                if (isset($_GET['asignar_id'])) {
                    $asignar_id = sanitize_text_field($_GET['asignar_id']);
                    $usuario = get_user_by('ID', $asignar_id);
                    $atributos['subtitulo2'] = 'Asignados a: ' . $usuario->display_name;
                } else {
                    if (isset($_GET['comite_id'])) {
                        $comite_id = sanitize_text_field($_GET['comite_id']);
                        if (verAcuerdos()[$comite_id] == 'todos') {
                            $atributos['subtitulo2'] = 'Asignados a: Todos los usuarios';
                        } else {
                            $atributos['subtitulo2'] = 'Asignados a: ' . wp_get_current_user()->display_name;
                        }
                    } else {
                        $atributos['subtitulo2'] = 'Asignados a: ' . wp_get_current_user()->display_name;
                    }
                }
                if (get_the_post_thumbnail_url()) {
                    $atributos['imagen'] = get_the_post_thumbnail_url();
                } else {
                    $atributos['imagen'] = get_template_directory_uri() . '/assets/img/bg.jpg';
                }
                if (isset($_GET['comite_id']) != null && isset($_GET['acta_id']) != null) {
                    $comite_id = sanitize_text_field($_GET['comite_id']);
                    $acta_id = sanitize_text_field($_GET['acta_id']);
                    global $wpdb;
                    $qryconsecutivo = $wpdb->get_var(
                        "
                    SELECT
                    MAX(cast(t01.meta_value as unsigned)) + 1 consecutivo
                    FROM
                        wp_posts
                        INNER JOIN wp_postmeta t01 ON (ID = t01.post_id)
                        INNER JOIN wp_postmeta t02 ON (ID = t02.post_id)
                        INNER JOIN wp_postmeta t03 ON (ID = t03.post_id)
                    WHERE 1 = 1 
                        AND (
                            (t01.meta_key = '_n_acuerdo' AND t01.meta_value != '')
                            AND (t02.meta_key = '_comite_id' AND t02.meta_value ='" . $comite_id . "')
                            AND (t03.meta_key = '_acta_id' AND t03.meta_value = '" . $acta_id . "')
                        )
                        AND post_type = 'acuerdo'
                        AND post_status = 'publish';
                    "
                    );

                    $qry_n_acuerdos = $wpdb->get_results(
                        "
                        SELECT
                        t01.meta_value
                        FROM
                            wp_posts
                            INNER JOIN wp_postmeta t01 ON (ID = t01.post_id)
                            INNER JOIN wp_postmeta t02 ON (ID = t02.post_id)
                            INNER JOIN wp_postmeta t03 ON (ID = t03.post_id)
                        WHERE 1 = 1
                            AND(
                                (t01.meta_key = '_n_acuerdo' AND t01.meta_value != '')
                                AND (t02.meta_key = '_comite_id' AND t02.meta_value = '" . $comite_id . "')
                                AND (t03.meta_key = '_acta_id' AND t03.meta_value = '" . $acta_id . "')
                                )
                            AND post_type = 'acuerdo'
                            AND post_status = 'publish'
                        ",
                        ARRAY_A
                    );

                    $num_acuerdos = '';
                    foreach ($qry_n_acuerdos as $acuerdo) {
                        $num_acuerdos .= $acuerdo['meta_value'] . ',';
                    }
                    $atributos['consecutivo'] = $qryconsecutivo;
                    $atributos['n_acuerdos'] = $num_acuerdos;
                    $atributos['btn_agregar'] = true;
                } else {
                    $atributos['btn_agregar'] = false;
                    $atributos['consecutivo'] = '';
                    $atributos['n_acuerdos'] = '';
                }

                if (isset($_GET['comite_id']) != null) {
                    $comite_id = sanitize_text_field($_GET['comite_id']);
                    $comite = get_post($comite_id)->post_title;
                    $atributos['comite_id'] = $comite_id;
                    $atributos['titulo_comite'] = $comite;
                    if (preg_match("/Junta/i", $comite)) {
                        $atributos['titulo'] = "Actas de " . $comite;
                    } else {
                        $atributos['titulo'] = "Minutas del " . $comite;
                    }
                } else {
                    $comite_id = '';
                    $atributos['titulo'] = 'Acuerdos';
                    $atributos['comite_id'] = '';
                    $atributos['titulo_comite'] = '';
                }
                if (isset($_GET['acta_id']) != null) {
                    $acta_id = sanitize_text_field($_GET['acta_id']);
                    $atributos['subtitulo'] = get_post($acta_id)->post_title;
                    $atributos['acta_id'] = $acta_id;
                } else {
                    $acta_id = '';
                    $atributos['subtitulo'] = '';
                    $atributos['acta_id'] = '';
                }
                if (isset($_GET['vigencia'])) {
                    $vigencia = sanitize_text_field($_GET['vigencia']);
                    if (isset($_GET['comite_id'])) {
                        $comite_id = sanitize_text_field($_GET['comite_id']);
                        $atributos['titulo'] = get_post($comite_id)->post_title;
                    } else {
                        $atributos['titulo'] = 'Todos los Comités';
                    }
                    switch ($vigencia) {
                        case '1':
                            $atributos['subtitulo'] = 'Acuerdos Vencidos';
                            $atributos['status'] = 'Vencido';
                            break;

                        case '2':
                            $atributos['subtitulo'] = 'Acuerdos por vencer este mes';
                            $atributos['status'] = 'Por Vencer';
                            break;

                        case '3':
                            $atributos['subtitulo'] = 'Acuerdos en proceso';
                            $atributos['status'] = 'En proceso';
                            break;

                        case '4':
                            $atributos['subtitulo'] = 'Acuerdos Ejecutados';
                            $atributos['status'] = 'Ejecutado';
                            break;

                        default:
                            $atributos['subtitulo'] = 'Vigencia Indefinida';
                            break;
                    }
                }
                $atributos['display'] = 'display-6';
                $atributos['displaysub'] = 'display-6';
                $atributos['height'] = '60vh';
                $atributos['div1'] = "row";
                $atributos['div2'] = "col-xl-8";
                $atributos['div3'] = "";
                $atributos['div4'] = "";
                $atributos['div5'] = 'col-xl-4';
                $atributos['agregarpost'] = 'template-parts/acuerdo-mantenimiento';
                $atributos['barra'] = 'template-parts/sca-busquedas';
                $atributos['regresar'] = 'acuerdo';
                break;
            case 'miembro':
                if (get_the_post_thumbnail_url()) {
                    $atributos['imagen'] = get_the_post_thumbnail_url();
                } else {
                    $atributos['imagen'] = get_template_directory_uri() . '/assets/img/bg.jpg';
                }
                $atributos['titulo'] = 'Miembros';
                $atributos['subtitulo'] = '';
                $atributos['subtitulo2'] = '';
                $atributos['display'] = 'display-4';
                $atributos['displaysub'] = '';
                $atributos['height'] = '60vh';
                $atributos['div1'] = "row";
                $atributos['div2'] = "col-xl-8";
                $atributos['div3'] = "row row-cols-1 row-cols-lg-3 g-2 g-lg-5";
                $atributos['div4'] = "";
                $atributos['div5'] = 'col-xl-4';
                $atributos['agregarpost'] = 'template-parts/miembro-mantenimiento';
                $atributos['barra'] = 'template-parts/sca-busquedas';
                $atributos['regresar'] = 'miembro';
                break;
            case 'puesto':
                if (get_the_post_thumbnail_url()) {
                    $atributos['imagen'] = get_the_post_thumbnail_url();
                } else {
                    $atributos['imagen'] = get_template_directory_uri() . '/assets/img/bg.jpg';
                }
                $atributos['titulo'] = 'Puestos';
                $atributos['subtitulo'] = '';
                $atributos['subtitulo2'] = '';
                $atributos['display'] = 'display-4';
                $atributos['displaysub'] = '';
                $atributos['height'] = '60vh';
                $atributos['div1'] = "row";
                $atributos['div1'] = "row";
                $atributos['div2'] = "col-xl-8";
                $atributos['div3'] = "row row-cols-1 row-cols-lg-3 g-2 g-lg-5";
                $atributos['div4'] = "";
                $atributos['div5'] = 'col-xl-4';
                $atributos['agregarpost'] = 'template-parts/puesto-mantenimiento';
                $atributos['barra'] = 'template-parts/sca-busquedas';
                $atributos['regresar'] = 'puesto';
                break;
            case 'movie':
                $atributos['titulo'] = 'Consulta de Películas y Series';
                $atributos['subtitulo'] = '';
                $atributos['subtitulo2'] = '';
                $atributos['height'] = '60vh';
                $atributos['div1'] = 'row';
                $atributos['div2'] = 'col-xl-9';
                $atributos['div3'] = 'row row-cols-1 row-cols-lg-4 g-2 g-lg-5';
                $atributos['div4'] = '';
                $atributos['div5'] = 'col-xl-3';
                $atributos['agregarpost'] = ''; //template
                $atributos['barra'] = 'template-parts/movie-barra';
                $atributos['regresar'] = 'movie';
                break;
            default:
                $atributos['imagen'] = get_template_directory_uri() . '/assets/img/bg.jpg';
                $atributos['titulo'] = 'No hay Información Registrada';
                $atributos['subtitulo'] = '';
                $atributos['subtitulo2'] = '';
                $atributos['height'] = '60vh';
                $atributos['div1'] = 'row';
                $atributos['div2'] = 'col';
                $atributos['div3'] = '';
                $atributos['div4'] = '';
                $atributos['div5'] = '';
                $atributos['agregarpost'] = '';
                $atributos['barra'] = '';
                $atributos['regresar'] = '';
                break;
        }
        return $atributos;
    }
}
