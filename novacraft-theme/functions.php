<?php
/**
 * Novacraft functions and definitions
 */

// 1. Theme Setup
function novacraft_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    // Enable support for Gutenberg wide/full align and styles
    add_theme_support('align-wide');
    add_theme_support('editor-styles');
    add_theme_support('wp-block-styles');
}
add_action('after_setup_theme', 'novacraft_setup');

// 2. Enqueue Scripts & Styles
function novacraft_enqueue_scripts() {
    wp_enqueue_style('novacraft-style', get_stylesheet_uri(), array(), '1.0');
    wp_enqueue_script('novacraft-script', get_template_directory_uri() . '/script.js', array(), '1.0', true);
    
    // Check if on catalog
    if (is_post_type_archive('furniture') || is_tax('furniture_cat')) {
        wp_enqueue_script('novacraft-catalog', get_template_directory_uri() . '/catalog.js', array(), '1.0', true);
    }
    // Check if on single product
    if (is_singular('furniture')) {
        wp_enqueue_script('novacraft-product', get_template_directory_uri() . '/product.js', array(), '1.0', true);
    }
}
add_action('wp_enqueue_scripts', 'novacraft_enqueue_scripts');

// 3. Register Custom Post Types & Taxonomies
function novacraft_register_cpt() {
    // Furniture CPT
    register_post_type('furniture', array(
        'labels' => array(
            'name' => 'Мебель для дома',
            'singular_name' => 'Единица мебели',
            'add_new_item' => 'Добавить мебель',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-admin-home',
    ));

    // Furniture Category Tax
    register_taxonomy('furniture_cat', 'furniture', array(
        'labels' => array(
            'name' => 'Категории мебели',
            'singular_name' => 'Категория',
        ),
        'hierarchical' => true,
        'public' => true,
    ));

    // Projects CPT
    register_post_type('project', array(
        'labels' => array(
            'name' => 'Проекты',
            'singular_name' => 'Проект',
            'add_new_item' => 'Добавить проект',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-portfolio',
    ));

    // Projects Category Tax
    register_taxonomy('project_cat', 'project', array(
        'labels' => array(
            'name' => 'Категории проектов',
            'singular_name' => 'Категория',
        ),
        'hierarchical' => true,
        'public' => true,
    ));
}
add_action('init', 'novacraft_register_cpt');

// Contacts Helper
function novacraft_contacts() {
    $defaults = array(
        'phone'        => '+7 (916) 012-87-77',
        'phone_raw'    => '+79160128777',
        'email'        => '9160128777@mail.ru',
        'whatsapp'     => 'https://wa.me/79160128777',
        'telegram'     => 'https://t.me/novikov8777',
        'tg_username'  => '@novikov8777',
        'max'          => 'https://max.ru/novikov8777',
        'address_msk'  => 'г. Москва, МО, Нижний Новгород',
        'address_msk_full' => 'г. Москва, ул. Перовское шоссе, д2к2',
        'address_nn'   => 'г. Нижний Новгород, ул. Маршала Воронова, 11',
        'work_hours'   => 'Ежедневно 9:00–21:00',
        'map_url_msk'  => 'https://yandex.ru/map-widget/v1/?ll=37.740172%2C55.734105&z=16&pt=37.740172%2C55.734105%2Cpm2gnl',
        'map_url_nn'   => 'https://yandex.ru/map-widget/v1/?ll=43.921385%2C56.331206&z=16&pt=43.921385%2C56.331206%2Cpm2gnl',
    );
    
    $cache = array();
    foreach ($defaults as $key => $default) {
        $val = get_option('nc_' . $key);
        $cache[$key] = $val ? $val : $default;
    }
    return $cache;
}

// ====== NATIVE THEME OPTIONS PAGE ======
function nc_add_theme_menu_item() {
    add_menu_page('Настройки сайта', 'Настройки сайта', 'manage_options', 'nc-theme-options', 'nc_theme_settings_page', 'dashicons-admin-generic', 60);
}
add_action('admin_menu', 'nc_add_theme_menu_item');

function nc_theme_settings_page() {
    ?>
    <div class="wrap">
        <h1>Настройки сайта (Контакты)</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('nc_theme_options_group');
            do_settings_sections('nc-theme-options');
            submit_button('Сохранить настройки');
            ?>
        </form>
    </div>
    <?php
}

function nc_display_theme_panel_fields() {
    add_settings_section('nc_contacts_section', 'Контактные данные', null, 'nc-theme-options');

    $fields = [
        'phone' => 'Телефон (текст)',
        'phone_raw' => 'Телефон (ссылка, вида +79160128777)',
        'email' => 'Email',
        'whatsapp' => 'WhatsApp (ссылка)',
        'telegram' => 'Telegram (ссылка)',
        'tg_username' => 'Telegram Username (текст)',
        'max' => 'Max (ссылка)',
        'address_msk' => 'Краткий адрес',
        'address_msk_full' => 'Полный адрес Москва',
        'address_nn' => 'Полный адрес НН',
        'work_hours' => 'Время работы',
        'map_url_msk' => 'Ссылка виджета карты (Москва)',
        'map_url_nn' => 'Ссылка виджета карты (НН)'
    ];

    foreach($fields as $id => $label) {
        add_settings_field('nc_'.$id, $label, 'nc_display_setting', 'nc-theme-options', 'nc_contacts_section', ['id' => 'nc_'.$id]);
        register_setting('nc_theme_options_group', 'nc_'.$id);
    }
}
add_action('admin_init', 'nc_display_theme_panel_fields');

function nc_display_setting($args) {
    $val = get_option($args['id']);
    echo '<input type="text" name="' . esc_attr($args['id']) . '" value="' . esc_attr($val) . '" class="regular-text" />';
}
