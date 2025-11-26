<?php
if (!defined('ABSPATH')) exit;

/* ============================================================
 * 1) Auto-select DHL when subtotal >= 200
 * ============================================================ */
add_action('woocommerce_after_shipping_rate', 'stherb_auto_dhl', 10, 2);
function stherb_auto_dhl($rate, $i) {

    $subtotal = WC()->cart->get_subtotal();
    if ($subtotal < 200) return;

    $label  = strtolower($rate->label);
    $method = strtolower($rate->method_id);

    if (
        strpos($label, 'dhl') !== false ||
        strpos($label, 'express') !== false ||
        strpos($method, 'dhl') !== false
    ) {
        $chosen = WC()->session->get('chosen_shipping_methods', []);
        $chosen[0] = $rate->id;
        WC()->session->set('chosen_shipping_methods', $chosen);
        WC()->cart->calculate_totals();
    }
}

/* ============================================================
 * 2) Auto-select Standard Shipping when subtotal 100–199
 * ============================================================ */
add_action('woocommerce_after_shipping_rate', 'stherb_auto_standard', 20, 2);
function stherb_auto_standard($rate, $i) {

    $subtotal = WC()->cart->get_subtotal();
    if ($subtotal < 100 || $subtotal >= 200) return;

    if (strpos(strtolower($rate->label), 'standard') !== false) {
        $chosen = WC()->session->get('chosen_shipping_methods', []);
        $chosen[0] = $rate->id;
        WC()->session->set('chosen_shipping_methods', $chosen);
        WC()->cart->calculate_totals();
    }
}



/* ============================================================
 * 3) Add ETA to Standard Shipping (Correct Method)
 * ============================================================ */
/**
 * การเติม ETA ต้องทำตอนเรนเดอร์ label เท่านั้น
 * ไม่สามารถทำใน woocommerce_package_rates ได้
 * เพราะ label จะถูก plugin DHL/Theme เขียนทับทีหลัง
 */
add_filter('woocommerce_cart_shipping_method_full_label', 'stherb_add_eta_to_standard_label', 10, 2);
function stherb_add_eta_to_standard_label($label, $method) {

    // ถ้าไม่ใช่ลูกค้า / ไม่มี country ให้คืนค่าเดิม
    if (!WC()->customer) {
        return $label;
    }

    // เฉพาะ Standard Shipping เท่านั้น
    if (stripos($label, 'standard') === false) {
        return $label;
    }

    // Country — CA, US, TH, AU, etc
    $country = WC()->customer->get_shipping_country();
    if (empty($country)) {
        return $label;
    }

    // หาโซนตามประเทศ
    $zone = stherb_get_zone($country);
    if (empty($zone)) {
        return $label;
    }

    // หา ETA ของโซน
    $eta_text = stherb_get_eta($zone, $country);
    if (empty($eta_text)) {
        return $label;
    }

    // เพิ่มบรรทัด ETA ใต้ Standard Shipping
    $label .= '<br><small style="color:#666;">' . esc_html($eta_text) . '</small>';

    return $label;
}