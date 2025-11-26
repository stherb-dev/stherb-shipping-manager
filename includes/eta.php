<?php

if (!defined('ABSPATH')) exit;

function stherb_get_eta($zone) {

    // ETA สำหรับแต่ละโซนตามข้อมูลจริง
    $map = [
        1 => "Estimated 7–14 business days",   // Asia & Oceania
        2 => "Estimated 10–15 business days",  // Europe & Africa
        3 => "Estimated 14–21 business days",  // Americas
    ];

    // ถ้าไม่พบโซนที่กำหนด
    return $map[$zone] ?? "Estimated 10–20 business days";
}
