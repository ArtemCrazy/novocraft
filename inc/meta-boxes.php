<?php
/**
 * Meta Box: Тексты главной страницы
 * Выводится только на странице, которая задана как «Главная».
 * Редактирование: WP Admin → Страницы → Главная.
 */

// ── Регистрация ──────────────────────────────────────────────────────────────

function novacraft_add_meta_boxes() {
    $front_id = (int) get_option( 'page_on_front' );
    if ( ! $front_id ) return;

    add_meta_box(
        'nc_hero_texts',
        'Герой — тексты баннера',
        'novacraft_hero_meta_box',
        'page',
        'normal',
        'high'
    );

    add_meta_box(
        'nc_about_texts',
        'О производстве — тексты',
        'novacraft_about_meta_box',
        'page',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'novacraft_add_meta_boxes' );

// Показываем meta box только на странице «Главная»
function novacraft_meta_box_screen( $post ) {
    return (int) $post->ID === (int) get_option( 'page_on_front' );
}

// ── Рендер: Герой ────────────────────────────────────────────────────────────

function novacraft_hero_meta_box( $post ) {
    if ( ! novacraft_meta_box_screen( $post ) ) {
        echo '<p style="color:#999">Этот блок активен только на странице «Главная».</p>';
        return;
    }
    wp_nonce_field( 'nc_save_hero', 'nc_hero_nonce' );

    $fields = [
        '_nc_hero_badge'    => 'Бейдж над заголовком',
        '_nc_hero_title'    => 'Заголовок H1 (первая строка)',
        '_nc_hero_title_em' => 'Заголовок H1 (выделенная часть)',
        '_nc_hero_desc'     => 'Подзаголовок',
    ];

    $benefits = [
        1 => 'Преимущество 1',
        2 => 'Преимущество 2',
        3 => 'Преимущество 3',
    ];

    echo '<table class="form-table"><tbody>';
    foreach ( $fields as $key => $label ) {
        $val = esc_attr( get_post_meta( $post->ID, $key, true ) );
        echo "<tr><th><label for='{$key}'>{$label}</label></th>";
        echo "<td><input type='text' id='{$key}' name='{$key}' value='{$val}' class='large-text'></td></tr>";
    }
    foreach ( $benefits as $i => $label ) {
        $t = esc_attr( get_post_meta( $post->ID, "_nc_hero_benefit_{$i}_title", true ) );
        $s = esc_attr( get_post_meta( $post->ID, "_nc_hero_benefit_{$i}_text",  true ) );
        echo "<tr><th>{$label} — заголовок</th><td><input type='text' name='_nc_hero_benefit_{$i}_title' value='{$t}' class='large-text'></td></tr>";
        echo "<tr><th>{$label} — подпись</th><td><input type='text' name='_nc_hero_benefit_{$i}_text' value='{$s}' class='large-text'></td></tr>";
    }
    echo '</tbody></table>';
}

// ── Рендер: О производстве ───────────────────────────────────────────────────

function novacraft_about_meta_box( $post ) {
    if ( ! novacraft_meta_box_screen( $post ) ) {
        echo '<p style="color:#999">Этот блок активен только на странице «Главная».</p>';
        return;
    }
    wp_nonce_field( 'nc_save_about', 'nc_about_nonce' );

    $title = esc_attr( get_post_meta( $post->ID, '_nc_about_title', true ) );
    $text1 = esc_textarea( get_post_meta( $post->ID, '_nc_about_text_1', true ) );
    $text2 = esc_textarea( get_post_meta( $post->ID, '_nc_about_text_2', true ) );

    echo '<table class="form-table"><tbody>';
    echo "<tr><th><label for='_nc_about_title'>Заголовок раздела</label></th>";
    echo "<td><input type='text' id='_nc_about_title' name='_nc_about_title' value='{$title}' class='large-text'></td></tr>";
    echo "<tr><th><label for='_nc_about_text_1'>Первый абзац<br><small>Можно &lt;strong&gt;жирный&lt;/strong&gt;</small></label></th>";
    echo "<td><textarea id='_nc_about_text_1' name='_nc_about_text_1' rows='4' class='large-text'>{$text1}</textarea></td></tr>";
    echo "<tr><th><label for='_nc_about_text_2'>Второй абзац</label></th>";
    echo "<td><textarea id='_nc_about_text_2' name='_nc_about_text_2' rows='4' class='large-text'>{$text2}</textarea></td></tr>";
    echo '</tbody></table>';
}

// ── Сохранение ───────────────────────────────────────────────────────────────

function novacraft_save_meta_boxes( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( get_post_type( $post_id ) !== 'page' ) return;
    if ( (int) $post_id !== (int) get_option( 'page_on_front' ) ) return;

    // Герой
    if ( isset( $_POST['nc_hero_nonce'] ) && wp_verify_nonce( $_POST['nc_hero_nonce'], 'nc_save_hero' ) ) {
        $hero_fields = [ '_nc_hero_badge', '_nc_hero_title', '_nc_hero_title_em', '_nc_hero_desc' ];
        foreach ( $hero_fields as $key ) {
            if ( isset( $_POST[ $key ] ) ) {
                update_post_meta( $post_id, $key, sanitize_text_field( $_POST[ $key ] ) );
            }
        }
        for ( $i = 1; $i <= 3; $i++ ) {
            foreach ( [ 'title', 'text' ] as $part ) {
                $key = "_nc_hero_benefit_{$i}_{$part}";
                if ( isset( $_POST[ $key ] ) ) {
                    update_post_meta( $post_id, $key, sanitize_text_field( $_POST[ $key ] ) );
                }
            }
        }
    }

    // О производстве
    if ( isset( $_POST['nc_about_nonce'] ) && wp_verify_nonce( $_POST['nc_about_nonce'], 'nc_save_about' ) ) {
        if ( isset( $_POST['_nc_about_title'] ) ) {
            update_post_meta( $post_id, '_nc_about_title', sanitize_text_field( $_POST['_nc_about_title'] ) );
        }
        if ( isset( $_POST['_nc_about_text_1'] ) ) {
            update_post_meta( $post_id, '_nc_about_text_1', wp_kses_post( $_POST['_nc_about_text_1'] ) );
        }
        if ( isset( $_POST['_nc_about_text_2'] ) ) {
            update_post_meta( $post_id, '_nc_about_text_2', sanitize_textarea_field( $_POST['_nc_about_text_2'] ) );
        }
    }
}
add_action( 'save_post', 'novacraft_save_meta_boxes' );
