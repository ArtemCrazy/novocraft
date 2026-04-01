<?php
/**
 * Native Meta Box for Front Page (ACF Alternative)
 */

function nc_home_add_meta_box() {
    $post_id = isset($_GET['post']) ? $_GET['post'] : (isset($_POST['post_ID']) ? $_POST['post_ID'] : 0);
    if (!$post_id) return;
    
    // Check if it's the front page
    if ($post_id == get_option('page_on_front')) {
        add_meta_box(
            'nc_home_hero_meta',
            'Настройки Главного Экрана',
            'nc_home_hero_meta_callback',
            'page',
            'normal',
            'high'
        );
    }
}
add_action('add_meta_boxes', 'nc_home_add_meta_box');

function nc_home_hero_meta_callback($post) {
    wp_nonce_field('nc_home_hero_save', 'nc_home_hero_nonce');
    
    $h_badge = get_post_meta($post->ID, 'h_badge', true) ?: 'Собственное производство';
    $h_title = get_post_meta($post->ID, 'h_title', true) ?: 'Мебель на заказ<br>с душой и <span>характером</span>';
    $h_desc = get_post_meta($post->ID, 'h_desc', true) ?: 'Семейное производство с 1996 года...';
    
    ?>
    <style>
        .nc-meta-field { margin-bottom: 15px; }
        .nc-meta-field label { display: block; font-weight: bold; margin-bottom: 5px; }
        .nc-meta-field input[type="text"], .nc-meta-field textarea { width: 100%; max-width: 600px; }
    </style>
    <div class="nc-meta-field">
        <label for="h_badge">Бейдж (над заголовком)</label>
        <input type="text" id="h_badge" name="h_badge" value="<?php echo esc_attr($h_badge); ?>">
    </div>
    <div class="nc-meta-field">
        <label for="h_title">Заголовок (можно использовать HTML)</label>
        <textarea id="h_title" name="h_title" rows="3"><?php echo esc_textarea($h_title); ?></textarea>
    </div>
    <div class="nc-meta-field">
        <label for="h_desc">Описание</label>
        <textarea id="h_desc" name="h_desc" rows="3"><?php echo esc_textarea($h_desc); ?></textarea>
    </div>
    <p><em>Сохраните страницу, и эти данные обновятся на сайте.</em></p>
    <?php
}

function nc_home_hero_save_meta($post_id) {
    if (!isset($_POST['nc_home_hero_nonce']) || !wp_verify_nonce($_POST['nc_home_hero_nonce'], 'nc_home_hero_save')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_page', $post_id)) return;

    if (isset($_POST['h_badge'])) update_post_meta($post_id, 'h_badge', sanitize_text_field($_POST['h_badge']));
    if (isset($_POST['h_title'])) update_post_meta($post_id, 'h_title', wp_kses_post($_POST['h_title']));
    if (isset($_POST['h_desc'])) update_post_meta($post_id, 'h_desc', sanitize_textarea_field($_POST['h_desc']));
}
add_action('save_post', 'nc_home_hero_save_meta');
