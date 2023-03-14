<?php

/**
 * The main template file (index)
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();
if (is_user_logged_in()) {
   if (have_posts()) {
      while (have_posts()) {
         the_post();
         get_template_part('template-parts/content', 'page', ['fullpage' => false]);
      }
   } else {
      get_template_part('template-parts/content', 'none');
   }
} else {
   if (is_page('login')) {
      get_template_part('template-parts/login');
   } elseif (is_front_page()) {
      get_template_part('template-parts/content', 'page', ['fullpage' => true]);
   } else {
      get_template_part('template-parts/content', 'header', ['post_type' => '', 'fullpage' => true, 'noingresado' => true]);
   }
}
