<?php
require 'wp-load.php';
$content = file_get_contents(get_template_directory() . '/functions.php');
if (strpos($content, 'nc_add_theme_menu_item') !== false) {
    echo "Menu code EXISTS in functions.php\n";
} else {
    echo "Menu code is MISSING in functions.php. Last modified: " . date("F d Y H:i:s.", filemtime(get_template_directory() . '/functions.php')) . "\n";
}
