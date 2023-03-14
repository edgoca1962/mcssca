<?php get_template_part('template-parts/content', 'header', ['post_type' => '', 'fullpage' => $args['fullpage']]) ?>
<div class="<?php echo ($args['fullpage']) ? '' : 'container py-5' ?>">
    <?php
    if (!$args['fullpage']) {
        if (the_content()) {
            the_content();
        } else {
            get_template_part('template-parts/' . $post->post_name);
        }
        if (comments_open() || get_comments_number()) {
            comments_template();
        }
    }
    ?>
</div>