<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once 'wp-load.php';
echo "Loaded WP.\n";
try {
    include get_stylesheet_directory() . '/front-page.php';
} catch (Throwable $t) {
    echo "Fatal Error: " . $t->getMessage() . " in " . $t->getFile() . " on line " . $t->getLine();
}
