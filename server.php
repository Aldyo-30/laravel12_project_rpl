<?php

// Set konfigurasi PHP untuk upload file besar
ini_set('upload_max_filesize', '20M');
ini_set('post_max_size', '20M');
ini_set('memory_limit', '256M');
ini_set('max_execution_time', '300');
ini_set('max_input_time', '300');

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// This file allows us to emulate Apache's "mod_rewrite" functionality from the
// built-in PHP web server. This provides a convenient way to test a Laravel
// application without having installed a "real" web server software here.
if ($uri !== '/' && file_exists(__DIR__ . '/public' . $uri)) {
    return false;
}

require_once __DIR__ . '/public/index.php';
