<div class="box-left cat-product">
    <div data-i18n="product.category" class="box-left-title">Danh mục sản phẩm</div>
    <div class="box-left-content">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'menucat',
            'menu_class' => 'menucat',
            'container' => ''
        ));
        ?>
    </div>
</div>
<div class="box-left box-daily">
    <div data-i18n="dltitle" class="box-left-title">Hỗ trợ bán hàng</div>
    <div class="box-left-content">
        <div class="dl-phone"><?php echo get_settings('dl_phone'); ?></div>
        <div class="dl-email"><?php echo get_settings('dl_email'); ?></div>
    </div>
</div>
<div class="box-left product-hots">
    <div data-i18n="product.hot" class="box-left-title">Sản phẩm nổi bật</div>
    <div class="box-left-content">
        <ul class="product-hot">
            <?php
            wp_reset_query();
            $loop = new WP_Query(
                array(
                    'post_type' => 'product',
                    'meta_key' => 'is_most',
                    'meta_value' => '1',
                    'posts_per_page' => -1
                )
            );
            while ($loop->have_posts()) : $loop->the_post(); ?>
                <li>
                    <a href="<?php the_permalink(); ?>">
                        <img title="<?php the_title(); ?>" alt="<?php the_title(); ?>" src="<?php echo get_image_url(); ?>" onerror="this.src=no_image_src"/>
                    </a>
                    <span><?php the_title(); ?></span>
                </li>
            <?php endwhile; 
            wp_reset_query();
            ?>
        </ul>
    </div>
</div>