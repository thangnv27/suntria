<?php get_header(); ?>
<div class="banner-archive">
    <?php if (get_option('bg_product') != ""): ?>
        <img src="<?php echo get_option('bg_product'); ?>" alt="<?php the_title(); ?>" />
    <?php else: ?>
        <img src="<?php bloginfo('stylesheet_directory'); ?>/images/banner_product.jpg" alt="<?php the_title(); ?>" />
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
        <div class="span3 sidebar">
            <?php get_sidebar('page-cat'); ?>
        </div>
        <div class="span9 product-single">
            <?php while (have_posts()) : the_post(); ?>
                <div class="overview-product">
                    <?php
                    $attCount = count(get_children(array('post_parent' => $post->ID)));
                    if ($attCount > 0) :
                        $args = array(
                            'orderby' => 'menu_order',
                            'post_type' => 'attachment',
                            'post_parent' => get_the_ID(),
                            'post_mime_type' => 'image',
                            'post_status' => null,
                            'posts_per_page' => -1,
                            'exclude' => get_post_thumbnail_id()
                        );
                        $attachments = get_posts($args);
                        ?>
                        <div class="span6">

                            <ul class="product-images">
                                <?php foreach ($attachments as $attachment) : ?>
                                    <li>
                                        <img src="<?php echo wp_get_attachment_url($attachment->ID); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" onerror="this.src=no_image_src" />
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="span6">
                            <div class="product-info">
                                <div class="product-title"><h2><?php the_title(); ?></h2></div>
                                <div class="product-content">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="product-info">
                            <div class="product-title"><h2><?php the_title(); ?></h2></div>
                            <div class="product-content">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="clearfix"></div>
                    <div class="product-childrens">
                        <ul class="product-children">
                            <?php
                            $loop = new WP_Query(
                                array(
                                    'post_type' => 'productchild',
                                    'meta_key' => 'product_parent',
                                    'meta_value' => get_the_ID(),
                                    'posts_per_page' => -1
                                )
                            );
                            while ($loop->have_posts()) : $loop->the_post();
                                ?>
                                <li class="cat-item prchild" onmouseover="showToolTip('<?php the_ID(); ?>')" onmouseout="UnTip()">
                                    <img src="<?php echo get_image_url(); ?>" onerror="this.src=no_image_src" />
                                    <div class="cat-item-title"><?php the_title(); ?></div>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                        <a hre="#" id="prev2"></a>
                        <a hre="#" id="next2"></a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>