<?php

/**
 * The main template file cambio
 *
 * @package Aplicación_Web
 */
get_header();
if (is_user_logged_in()) {
    get_template_part('template-parts/content', 'header', ['post_type' => '', 'fullpage' => true, '404' => true]);
} else {
    get_template_part('template-parts/content', 'header', ['post_type' => '', 'fullpage' => true, 'noingresado' => true]);
}
