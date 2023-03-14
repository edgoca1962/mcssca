<?php
if (get_the_post_thumbnail_url()) {
   $imagen = get_the_post_thumbnail_url();
} else {
   $imagen = get_template_directory_uri() . '/assets/img/bg.jpg';
}
$height = '100vh';
$titulo = '';
$subtitulo = '';
$subtitulo2 = '';
?>
<div class="background-blend" style="overflow:hidden">
   <section id="hero-page" class="d-flex flex-column justify-content-center align-items-center text-white" style="background: linear-gradient(rgba(0,0,0,0.0),rgba(0,0,0,0.0)), url(<?php echo $imagen ?>) no-repeat center / cover; height: <?php echo $height ?>;">
      <div class="row">
         <div style="margin-top: 50vh;">
            <section class="col vh-100 d-flex justify-content-center">
               <div class='position-relative'>
                  <div class="d-flex justify-content-center">
                     <a href="<?php echo esc_url(site_url('/')) ?>" style="z-index:5">
                        <!-- class="img-thumbnail rounded-circle"  -->
                        <img src="<?php echo wp_get_attachment_image_src(get_theme_mod('custom_logo'), 'full')[0] ?>" style="width:100px;" alt="Logo">
                     </a>
                  </div>
                  <div class="ingreso-bg p-5 rounded-5 shadowcss" style="margin-top:-2.3rem; width:20rem;">
                     <form class="" id="ingreso" novalidate>
                        <div class="form-floating mb-3 border-bottom">
                           <input type="text" class="form-control bg-transparent border-0 shadow-none text-white" id="usuario" name="usuario" placeholder="usuario" required>
                           <label for="usuario">Usuario</label>
                           <div class="invalid-feedback">
                              Por favor digitar el usuario.
                           </div>
                        </div>
                        <div class="form-floating mb-3 border-bottom">
                           <input type="password" class="form-control bg-transparent border-0 shadow-none text-white" id="clave" name="clave" placeholder="contraseña" required>
                           <label for="clave">Contraseña</label>
                           <div class="invalid-feedback">
                              Por favor digitar la contraseña.
                           </div>
                        </div>
                        <div class="mb-4">
                           <input class="form-check-input" type="checkbox" value="" id="recordarme">
                           <label class="form-check-label fw-light" for="recordarme">
                              Recordarme
                           </label>
                        </div>
                        <div class="text-center form-group">
                           <button type="submit" class="btn btn-warning btn-lg mb-3"><i class="fas fa-sign-in-alt"></i> Ingresar</button>
                        </div>
                        <input type="hidden" name="action" value="ingresar">
                        <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('frm_ingreso') ?>">
                        <!-- sca-consulta-acuerdos -->
                        <input type="hidden" name="redireccion" value="<?php echo site_url('/sca-consulta-acuerdos') ?>">
                        <input type="hidden" name="endpoint" value="<?php echo admin_url('admin-ajax.php') ?>">
                     </form>
                  </div>
               </div>
            </section>
         </div><!-- login -->
      </div>
   </section>