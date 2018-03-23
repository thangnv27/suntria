<?php
/*
  Template Name: Tuyển dụng
 */
?>
<?php get_header(); ?>
<div class="banner-archive">
    <?php if(get_option('bg_recruitment') != ""): ?>
    <img src="<?php echo get_option('bg_recruitment'); ?>" alt="<?php the_title(); ?>" />
    <?php else: ?>
    <img src="<?php bloginfo('stylesheet_directory'); ?>/images/banner_recruitment.png" alt="<?php the_title(); ?>" />
    <?php endif; ?>
    <div class="container">
        <div class="row-fluid heading">
            <h1><?php the_title(); ?></h1>
        </div>
    </div>
</div>
<div class="container">
    <div class="row-fluid breadcrumbs">
        <?php
        if (function_exists('bcn_display')) {
            bcn_display();
        }
        ?>
    </div>
</div>
<div class="container">
    <div class="row-fluid archive">
        <div class="span8">
            <div class="post-item clearfix">
            <?php
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $loop = new WP_Query(
                array(
                    'post_type' => 'recruitment',
                    'paged' => $paged
                )
            );
            $counter = 1;
            while ($loop->have_posts()) : $loop->the_post();
                if ($counter % 2 == 0) : 
            ?>
                <div class="span6 mb20">
                    <a class="pitem-title" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><h3><?php the_title(); ?></h3></a>
                    <div class="pitem-meta">
                        <span class="pitem-date"><?php the_time('d/m/Y, H:i'); ?></span>
                    </div>
                    <div class="ritem-excerpt">
                        <?php the_excerpt(); ?> <a data-i18n="link.more" href="<?php the_permalink(); ?>">Xem tiếp +</a>
                    </div>
                </div>
                <div class="clearfix"></div>
                <?php else: ?>
                <div class="span6 mb20 ml0">
                    <a class="pitem-title" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><h3><?php the_title(); ?></h3></a>
                    <div class="pitem-meta">
                        <span class="pitem-date"><?php the_time('d/m/Y, H:i'); ?></span>
                    </div>
                    <div class="ritem-excerpt">
                        <?php the_excerpt(); ?> <a data-i18n="link.more" href="<?php the_permalink(); ?>">Xem tiếp +</a>
                    </div>
                </div>
            <?php
                endif;
                $counter ++;
            endwhile;
            ?>
            </div>
            <?php getpagenavi(array( 'query' => $loop )); ?>
        </div>
        <div class="span4 sidebar">
            <?php get_sidebar('recruitment-page'); ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>