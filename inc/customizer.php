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
        'contact_phone'     => [ 'label' => 'Телефон (для ссылки tel:)',       'default' => '+79160128777' ],
        'contact_phone_fmt' => [ 'label' => 'Телефон (для отображения)',       'default' => '+7 (916) 012-87-77' ],
        'contact_telegram'  => [ 'label' => 'Telegram (username без @)',       'default' => 'novikov8777' ],
        'contact_whatsapp'  => [ 'label' => 'WhatsApp (номер для wa.me/...)',  'default' => '79160128777' ],
        'contact_address'   => [ 'label' => 'Адрес',                          'default' => 'г. Нижний Новгород, ул. Маршала Воронова, 11' ],
        'contact_hours'     => [ 'label' => 'Часы работы',                    'default' => 'Ежедневно с 9:00 до 21:00' ],
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

function nc_phone()     { return get_theme_mod( 'contact_phone',     '+79160128777' ); }
function nc_phone_fmt() { return get_theme_mod( 'contact_phone_fmt', '+7 (916) 012-87-77' ); }
function nc_telegram()  { return get_theme_mod( 'contact_telegram',  'novikov8777' ); }
function nc_whatsapp()  { return get_theme_mod( 'contact_whatsapp',  '79160128777' ); }
function nc_address()   { return get_theme_mod( 'contact_address',   'г. Нижний Новгород, ул. Маршала Воронова, 11' ); }
function nc_hours()     { return get_theme_mod( 'contact_hours',     'Ежедневно с 9:00 до 21:00' ); }
