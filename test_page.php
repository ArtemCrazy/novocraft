<?php
require_once('wp-load.php');
$page = get_page_by_title('Мебель для дома');
if(!$page) $page = get_page_by_title('Для дома');
if(!$page) $page = get_page_by_path('furniture');
if($page) echo "PAGE FOUND: " . $page->ID . " Slug: " . $page->post_name;
else echo "PAGE NOT FOUND";
