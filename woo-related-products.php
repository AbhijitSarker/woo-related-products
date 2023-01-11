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

add_action('wp_enqueue_scripts', 'rel_pro_enqueue_files');

function rel_pro_enqueue_files()
{
    $dir = plugin_dir_url(__FILE__);

    wp_enqueue_style('stylesheet', $dir . 'js/related-product-slider.css');
    wp_enqueue_style('animate', $dir . 'js/animate.css');

    wp_enqueue_script('scriptjs', $dir . 'js/jquery.min.js');
    wp_enqueue_script('relatedpro', $dir . 'js/related-product-slider.min.js');
    wp_enqueue_script('main', $dir . 'js/main.js');
}



remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

function woocommerce_output_related_products()
{
}

add_action('woocommerce_after_single_product_summary', 'rel_pro_ralated_product', 999);
function rel_pro_ralated_product()
{
    global $product;

?>
    <div class="mx-product-slider">

        <!-- first slide -->
        <div>

            <!-- main image -->
            <img src="1.jpg" alt="" />

            <!-- banner -->
            <div class="mx-slide-banner">
                <a href="#">
                    <img src="banner-1.png" alt="">
                </a>
            </div>

            <!-- Related productss slider -->
            <ul class="mx-related-products">

                <!-- product 1 -->
                <li>
                    <a href="#">
                        <span class="mx-price">$7.90</span> <img src="product1.png" alt="" />
                    </a>
                </li>

                <!-- product 2 -->
                <li>
                    <a href="#">
                        <span class="mx-price">$7.90</span> <img src="product1.png" alt="" />
                    </a>
                </li>

                <!-- product 3 ... -->

            </ul>

        </div>

        <!-- next slide ... -->

    </div>

<?php

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
