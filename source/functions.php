<?php

function freshtheme_setup() {
    //add_theme_support('widgets');
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
    add_theme_support( 'post-thumbnails' );
    add_image_size('freshtheme-small', 200, 200, true);
	add_image_size('freshtheme-medium', 520, 293, true);
	add_image_size('freshtheme-large', 780, 440, true);
    add_image_size('freshtheme-post', 305, 180, true);

    add_theme_support('menus');
    
}

add_action( 'after_setup_theme', 'freshtheme_setup' );

add_action('widgets_init', 'register_freshtheme_widgets');
function register_freshtheme_widgets() {
    register_sidebar(array(
        'name' => 'Боковая панель',
        'id' => 'right_sidebar',
        'description' => 'Боковая панель виджетов',
        'class' => 'aside',
        'before_widget' => '<li class="aside__item>',
        'after_widget' => '</li>',
        'before_title' => '<span aside__item-title>',
        'after_title' => '</span>',
        'before_sidebar' => '',
        'after_sidebar' => '',
    ));
}

add_action('after_setup_theme', function() {
        register_nav_menus([
            'primary_menu' => 'Главное меню',
        ]);
    });

add_filter('excerpt_more', 'new_excerpt_more');
function new_excerpt_more($more) {
    global $post;
    return ' ...';
}

add_filter('excerpt_length', function() {
    if(is_shop() || is_product_category()) {
        return 10;
    }
    return 30;
});

//WOOCOMMERCE
define('WOOCOMMERCE_USE_CSS', false);

//КОНТЕЙНЕРЫ ДЛЯ GRID СЕТКИ В КАТЕГОРИЯХ И ТОВАРАХ
function start_container_shop() {
    $shop_container = '<div class="single-product__container">';
    if(is_shop() || is_product_category()) {
        $shop_container = '<div class="shop__container product_category">';
    };
    echo "$shop_container";
}
add_action('woocommerce_before_main_content', 'start_container_shop', 10);

function woo_sidebar() {
    get_sidebar();
}
add_action('woocommerce_after_main_content', 'woo_sidebar', 0);

function end_container_shop() {
    echo '</div>';
}
add_action('woocommerce_after_main_content', 'end_container_shop', 10);


//ШАБЛОГ ТОВАРОВ В КАТЕГОРИЯХ (category__product-item) content-product.php
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

//Название товара
function product_item_name() {
    echo '<h2 class="product-category__item-title">' . '<a href="' . get_permalink() . '" alt="' . get_the_title() . '">' . get_the_title() . '</a>' .'</h2>';
}

//Описание товара
function product_item_description() {
    echo '<div class="product-category__item-description">' . get_the_excerpt() .'</div>';
}

//Цена и корзина
function product_item_price_and_cart() {
    //echo '<div class="product-category__item-footer"><div class="product-category__item-price">' . woocommerce_template_loop_price() . '</div></div>';

}

add_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_thumbnail', 5);
add_action('woocommerce_before_shop_loop_item', 'product_item_name', 10);
add_action('woocommerce_before_shop_loop_item', 'product_item_description', 10);
add_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_price', 20);
add_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 20);

?>