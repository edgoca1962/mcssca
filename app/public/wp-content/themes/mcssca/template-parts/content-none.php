    <div class="row">
        <div class="col">
            <?php if (isset($_GET['cpt'])) {
                $postType = sanitize_text_field($_GET['cpt']);
                if (mcssca_get_page_att($postType)['userAdmin']) {
                    echo get_template_part(mcssca_get_page_att($postType)['agregarpost']);
                }
            }
            ?>
            <h3>La información consultada no puede ser mostrada.</h3>
        </div>
    </div>