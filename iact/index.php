<?php get_header(); ?>

<?php
$slider_id = intval(get_option('home_slider'));
if ($slider_id > 0):
    ?>
    <!--BEGIN SLIDER-->
    <div class="slider">
        <?php echo do_shortcode('[layerslider id="' . $slider_id . '"]'); ?>
    </div>
    <!--END SLIDER-->
<?php endif; ?>

<div class="home-block">
    <div class="container">
        <div class="row-fluid">
            <!--GET HOME BLOCK-->
            <?php
            $loop = new WP_Query(
                array(
                    'post_type' => 'home',
                    'posts_per_page' => 3,
                    'meta_key' => 'home_order',
                    'orderby' => 'meta_value',
                    'order' => 'ASC'
                )
            );
            while ($loop->have_posts()) : $loop->the_post();
            ?>
            <div class="span4 block">
                <a class="block-title" href="<?php echo get_post_meta(get_the_ID(), 'home_link', true) ?>"><h3><?php the_title(); ?></h3></a>
                <div class="item-img">
                    <a href="<?php echo get_post_meta(get_the_ID(), 'home_link', true) ?>" title="<?php the_title(); ?>">
                        <img class="img-rounded" src="<?php echo get_post_meta(get_the_ID(), 'home_banner', true) ?>" onerror="this.src=no_image_src" />
                    </a>
                </div>
                <div class="item-description"><?php the_content(); ?></div>
            </div>
           <?php endwhile; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>