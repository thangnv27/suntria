<?php include 'box-recruitment.php'; ?>
<div class="recruitment">
    <div data-i18n="recruitment.other" class="rbox-title">Tuyển dụng khác</div>
    <div class="rbox-content">
        <ul>
            <?php
            $args = array(
                'post_type' => 'recruitment',
                'post__not_in' => array(get_the_ID()),
                'orderby' => 'rand'
            );
            $loop = new WP_Query($args);
            while ($loop->have_posts()) : $loop->the_post();
                ?>
                <li class="recruitment-item">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <?php the_title(); ?>
                    </a>
                    <span class="recruitment-date">(<?php the_time('d/m/Y'); ?>)</span>
                </li>
                <?php
            endwhile;
            wp_reset_query();
            ?>
        </ul>
    </div>
</div>
<?php
if (function_exists('dynamic_sidebar')) {
    dynamic_sidebar('sidebar_single');
}
?>