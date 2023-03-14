<?php

/**
 * The header for our theme for all templates.
 *
 * This is the template that displays all of the <head> section
 *
 * @package Aplicación_Web
 */
$usuario = wp_get_current_user();
$ocultarMenues = "si";
$ocultarMantenimiento = "si";

if (is_user_logged_in()) {
	$ocultarMenues = "no";
	$current_user = wp_get_current_user();
	$usr_id = $current_user->ID;
	$roles = (array) $current_user->roles;
	if (in_array('administrator', $roles) || in_array('author', $roles)) {
		$ocultarMantenimiento = "no";
	} else {
		$ocultarMantenimiento = "si";
	}
}

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body class="background-blend" <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div> <!-- page -->
		<?php if (!is_page('login')) : ?>
			<header>
				<nav id="main_navbar" class="navbar navbar-expand-lg navbar-dark fixed-top shadow text-white" data-menubg="no">
					<div class="container">
						<div id="logo" class="logo">
							<?php
							if (has_custom_logo()) { ?>
								<div class="d-flex justify-content-center">
									<a href="<?= esc_url(site_url('/')) ?>">
										<img style="width: 100px; height:auto;" src="<?= wp_get_attachment_image_src(get_theme_mod('custom_logo'))[0] ?>" alt="Logo">
									</a>
								</div>
							<?php
							}
							?>
						</div>
						<button id="btnmenu" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						<div class="justify-content-end collapse navbar-collapse" id="navbarSupportedContent">
							<?php
							if (is_user_logged_in()) {
								wp_nav_menu(
									array(
										'theme_location' => 'menu-1',
										'container'		 => '',
										'items_wrap'	 => '<ul class="navbar-nav ms-auto mb-2 mb-lg-0">%3$s</ul>',
										'depth'			 => 5,
									)
								);
							}
							?>
							<?php if (mcssca_get_page_att()['userAdmin'] && is_user_logged_in()) : ?>
								<div class="navbar nav-item ms-2">
									<a class="text-decoration-none" href="<?php echo esc_url(site_url('/sca-mantenimiento')) ?>">Mantenimiento</a>
								</div>
							<?php endif; ?>
							<div id="btn_menu" class="navbar nav-item ms-2">
								<button type="button" class="btn btn-warning">
									<?php if (is_user_logged_in()) : ?>
										<a class="nav-link text-dark" aria-current="page" href="<?php echo wp_logout_url('/') ?>"></span><i class="fas fa-sign-out-alt"></i> Salir</a>
									<?php else : ?>
										<a class="nav-link text-dark" aria-current="page" href="<?php echo esc_url(site_url('/login')) ?>"><i class="fas fa-sign-in-alt"></i> Ingresar</a>
									<?php endif ?>
								</button>
							</div>
						</div>
					</div>
				</nav><!-- #site-navigation -->
			</header><!-- #masthead -->
			<input id="menues" type="hidden" name="" data-ocultarmenues="<?php echo $ocultarMenues ?>" data-ocultarmantenimiento="<?php echo $ocultarMantenimiento ?>">
		<?php endif; ?>