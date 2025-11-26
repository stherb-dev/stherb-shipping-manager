<?php
/**
 * Plugin Name: Stherb Shipping Manager
 * Description: Custom Standard + DHL shipping rules with ETA message.
 * Version: 1.1.0
 * Author: Jaruwat Amnuaysat
 */

if (!defined('ABSPATH')) exit;

// Load all module files (simple include)
include_once(__DIR__ . '/includes/zones.php');
include_once(__DIR__ . '/includes/eta.php');
include_once(__DIR__ . '/includes/pricing.php');
include_once(__DIR__ . '/includes/autoselect.php');