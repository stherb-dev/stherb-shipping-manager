<?php
if (!defined('ABSPATH')) exit;

add_filter('woocommerce_package_rates', 'stherb_price_rules', 10000, 2);
function stherb_price_rules($rates, $package) {

    $subtotal = WC()->cart->get_subtotal();

    foreach ($rates as $id => $rate) {

        $label  = strtolower($rate->label);
        $method = strtolower($rate->method_id);

        // Standard Shipping
        if (strpos($label, 'standard') !== false) {
            if ($subtotal >= 100) {
                $rate->cost  = 0;
                $rate->label = "Standard Shipping – FREE";
            } else {
                $rate->cost  = 10;
                $rate->label = "Standard Shipping";
            }
        }

        // DHL Express
        if (strpos($label, 'dhl') !== false ||
            strpos($label, 'express') !== false ||
            strpos($method, 'dhl') !== false) {

            if ($subtotal >= 200) {
                $rate->cost  = 0;
                $rate->label = "DHL Express – FREE";
            }
        }
    }

    return $rates;
}