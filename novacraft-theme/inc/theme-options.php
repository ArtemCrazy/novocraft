<?php
// Native Theme Options Page
function nc_add_theme_menu_item() {
    add_menu_page('Настройки сайта', 'Настройки сайта', 'manage_options', 'nc-theme-options', 'nc_theme_settings_page', null, 99);
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
