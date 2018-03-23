<?php include 'box-recruitment.php'; ?>
<div class="popular-news">
    <div data-i18n="news.popular" class="rbox-title">Tin đọc nhiều</div>
    <div class="rbox-content">
        <ul>
            <?php
            $args = array(
                'post_type' => 'post',
                'orderby' => 'count-views_all',
                'posts_per_page' => 5,
                'order' => 'DESC'
            );
            $loop = new WP_Query($args);
            while ($loop->have_posts()) : $loop->the_post();
            ?>
            <li class="popular-news-item">
                <div class="span5">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <img src="<?php get_image_url() ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" onerror="this.src=no_image_src"/>
                    </a>
                </div>
                <div class="span7">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <span><?php the_title(); ?></span>
                    </a>
                    <span class="pp-date"><?php the_time('d/m/Y'); ?></span>
                </div>
            </li>
            <?php endwhile;
            wp_reset_query();
            ?>
        </ul>
    </div>
</div>
<?php
if (function_exists('dynamic_sidebar')) {
    dynamic_sidebar('sidebar');
}
?>