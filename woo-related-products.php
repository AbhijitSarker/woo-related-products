<?php

/**
 * Plugin Name:       Woo Related Products
 * Plugin URI:        https://github.com/AbhijitSarker
 * Description:       Add custom tabs in the product edit page.
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Abhijit Sarker
 * Author URI:        https://github.com/AbhijitSarker
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       rel_pro
 * Domain Path:       /languages
 */

if (!defined('ABSPATH')) {
    die;
}


define("PLUGINS_DIR", plugin_dir_path(__FILE__));
define("PLUGINS_PATH_ASSETS", plugin_dir_url(__FILE__) . 'assets/');
define("PLUGINS_DIR_IMG", plugin_dir_url(__FILE__) . 'assets/img/');

add_action('wp_enqueue_scripts', 'rel_pro_enqueue_files');

function rel_pro_enqueue_files()
{

    wp_enqueue_style('product-slider', PLUGINS_PATH_ASSETS . 'css/related-product-slider.css');
    wp_enqueue_style('animate', PLUGINS_PATH_ASSETS . 'css/animate.css');

    wp_enqueue_script('relatedpro', PLUGINS_PATH_ASSETS . 'js/related-product-slider.min.js', array('jquery'), false, true);
    wp_enqueue_script('script', PLUGINS_PATH_ASSETS . 'js/script.js', array('jquery'), false, true);
}



remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

function woocommerce_output_related_products()
{
}

add_action('woocommerce_after_single_product_summary', 'rel_pro_ralated_product', 999);
function rel_pro_ralated_product()
{
    require(PLUGINS_DIR . '/views/slider-template.php');
}




add_filter('woocommerce_related_products', 'QuadLayers_related_products_by_same_title', 9999, 3);

function QuadLayers_related_products_by_same_title($related_posts, $product_id, $args)
{
    $product = wc_get_product($product_id);
    $title = $product->get_name();
    $related_posts = get_posts(array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'title' => $title,
        'fields' => 'ids',
        'posts_per_page' => -1,
        'exclude' => array($product_id),
    ));
    return $related_posts;
}
