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

remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

function woocommerce_output_related_products()
{
}

add_action('woocommerce_after_single_product_summary', 'rel_pro_ralated_product', 999);
function rel_pro_ralated_product()
{
    global $product;
    $product_id = $product->get_id();
    $product_cat = $product->get_category_ids();
    echo $product_id;
    var_dump($product_cat);
}
