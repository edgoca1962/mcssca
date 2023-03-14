<?php
$usuario = wp_get_current_user();
$comite = sanitize_text_field($_GET['comite_id']);

?>
<h2 class="mb-5 animate__animated animate__fadeInLeft">Consulta de Acuerdos: <?php echo get_post($comite)->post_title ?></h2>
<div class="row">
   <div class="col-xl-8">
      <div class="row row-cols-1 row-cols-md-2 g-4 mb-5">
         <div class="col">
            <div class="card h-100" style="background: linear-gradient(to right, rgba(64, 154, 247, 1), rgba(43, 170, 177, 1)) !important;color: #fff;">
               <div class="d-flex p-4">
                  <div class=""><i class="fa-solid fa-handshake" style="font-size:30px;"></i></div>
                  <div class="ms-3 pt-2">
                     <h5><a class="text-white" href="<?php echo get_post_type_archive_link('acuerdo') . '?vigencia=1&comite_id=' . $comite ?>">Acuerdos Vencidos</a>
                        <span class="ms-1">(
                           <?php
                           if (verAcuerdos()[$comite] == 'asignados') {
                              echo totalAcuerdosComiteUsr($comite, $usuario->ID)['vencidos'];
                           } else {
                              echo totalAcuerdosComite($comite)['vencidos'];
                           }
                           ?>)
                        </span>
                     </h5>
                  </div>
               </div>
            </div>
         </div>
         <div class="col">
            <div class="card" style="background: linear-gradient(to right, rgba(64, 154, 247, 1), rgba(43, 170, 177, 1)) !important;color: #fff;">
               <div class="d-flex p-4">
                  <div class=""><i class="fa-solid fa-handshake" style="font-size:30px;"></i></div>
                  <div class="ms-3 pt-2">
                     <h5><a class="text-white" href="<?php echo get_post_type_archive_link('acuerdo') . '?vigencia=2&comite_id=' . $comite ?>">Acuerdos por vencer este mes</a>
                        <span class="ms-1">(
                           <?php
                           if (verAcuerdos()[$comite] == 'asignados') {
                              echo totalAcuerdosComiteUsr($comite, $usuario->ID)['porvencer'];
                           } else {
                              echo totalAcuerdosComite($comite)['porvencer'];
                           }
                           ?>)
                        </span>
                     </h5>
                  </div>
               </div>
            </div>
         </div>
         <div class="col">
            <div class="card" style="background: linear-gradient(to right, rgba(64, 154, 247, 1), rgba(43, 170, 177, 1)) !important;color: #fff;">
               <div class="d-flex p-4">
                  <div class=""><i class="fa-solid fa-handshake" style="font-size:30px;"></i></div>
                  <div class="ms-3 pt-2">
                     <h5><a class="text-white" href="<?php echo get_post_type_archive_link('acuerdo') . '?vigencia=3&comite_id=' . $comite ?>">Acuerdos en proceso</a>
                        <span class="ms-1">(
                           <?php
                           if (verAcuerdos()[$comite] == 'asignados') {
                              echo totalAcuerdosComiteUsr($comite, $usuario->ID)['proceso'];
                           } else {
                              echo totalAcuerdosComite($comite)['proceso'];
                           }
                           ?>)
                        </span>
                     </h5>
                  </div>
               </div>
            </div>
         </div>
         <div class="col">
            <div class="card" style="background: linear-gradient(to right, rgba(64, 154, 247, 1), rgba(43, 170, 177, 1)) !important;color: #fff;">
               <div class="d-flex p-4">
                  <div class=""><i class="fa-solid fa-handshake" style="font-size:30px;"></i></div>
                  <div class="ms-3 pt-2">
                     <h5><a class="text-white" href="<?php echo get_post_type_archive_link('acuerdo') . '?vigencia=4&comite_id=' . $comite ?>">Acuerdos Ejecutados</a>
                        <span class="ms-1">(
                           <?php
                           if (verAcuerdos()[$comite] == 'asignados') {
                              echo totalAcuerdosComiteUsr($comite, $usuario->ID)['ejecutados'];
                           } else {
                              echo totalAcuerdosComite($comite)['ejecutados'];
                           }
                           ?>)
                        </span>
                     </h5>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-xl-4">
      <?php get_template_part('template-parts/sca-busquedas') ?>
   </div>
</div>