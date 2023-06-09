<?php

/**
 * Aplicación Web functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Aplicación_Web
 */

if (!defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function temabase_setup()
{
    /*
    * Make theme available for translation.
    */
    load_theme_textdomain('temabase', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
    * Let WordPress manage the document title.
    */
    add_theme_support('title-tag');

    /*
    * Enable support for Post Thumbnails on posts and pages.
    *
    * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
    */
    add_theme_support('post-thumbnails');

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
        array(
            'menu-1' => esc_html__('Primary', 'temabase'),
        )
    );
    /*
    * Switch default core markup for search form, comment form, and comments
    * to output valid HTML5.
    */
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support(
        'custom-logo',
        array(
            'height'      => 300,
            'width'       => 300,
            'flex-width'  => true,
            'flex-height' => true,
        )
    );
}
add_action('after_setup_theme', 'temabase_setup');

/**
 * Enqueue scripts and styles.
 */
function temabase_scripts()
{
    wp_enqueue_style('styles', get_stylesheet_uri(), array(), microtime(), 'all');
    wp_enqueue_script('scripts', get_template_directory_uri() . '/assets/main.js', array('jquery'), microtime(), true);
}
add_action('wp_enqueue_scripts', 'temabase_scripts');

require_once ABSPATH . '/wp-admin/includes/taxonomy.php';


require get_template_directory() . "/inc/get_att.php";
require get_template_directory() . '/inc/twentytwentyone/class-twenty-twenty-one-svg-icons.php';
require get_template_directory() . '/inc/twentytwentyone/template-functions.php';
require get_template_directory() . '/inc/twentytwentyone/template-tags.php';
require get_template_directory() . "/inc/login.php";

require get_template_directory() . "/inc/sca/comite.php";
require get_template_directory() . "/inc/sca/acta.php";
require get_template_directory() . "/inc/sca/acuerdo.php";
require get_template_directory() . "/inc/sca/miembro.php";
require get_template_directory() . "/inc/sca/puesto.php";
require get_template_directory() . "/inc/sca/f_totalacuerdos.php";

require get_template_directory() . "/inc/sca/mantenimiento.php";
