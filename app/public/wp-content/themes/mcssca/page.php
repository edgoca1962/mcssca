<?php

/**
 * The main template file
 *
 * @package Aplicación_Web
 */
get_header();
if (is_user_logged_in()) {
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            if (is_front_page()) {
                get_template_part('template-parts/content', 'page', ['fullpage' => true]);
            } else {
                get_template_part('template-parts/content', 'page', ['fullpage' => false]);
            }
        }
    } else {
        get_template_part('template-parts/content', 'none');
    }
    $fullpage = true;
} else {
    if (is_page('login')) {
        get_template_part('template-parts/login');
    } elseif (is_front_page()) {
        get_template_part('template-parts/content', 'page', ['fullpage' => true, 'noingresado' => false, '404' => false]);
    } else {
        get_template_part('template-parts/content', 'page', ['post_type' => '', 'fullpage' => true, 'noingresado' => true]);
    }
    $fullpage = true;
}
get_footer('footer', ['fullpage' => $fullpage]);
