<?php
// api/get_settings.php
// Returns JSON containing current session settings used by the POS client
// Place this file inside your api/ folder.

session_start();

// Optional: require authentication here if your POS requires login
// if (!isset($_SESSION['user_id'])) {
//     http_response_code(401);
//     echo json_encode(['error' => 'unauthenticated']);
//     exit;
// }

header('Content-Type: application/json');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');

$tax = isset($_SESSION['tax']) ? floatval($_SESSION['tax']) : 12.0;
$service = isset($_SESSION['service_charge']) ? floatval($_SESSION['service_charge']) : 10.0;
$dark = isset($_SESSION['dark_mode']) ? boolval($_SESSION['dark_mode']) : false;
$accent = isset($_SESSION['accent_color']) ? $_SESSION['accent_color'] : '#d33fd3';
$notify_sound = isset($_SESSION['notify_sound']) ? boolval($_SESSION['notify_sound']) : false;
$notify_order = isset($_SESSION['notify_order']) ? boolval($_SESSION['notify_order']) : false;
$notify_low_stock = isset($_SESSION['notify_low_stock']) ? boolval($_SESSION['notify_low_stock']) : false;
$currency = isset($_SESSION['currency']) ? $_SESSION['currency'] : 'PHP';

echo json_encode([
    'tax' => $tax,
    'service_charge' => $service,
    'dark_mode' => $dark,
    'accent_color' => $accent,
    'notifications' => [
        'sound' => $notify_sound,
        'orderAlerts' => $notify_order,
        'lowStock' => $notify_low_stock
    ],
    'currency' => $currency
]);