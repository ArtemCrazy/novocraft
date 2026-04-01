<?php
require 'wp-load.php';
if (function_exists('wp_cache_flush')) {
    wp_cache_flush();
    echo "WP Cache Flushed.\n";
}
if (function_exists('w3tc_flush_all')) {
    w3tc_flush_all();
    echo "W3TC Flushed.\n";
}
if (function_exists('rocket_clean_domain')) {
    rocket_clean_domain();
    echo "WP Rocket Flushed.\n";
}
// Clear opcache
if (function_exists('opcache_reset')) {
    opcache_reset();
    echo "OPcache reset.\n";
}
echo "Cache cleared.";
