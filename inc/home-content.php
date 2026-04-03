<?php
/**
 * Хелперы для чтения текстов главной страницы из Gutenberg-блоков.
 * Страница «Главная» содержит две группы блоков:
 *   .nc-hero  — тексты героя (10 блоков)
 *   .nc-about — тексты секции «О производстве» (3 блока)
 */

function nc_front_blocks() {
    static $cache = null;
    if ( $cache !== null ) return $cache;

    $front_id = (int) get_option( 'page_on_front' );
    $content  = get_post_field( 'post_content', $front_id );
    $blocks   = parse_blocks( $content );

    $hero  = [];
    $about = [];

    foreach ( $blocks as $b ) {
        if ( $b['blockName'] !== 'core/group' ) continue;
        $cls = isset( $b['attrs']['className'] ) ? $b['attrs']['className'] : '';
        if ( strpos( $cls, 'nc-hero' )  !== false ) $hero  = $b['innerBlocks'];
        if ( strpos( $cls, 'nc-about' ) !== false ) $about = $b['innerBlocks'];
    }

    $cache = [ 'hero' => $hero, 'about' => $about ];
    return $cache;
}

// Возвращает plain-text из блока героя по индексу
function nc_hero( $index, $default = '' ) {
    $data   = nc_front_blocks();
    $blocks = $data['hero'];
    if ( ! isset( $blocks[ $index ] ) ) return $default;
    $text = trim( wp_strip_all_tags( render_block( $blocks[ $index ] ) ) );
    return $text !== '' ? $text : $default;
}

// Возвращает HTML (с разрешёнными тегами) из блока «О производстве»
function nc_about( $index, $default = '', $allow_html = false ) {
    $data   = nc_front_blocks();
    $blocks = $data['about'];
    if ( ! isset( $blocks[ $index ] ) ) return $default;
    $html = render_block( $blocks[ $index ] );
    // Снимаем обёрточный тег (<p>, <h2> и т.д.), оставляем содержимое
    $html = preg_replace( '/^\s*<[^>]+>/',  '', $html );
    $html = preg_replace( '/<\/[^>]+>\s*$/', '', trim( $html ) );
    if ( $allow_html ) {
        return wp_kses( $html, [ 'strong' => [], 'em' => [], 'br' => [] ] );
    }
    return wp_strip_all_tags( $html );
}
