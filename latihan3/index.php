<?php
require_once __DIR__ . '/helpers/functions.php';

$routes = [
    'home' => __DIR__ . '/views/home.php',
    'profil' => __DIR__ . '/views/profil.php',
    'kontak' => __DIR__ . '/views/kontak.php',
    'produk' => __DIR__ . '/views/produk.php',
    'tentang' => __DIR__ . '/views/tentang.php',
];

$page = $_GET['page'] ?? 'home';

if (!is_string($page) || !array_key_exists($page, $routes)) {
    http_response_code(404);
    $contentFile = __DIR__ . '/views/404.php';
} else {
    $contentFile = $routes[$page];
}

require_once __DIR__ . '/views/header.php';
require $contentFile;
require_once __DIR__ . '/views/footer.php';
?>
