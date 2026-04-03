<?php
/**
 * Theme Customizer — глобальные контактные данные.
 * Клиент: Внешний вид → Настроить → Контакты.
 * Значения выводятся везде: шапка, секция контактов, футер.
 */

function novacraft_customizer( $wp_customize ) {

    $wp_customize->add_section( 'novacraft_contacts', [
        'title'    => 'Контакты',
        'priority' => 30,
    ] );

    $fields = [
        // Основные
        'contact_phone'         => [ 'label' => 'Телефон (для ссылки tel:)',           'default' => '+79160128777' ],
        'contact_phone_fmt'     => [ 'label' => 'Телефон (для отображения)',           'default' => '+7 (916) 012-87-77' ],
        'contact_email'         => [ 'label' => 'Email',                               'default' => '9160128777@mail.ru' ],
        'contact_telegram'      => [ 'label' => 'Telegram (username без @)',           'default' => 'novikov8777' ],
        'contact_whatsapp'      => [ 'label' => 'WhatsApp (номер для wa.me/...)',      'default' => '79160128777' ],
        'contact_hours'         => [ 'label' => 'Часы работы',                        'default' => 'Ежедневно с 9:00 до 21:00' ],
        // Офис Москва
        'contact_moscow_address'=> [ 'label' => 'Адрес офиса (Москва)',               'default' => 'г. Москва, ул. Перовское шоссе, д2к2' ],
        'contact_moscow_map'    => [ 'label' => 'Карта офиса Москва (URL iframe)',     'default' => 'https://yandex.ru/map-widget/v1/?ll=37.740172%2C55.734105&z=16&pt=37.740172%2C55.734105%2Cpm2gnl' ],
        // Производство НН
        'contact_address'       => [ 'label' => 'Адрес производства (Нижний Новгород)', 'default' => 'г. Нижний Новгород, ул. Маршала Воронова, 11' ],
        'contact_nn_map'        => [ 'label' => 'Карта производства НН (URL iframe)',  'default' => 'https://yandex.ru/map-widget/v1/?ll=43.921385%2C56.331206&z=16&pt=43.921385%2C56.331206%2Cpm2gnl' ],
    ];

    foreach ( $fields as $key => $args ) {
        $wp_customize->add_setting( $key, [
            'default'           => $args['default'],
            'sanitize_callback' => 'sanitize_text_field',
        ] );
        $wp_customize->add_control( $key, [
            'label'   => $args['label'],
            'section' => 'novacraft_contacts',
            'type'    => 'text',
        ] );
    }
}
add_action( 'customize_register', 'novacraft_customizer' );

// ── Хелперы для шаблонов ─────────────────────────────────────────────────────

function nc_phone()          { return get_theme_mod( 'contact_phone',          '+79160128777' ); }
function nc_phone_fmt()      { return get_theme_mod( 'contact_phone_fmt',      '+7 (916) 012-87-77' ); }
function nc_email()          { return get_theme_mod( 'contact_email',          '9160128777@mail.ru' ); }
function nc_telegram()       { return get_theme_mod( 'contact_telegram',       'novikov8777' ); }
function nc_whatsapp()       { return get_theme_mod( 'contact_whatsapp',       '79160128777' ); }
function nc_hours()          { return get_theme_mod( 'contact_hours',          'Ежедневно с 9:00 до 21:00' ); }
function nc_moscow_address() { return get_theme_mod( 'contact_moscow_address', 'г. Москва, ул. Перовское шоссе, д2к2' ); }
function nc_moscow_map()     { return get_theme_mod( 'contact_moscow_map',     'https://yandex.ru/map-widget/v1/?ll=37.740172%2C55.734105&z=16&pt=37.740172%2C55.734105%2Cpm2gnl' ); }
function nc_address()        { return get_theme_mod( 'contact_address',        'г. Нижний Новгород, ул. Маршала Воронова, 11' ); }
function nc_nn_map()         { return get_theme_mod( 'contact_nn_map',         'https://yandex.ru/map-widget/v1/?ll=43.921385%2C56.331206&z=16&pt=43.921385%2C56.331206%2Cpm2gnl' ); }
