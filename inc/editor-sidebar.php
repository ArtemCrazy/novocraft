<?php
/**
 * Gutenberg Sidebar Panel — тексты главной страницы.
 * Клиент: WP Admin → Страницы → Главная → правая панель «Документ».
 */

// ── Регистрация post meta для REST API (обязательно для Gutenberg) ────────────
function novacraft_register_home_meta() {
    $keys = [
        '_nc_hero_badge',
        '_nc_hero_title',
        '_nc_hero_title_em',
        '_nc_hero_desc',
        '_nc_hero_benefit_1_title',
        '_nc_hero_benefit_1_text',
        '_nc_hero_benefit_2_title',
        '_nc_hero_benefit_2_text',
        '_nc_hero_benefit_3_title',
        '_nc_hero_benefit_3_text',
        '_nc_about_title',
        '_nc_about_text_1',
        '_nc_about_text_2',
    ];

    foreach ( $keys as $key ) {
        register_post_meta( 'page', $key, [
            'show_in_rest'  => true,
            'single'        => true,
            'type'          => 'string',
            'default'       => '',
            'auth_callback' => function () {
                return current_user_can( 'edit_posts' );
            },
        ] );
    }
}
add_action( 'init', 'novacraft_register_home_meta' );

// ── Подключение JS только в редакторе блоков ─────────────────────────────────
function novacraft_enqueue_editor_sidebar() {
    $js_path = get_template_directory() . '/assets/js/editor-sidebar.js';
    if ( ! file_exists( $js_path ) ) return;

    wp_enqueue_script(
        'nc-editor-sidebar',
        get_template_directory_uri() . '/assets/js/editor-sidebar.js',
        [ 'wp-plugins', 'wp-edit-post', 'wp-element', 'wp-components', 'wp-data', 'wp-core-data' ],
        filemtime( $js_path ),
        true
    );

    wp_localize_script( 'nc-editor-sidebar', 'ncEditorData', [
        'frontPageId' => (int) get_option( 'page_on_front' ),
    ] );
}
add_action( 'enqueue_block_editor_assets', 'novacraft_enqueue_editor_sidebar' );
