<?php
if (isset($args['noingresado'])) {
    $titulo = 'Favor ingresar al Sistema';
} elseif (isset($args['404'])) {
    $titulo = 'Página no existe';
} else {
    $titulo = mcssca_get_page_att($args['post_type'], $args['fullpage'])['titulo'];
}
?>
<section id="hero-page" class="d-flex flex-column justify-content-center align-items-center text-white" style="background: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url(<?php echo mcssca_get_page_att($args['post_type'], $args['fullpage'])['imagen'] ?>) no-repeat center /cover; height: <?php echo  mcssca_get_page_att($args['post_type'], $args['fullpage'])['height'] ?>;">
    <h1 class="animate__animated animate__fadeInDown mb-3  text-center fw-lighter"><?php echo $titulo ?></h1>
    <h3 class="animate__animated animate__fadeInUp mb-3 text-center fw-lighter"><?php echo mcssca_get_page_att($args['post_type'], $args['fullpage'])['subtitulo'] ?></h3>
    <h5 class="animate__animated animate__fadeInUp text-center fw-lighter"><?php echo mcssca_get_page_att($args['post_type'], $args['fullpage'])['subtitulo2'] ?></h5>
</section>