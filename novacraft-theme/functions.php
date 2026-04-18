<?php
/**
 * Novacraft functions and definitions
 */

// One-time cleanup for post/term slugs corrupted by wpdb placeholder-escape leak.
// Corrupt slugs look like {<64-hex-hash>}d1{<hash>}82{<hash>}... — produced when
// Cyrillic (URL-encoded with %) slugs passed through a buggy prepare/escape cycle.
// Rewrites to clean Latin transliteration. Remove this block after one successful run.
add_action('init', function() {
    if (get_option('nc_slug_fix_v1_done')) return;
    global $wpdb;

    $cyr = [
        'а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'yo','ж'=>'zh',
        'з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o',
        'п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'c',
        'ч'=>'ch','ш'=>'sh','щ'=>'sch','ъ'=>'','ы'=>'y','ь'=>'','э'=>'e','ю'=>'yu','я'=>'ya',
    ];
    $translit = function($s) use ($cyr) { return strtr(mb_strtolower($s, 'UTF-8'), $cyr); };

    $posts = $wpdb->get_results("SELECT ID, post_title, post_type, post_status FROM {$wpdb->posts} WHERE post_name REGEXP '^\\\\{[a-f0-9]{40,}'");
    foreach ($posts as $p) {
        $base = sanitize_title($translit($p->post_title));
        if (!$base) $base = $p->post_type . '-' . $p->ID;
        $slug = wp_unique_post_slug($base, $p->ID, $p->post_status, $p->post_type, 0);
        $wpdb->update($wpdb->posts, ['post_name' => $slug], ['ID' => $p->ID]);
    }

    $terms = $wpdb->get_results("SELECT t.term_id, t.name, tt.taxonomy, tt.parent FROM {$wpdb->terms} t JOIN {$wpdb->term_taxonomy} tt ON tt.term_id = t.term_id WHERE t.slug REGEXP '^\\\\{[a-f0-9]{40,}'");
    foreach ($terms as $t) {
        $base = sanitize_title($translit($t->name));
        if (!$base) $base = 'term-' . $t->term_id;
        $term_obj = (object) ['taxonomy' => $t->taxonomy, 'parent' => (int) $t->parent];
        $slug = wp_unique_term_slug($base, $term_obj);
        $wpdb->update($wpdb->terms, ['slug' => $slug], ['term_id' => $t->term_id]);
    }

    update_option('nc_slug_fix_v1_done', 1);
    flush_rewrite_rules(false);
}, 20);

// Same placeholder-escape leak also corrupted post_content / postmeta / options —
// every "%" char was replaced with "{<64-hex-hash>}" (e.g. flex-basis:66.66{...}
// instead of 66.66%). The hash is stable per-request but any instance of the
// brace-wrapped-64-hex pattern is the leak. Restore "%" once.
add_action('init', function() {
    if (get_option('nc_pct_fix_v1_done')) return;
    global $wpdb;
    $re = '/\{[a-f0-9]{64}\}/';

    $rows = $wpdb->get_results("SELECT ID, post_content, post_excerpt, post_title FROM {$wpdb->posts} WHERE post_content LIKE '%{%}%' OR post_excerpt LIKE '%{%}%' OR post_title LIKE '%{%}%'");
    foreach ($rows as $r) {
        $upd = array();
        foreach (['post_content', 'post_excerpt', 'post_title'] as $f) {
            if (preg_match($re, $r->$f)) $upd[$f] = preg_replace($re, '%', $r->$f);
        }
        if ($upd) $wpdb->update($wpdb->posts, $upd, ['ID' => $r->ID]);
    }

    $metas = $wpdb->get_results("SELECT meta_id, meta_value FROM {$wpdb->postmeta} WHERE meta_value LIKE '%{%}%'");
    foreach ($metas as $m) {
        if (preg_match($re, $m->meta_value)) {
            $wpdb->update($wpdb->postmeta, ['meta_value' => preg_replace($re, '%', $m->meta_value)], ['meta_id' => $m->meta_id]);
        }
    }

    $opts = $wpdb->get_results("SELECT option_id, option_value FROM {$wpdb->options} WHERE option_value LIKE '%{%}%'");
    foreach ($opts as $o) {
        if (preg_match($re, $o->option_value)) {
            $wpdb->update($wpdb->options, ['option_value' => preg_replace($re, '%', $o->option_value)], ['option_id' => $o->option_id]);
        }
    }

    $termmetas = $wpdb->get_results("SELECT meta_id, meta_value FROM {$wpdb->termmeta} WHERE meta_value LIKE '%{%}%'");
    foreach ($termmetas as $m) {
        if (preg_match($re, $m->meta_value)) {
            $wpdb->update($wpdb->termmeta, ['meta_value' => preg_replace($re, '%', $m->meta_value)], ['meta_id' => $m->meta_id]);
        }
    }

    update_option('nc_pct_fix_v1_done', 1);
}, 21);


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
    $theme_version = filemtime(get_stylesheet_directory() . '/style.css');
    wp_enqueue_style('novacraft-style', get_stylesheet_uri(), array(), $theme_version);
    wp_enqueue_script('novacraft-script', get_template_directory_uri() . '/script.js', array(), $theme_version, true);
    wp_localize_script('novacraft-script', 'ncAjax', array(
        'url'   => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('nc_lead'),
    ));
    
    // product.js / catalog.js are legacy static-prototype scripts — NOT loaded on WP.
    // product.js redirected to catalog.html when window.mockProducts was missing,
    // breaking the single-furniture page. WP renders the page server-side, no JS needed.
    // Favourites — на всех страницах сайта
    $fav_ver = filemtime(get_stylesheet_directory() . '/js/fav.js');
    wp_enqueue_script('novacraft-fav', get_template_directory_uri() . '/js/fav.js', array(), $fav_ver, true);
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
        'supports' => array('title', 'editor', 'thumbnail'), // thumbnail = главное фото в каталоге
        'menu_icon' => 'dashicons-admin-home',
        'menu_position' => 26,
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
        'show_in_rest' => true,
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

    // Business Furniture CPT
    register_post_type('furniture_biz', array(
        'labels' => array(
            'name'          => 'Мебель для бизнеса',
            'singular_name' => 'Позиция',
            'add_new_item'  => 'Добавить позицию',
            'edit_item'     => 'Редактировать позицию',
            'all_items'     => 'Все позиции',
        ),
        'public'       => true,
        'has_archive'  => false,
        'show_in_rest' => false,
        'supports'     => array('title', 'thumbnail'),
        'menu_icon'    => 'dashicons-building',
        'menu_position' => 27,
    ));

    // Business Furniture Category Tax
    register_taxonomy('biz_cat', 'furniture_biz', array(
        'labels' => array(
            'name'          => 'Категории',
            'singular_name' => 'Категория',
            'add_new_item'  => 'Добавить категорию',
        ),
        'hierarchical' => true,
        'public'       => true,
        'show_admin_column' => true,
    ));
}
add_action('init', 'novacraft_register_cpt');

// Отключить Gutenberg для проектов и бизнес-мебели
add_filter('use_block_editor_for_post_type', function($use, $post_type) {
    if ($post_type === 'project' || $post_type === 'furniture_biz') return false;
    return $use;
}, 10, 2);

// ====== META BOXES: Мебель для бизнеса ======
add_action('add_meta_boxes', function() {
    add_meta_box('nc_biz_details', 'Детали позиции', 'novacraft_biz_meta_cb', 'furniture_biz', 'normal', 'high');
});

function novacraft_biz_meta_cb($post) {
    wp_nonce_field('novacraft_biz_save', 'novacraft_biz_nonce');
    $fields = array(
        'biz_price'    => array('label' => 'Цена (текст)',          'placeholder' => 'от 45 000 руб.'),
        'biz_term'     => array('label' => 'Срок изготовления',     'placeholder' => 'от 3 недель'),
        'biz_type'     => array('label' => 'Тип объекта',           'placeholder' => 'Офис'),
        'biz_material' => array('label' => 'Материал',              'placeholder' => 'ЛДСП, МДФ, шпон'),
        'biz_warranty' => array('label' => 'Гарантия',              'placeholder' => '3 года'),
    );
    echo '<table class="form-table" style="margin-top:0;">';
    foreach ($fields as $key => $f) {
        $val = get_post_meta($post->ID, $key, true);
        echo '<tr><th style="width:200px;padding:8px 10px;"><label for="' . esc_attr($key) . '">' . esc_html($f['label']) . '</label></th>';
        echo '<td style="padding:6px 10px;"><input type="text" id="' . esc_attr($key) . '" name="' . esc_attr($key) . '" value="' . esc_attr($val) . '" placeholder="' . esc_attr($f['placeholder']) . '" class="regular-text"></td></tr>';
    }
    // Image URL field
    $img_url = get_post_meta($post->ID, '_biz_img_url', true);
    $thumb_id = get_post_thumbnail_id($post->ID);
    $thumb_src = $thumb_id ? wp_get_attachment_image_url($thumb_id, 'thumbnail') : '';
    echo '<tr><th style="width:200px;padding:8px 10px;"><label for="_biz_img_url">Фото (URL)</label></th>';
    echo '<td style="padding:6px 10px;">';
    if ($thumb_src) {
        echo '<img src="' . esc_url($thumb_src) . '" style="display:block;max-width:120px;margin-bottom:6px;border-radius:4px;">';
        echo '<em style="color:#888;font-size:12px;">Используется «Изображение записи». URL ниже — запасной.</em><br><br>';
    }
    echo '<input type="text" id="_biz_img_url" name="_biz_img_url" value="' . esc_attr($img_url) . '" placeholder="https://..." class="large-text">';
    echo '<p class="description">Ссылка на фото карточки. Работает если не задано «Изображение записи» справа.</p>';
    echo '</td></tr>';
    echo '</table>';
    $desc = get_post_meta($post->ID, 'biz_desc', true);
    echo '<p style="margin-top:16px;"><strong>Описание</strong></p>';
    echo '<textarea name="biz_desc" rows="5" style="width:100%;">' . esc_textarea($desc) . '</textarea>';
}

add_action('save_post_furniture_biz', function($post_id) {
    if (!isset($_POST['novacraft_biz_nonce']) || !wp_verify_nonce($_POST['novacraft_biz_nonce'], 'novacraft_biz_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    foreach (array('biz_price', 'biz_term', 'biz_type', 'biz_material', 'biz_warranty') as $key) {
        if (isset($_POST[$key])) update_post_meta($post_id, $key, sanitize_text_field($_POST[$key]));
    }
    if (isset($_POST['biz_desc'])) update_post_meta($post_id, 'biz_desc', sanitize_textarea_field($_POST['biz_desc']));
    if (isset($_POST['_biz_img_url'])) update_post_meta($post_id, '_biz_img_url', esc_url_raw($_POST['_biz_img_url']));
});

// ====== CATEGORY IMAGE: biz_cat ======
function novacraft_biz_cat_image_field($term = null) {
    $img = $term ? get_term_meta($term->term_id, 'biz_cat_img', true) : '';
    $is_edit = ($term instanceof WP_Term);
    if ($is_edit) {
        echo '<tr class="form-field"><th scope="row"><label for="biz_cat_img">Фото категории (URL)</label></th><td>';
    } else {
        echo '<div class="form-field"><label for="biz_cat_img">Фото категории (URL)</label>';
    }
    if ($img) {
        echo '<img src="' . esc_url($img) . '" style="display:block;width:80px;height:80px;object-fit:cover;border-radius:50%;margin-bottom:8px;">';
    }
    echo '<input type="text" id="biz_cat_img" name="biz_cat_img" value="' . esc_attr($img) . '" placeholder="https://..." class="' . ($is_edit ? 'large-text' : 'regular-text') . '">';
    echo '<p class="description">Ссылка на фото для кружка-таба на странице «Мебель для бизнеса».</p>';
    if ($is_edit) {
        echo '</td></tr>';
    } else {
        echo '</div>';
    }
}
add_action('biz_cat_add_form_fields',  'novacraft_biz_cat_image_field');
add_action('biz_cat_edit_form_fields', 'novacraft_biz_cat_image_field');

function novacraft_save_biz_cat_image($term_id) {
    if (isset($_POST['biz_cat_img'])) {
        update_term_meta($term_id, 'biz_cat_img', esc_url_raw($_POST['biz_cat_img']));
    }
}
add_action('created_biz_cat', 'novacraft_save_biz_cat_image');
add_action('edited_biz_cat',  'novacraft_save_biz_cat_image');

// ====== META BOXES: Мебель для дома ======
add_action('add_meta_boxes', function() {
    add_meta_box('nc_furniture_details', 'Детали товара', 'novacraft_furniture_meta_cb', 'furniture', 'normal', 'high');
});

function novacraft_furniture_meta_cb($post) {
    wp_nonce_field('novacraft_furniture_save', 'novacraft_furniture_nonce');

    // ── Текстовые поля ───────────────────────────────────────────────
    $fields = array(
        'f_price'    => array('label' => 'Цена (текст)',       'placeholder' => 'от 45 000 руб.'),
        'f_material' => array('label' => 'Материал',           'placeholder' => 'ЛДСП, МДФ, шпон'),
        'f_dims'     => array('label' => 'Размеры',            'placeholder' => '2400×600×2200 мм'),
        'f_color'    => array('label' => 'Цвет / Покрытие',   'placeholder' => 'Белый матовый'),
        'f_term'     => array('label' => 'Срок изготовления',  'placeholder' => 'от 3 недель'),
    );
    echo '<table class="form-table" style="margin-top:0;">';
    foreach ($fields as $key => $f) {
        $val = get_post_meta($post->ID, $key, true);
        echo '<tr><th style="width:200px;padding:8px 10px;"><label for="' . esc_attr($key) . '">' . esc_html($f['label']) . '</label></th>';
        echo '<td style="padding:6px 10px;"><input type="text" id="' . esc_attr($key) . '" name="' . esc_attr($key) . '" value="' . esc_attr($val) . '" placeholder="' . esc_attr($f['placeholder']) . '" class="regular-text"></td></tr>';
    }
    echo '</table>';

    // ── Галерея (динамическая) ───────────────────────────────────────
    // Загружаем из f_gallery_json; первый элемент = главное фото
    $gallery_json = get_post_meta($post->ID, 'f_gallery_json', true);
    $gallery_imgs = ($gallery_json) ? json_decode($gallery_json, true) : array();
    // Если JSON пуст — попробуем старое поле f_img_url
    if (empty($gallery_imgs)) {
        $old = get_post_meta($post->ID, 'f_img_url', true);
        if ($old) $gallery_imgs = array($old);
    }
    if (empty($gallery_imgs)) $gallery_imgs = array(''); // хотя бы одно пустое поле

    echo '<hr style="margin:16px 0 12px;">';
    echo '<p style="font-weight:600;margin:0 0 4px;">Галерея на странице товара</p>';
    echo '<p style="color:#777;font-size:12px;margin:0 0 14px;">Дополнительные фото для слайдера на странице товара. Главное фото каталога — задаётся через «Изображение записи» справа.</p>';
    echo '<div id="nc-gallery-list" style="display:flex;flex-wrap:wrap;gap:16px;align-items:flex-start;">';

    foreach ($gallery_imgs as $i => $url) {
        $url = esc_url($url);
        $label = ($i === 0) ? 'Главное фото' : 'Фото ' . ($i + 1);
        echo novacraft_gallery_item_html($i, $url, $label);
    }

    echo '</div>';
    echo '<button type="button" id="nc-add-photo" class="button" style="margin-top:14px;">+ Добавить фото</button>';

    // JS
    ?>
    <script>
    jQuery(function($){
        var counter = <?php echo count($gallery_imgs); ?>;

        // Функция рендера одного слота
        function makeSlot(idx, url, label) {
            url   = url   || '';
            label = label || ('Фото ' + (idx + 1));
            var id  = 'nc_gi_' + idx;
            var pid = 'nc_gp_' + idx;
            return '<div class="nc-gallery-slot" style="width:180px;" data-idx="'+idx+'">'
                + '<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px;">'
                +   '<span style="font-size:12px;font-weight:600;">'+label+'</span>'
                +   (idx > 0 ? '<button type="button" class="nc-remove-slot" style="background:none;border:none;cursor:pointer;color:#999;font-size:16px;line-height:1;padding:0;" title="Удалить">&times;</button>' : '')
                + '</div>'
                + '<img id="'+pid+'" src="'+url+'" style="'+(url?'':'display:none;')+'width:180px;height:126px;object-fit:cover;border-radius:6px;border:1px solid #ddd;margin-bottom:6px;display:block;">'
                + '<input type="text" id="'+id+'" name="nc_gallery[]" value="'+url+'" placeholder="https://..." class="widefat nc-gallery-url" data-preview="'+pid+'" style="margin-bottom:6px;font-size:12px;">'
                + '<button type="button" class="button button-small nc-media-btn" data-target="'+id+'" data-preview="'+pid+'">Медиатека</button>'
                + '</div>';
        }

        // Обновить лейбл первого слота при любом изменении
        function refreshLabels() {
            $('#nc-gallery-list .nc-gallery-slot').each(function(i){
                var lbl = (i === 0) ? 'Главное фото' : 'Фото ' + (i + 1);
                $(this).find('span:first').text(lbl);
                $(this).attr('data-idx', i);
            });
        }

        // Добавить фото
        $('#nc-add-photo').on('click', function(){
            var idx = $('#nc-gallery-list .nc-gallery-slot').length;
            $('#nc-gallery-list').append(makeSlot(idx, '', 'Фото ' + (idx + 1)));
            counter++;
        });

        // Удалить слот
        $(document).on('click', '.nc-remove-slot', function(){
            $(this).closest('.nc-gallery-slot').remove();
            refreshLabels();
        });

        // Превью при вводе URL
        $(document).on('input', '.nc-gallery-url', function(){
            var url = $(this).val();
            var pid = $(this).data('preview');
            if (url) { $('#'+pid).attr('src', url).show(); }
            else     { $('#'+pid).hide(); }
        });

        // Медиатека
        $(document).on('click', '.nc-media-btn', function(e){
            e.preventDefault();
            var $btn = $(this);
            var frame = wp.media({ title: 'Выберите фото', button: { text: 'Использовать' }, multiple: false });
            frame.on('select', function(){
                var url = frame.state().get('selection').first().toJSON().url;
                $('#' + $btn.data('target')).val(url).trigger('input');
            });
            frame.open();
        });
    });
    </script>
    <?php
}

// Генерирует HTML одного слота галереи (PHP-сторона, при первой загрузке)
function novacraft_gallery_item_html($idx, $url, $label) {
    $id  = 'nc_gi_' . $idx;
    $pid = 'nc_gp_' . $idx;
    $url_esc = esc_url($url);
    $remove_btn = $idx > 0
        ? '<button type="button" class="nc-remove-slot" style="background:none;border:none;cursor:pointer;color:#999;font-size:16px;line-height:1;padding:0;" title="Удалить">&times;</button>'
        : '';
    $preview_style = $url ? 'display:block;' : 'display:none;';
    return '<div class="nc-gallery-slot" style="width:180px;" data-idx="' . $idx . '">'
        . '<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px;">'
        .   '<span style="font-size:12px;font-weight:600;">' . esc_html($label) . '</span>'
        .   $remove_btn
        . '</div>'
        . '<img id="' . $id . '_prev" src="' . $url_esc . '" style="' . $preview_style . 'width:180px;height:126px;object-fit:cover;border-radius:6px;border:1px solid #ddd;margin-bottom:6px;">'
        . '<input type="text" id="' . $id . '" name="nc_gallery[]" value="' . $url_esc . '" placeholder="https://..." class="widefat nc-gallery-url" data-preview="' . $id . '_prev" style="margin-bottom:6px;font-size:12px;">'
        . '<button type="button" class="button button-small nc-media-btn" data-target="' . $id . '" data-preview="' . $id . '_prev">Медиатека</button>'
        . '</div>';
}

add_action('save_post_furniture', function($post_id) {
    if (!isset($_POST['novacraft_furniture_nonce']) || !wp_verify_nonce($_POST['novacraft_furniture_nonce'], 'novacraft_furniture_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    foreach (array('f_price', 'f_material', 'f_dims', 'f_color', 'f_term') as $key) {
        if (isset($_POST[$key])) update_post_meta($post_id, $key, sanitize_text_field($_POST[$key]));
    }

    // Галерея: собираем nc_gallery[], фильтруем пустые
    $imgs = array();
    if (!empty($_POST['nc_gallery']) && is_array($_POST['nc_gallery'])) {
        foreach ($_POST['nc_gallery'] as $url) {
            $url = esc_url_raw(trim($url));
            if ($url) $imgs[] = $url;
        }
    }
    update_post_meta($post_id, 'f_gallery_json', json_encode($imgs));
});

// ====== CATEGORY IMAGE: furniture_cat ======
function novacraft_furniture_cat_image_field($term = null) {
    $img     = $term ? get_term_meta($term->term_id, 'furniture_cat_img', true) : '';
    $is_edit = ($term instanceof WP_Term);
    if ($is_edit) {
        echo '<tr class="form-field"><th scope="row"><label for="furniture_cat_img">Фото категории (URL)</label></th><td>';
    } else {
        echo '<div class="form-field"><label for="furniture_cat_img">Фото категории (URL)</label>';
    }
    if ($img) {
        echo '<img src="' . esc_url($img) . '" style="display:block;width:80px;height:80px;object-fit:cover;border-radius:50%;margin-bottom:8px;">';
    }
    echo '<input type="text" id="furniture_cat_img" name="furniture_cat_img" value="' . esc_attr($img) . '" placeholder="https://..." class="' . ($is_edit ? 'large-text' : 'regular-text') . '">';
    echo '<p class="description">Ссылка на фото для кружка-таба на странице «Мебель для дома».</p>';
    if ($is_edit) { echo '</td></tr>'; } else { echo '</div>'; }
}
add_action('furniture_cat_add_form_fields',  'novacraft_furniture_cat_image_field');
add_action('furniture_cat_edit_form_fields', 'novacraft_furniture_cat_image_field');

function novacraft_save_furniture_cat_image($term_id) {
    if (isset($_POST['furniture_cat_img'])) {
        update_term_meta($term_id, 'furniture_cat_img', esc_url_raw($_POST['furniture_cat_img']));
    }
}
add_action('created_furniture_cat', 'novacraft_save_furniture_cat_image');
add_action('edited_furniture_cat',  'novacraft_save_furniture_cat_image');

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
        'address_nn'   => 'г. Нижний Новгород, ул. Маршала Воронова,&nbsp;11',
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

// ====== FRONT-PAGE CONTENT REPAIR ======
// The home page post_content was wiped of <svg>, <input>, <select>, <form>
// tags by a prior wp_kses pass (capability regression during migration).
// Re-inject icons into empty wrappers and rebuild the broken contact form
// on render, without touching the DB — leaves editable text intact.
function nc_fix_front_page_content($content) {
    if (!is_front_page()) return $content;

    // Icons used by the "How we work" steps (5 items, by order).
    $hww_icons = array(
        // 01 - заявка / звонок
        '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>',
        // 02 - замер / линейка
        '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M21.3 15.3L8.7 2.7a1 1 0 0 0-1.4 0l-4.6 4.6a1 1 0 0 0 0 1.4l12.6 12.6a1 1 0 0 0 1.4 0l4.6-4.6a1 1 0 0 0 0-1.4z"/><path d="M7 7l2 2"/><path d="M10 10l2 2"/><path d="M13 13l2 2"/><path d="M16 16l2 2"/></svg>',
        // 03 - договор / документ
        '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="8" y1="13" x2="16" y2="13"/><line x1="8" y1="17" x2="14" y2="17"/></svg>',
        // 04 - производство / инструмент
        '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>',
        // 05 - доставка / грузовик
        '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>',
    );

    // Fill empty .hww__icon-wrap divs in order.
    $i = 0;
    $content = preg_replace_callback(
        '#(<div class="hww__icon-wrap">)\s*(</div>)#u',
        function($m) use ($hww_icons, &$i) {
            $icon = isset($hww_icons[$i]) ? $hww_icons[$i] : $hww_icons[0];
            $i++;
            return $m[1] . $icon . $m[2];
        },
        $content
    );

    // About features — prepend a checkmark icon (4 items, same SVG).
    $check = '<svg class="about__feature-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>';
    $content = preg_replace(
        '#(<div class="about__feature">)\s*#u',
        '$1' . $check . ' ',
        $content
    );

    // Contact cards — match by link/class context.
    $phone_svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="22" height="22"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>';
    $tg_svg    = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="22" height="22"><path d="M22 2L11 13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>';
    $pin_svg   = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="22" height="22"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>';

    $content = preg_replace(
        '#(<a[^>]*href="tel:[^"]*"[^>]*>\s*<div class="contact__card-icon">)\s*(</div>)#u',
        '$1' . $phone_svg . '$2',
        $content
    );
    $content = preg_replace(
        '#(<a[^>]*href="https?://t\.me/[^"]*"[^>]*>\s*<div class="contact__card-icon">)\s*(</div>)#u',
        '$1' . $tg_svg . '$2',
        $content
    );
    $content = preg_replace(
        '#(<div class="contact__card contact__card--addr">\s*<div class="contact__card-icon">)\s*(</div>)#u',
        '$1' . $pin_svg . '$2',
        $content
    );

    // Hero-banner benefits (3 items, by label text).
    $bench_map = array(
        'Гарантия' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>',
        'Сроки'    => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
        'Точно'    => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3h18v4H3zM3 11h18v4H3zM3 19h12v2H3z"/></svg>',
    );
    $content = preg_replace_callback(
        '#(<div class="hero-banner__benefit-icon">)\s*(</div>)\s*(<div class="hero-banner__benefit-text">\s*<strong>)([^<]+)(</strong>)#us',
        function($m) use ($bench_map) {
            $svg = '';
            foreach ($bench_map as $k => $v) { if (mb_stripos($m[4], $k) !== false) { $svg = $v; break; } }
            return $m[1] . $svg . $m[2] . $m[3] . $m[4] . $m[5];
        },
        $content
    );

    // Advantage cards (4 items, by title text).
    $adv_map = array(
        'Собственное' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M2 20V9l6-4 6 4v11"/><path d="M14 20V12l6-3v11"/><path d="M2 20h20"/><path d="M6 20v-5"/><path d="M10 20v-5"/><path d="M17 20v-4"/></svg>',
        'Выезд'       => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M21.3 15.3L8.7 2.7a1 1 0 0 0-1.4 0l-4.6 4.6a1 1 0 0 0 0 1.4l12.6 12.6a1 1 0 0 0 1.4 0l4.6-4.6a1 1 0 0 0 0-1.4z"/><path d="M7 7l2 2"/><path d="M10 10l2 2"/><path d="M13 13l2 2"/><path d="M16 16l2 2"/></svg>',
        'Сроки'       => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
        'Гарантия'    => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>',
    );
    $content = preg_replace_callback(
        '#(<div class="advantage-card__icon"[^>]*>)\s*(</div>)\s*(<div>\s*<div class="advantage-card__title">)([^<]+)(</div>)#us',
        function($m) use ($adv_map) {
            $svg = '';
            foreach ($adv_map as $k => $v) { if (mb_stripos($m[4], $k) !== false) { $svg = $v; break; } }
            return $m[1] . $svg . $m[2] . $m[3] . $m[4] . $m[5];
        },
        $content
    );

    // Category icon row (9 items, by label).
    $cat_map = array(
        'Кухни'       => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M3 2v7a3 3 0 0 0 3 3h0a3 3 0 0 0 3-3V2"/><path d="M6 12v10"/><path d="M18 2c-2 0-3 2-3 5s1 5 3 5v10"/></svg>',
        'Шкафы'       => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="2" width="16" height="20" rx="1"/><line x1="12" y1="2" x2="12" y2="22"/><circle cx="10" cy="12" r="0.5" fill="currentColor"/><circle cx="14" cy="12" r="0.5" fill="currentColor"/></svg>',
        'Гардеробные' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3a2 2 0 1 0 2 2"/><path d="M12 5v4"/><path d="M3 21l9-12 9 12z"/></svg>',
        'Кровати'     => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M2 10V7a1 1 0 0 1 1-1h7v4"/><path d="M2 12h20v6"/><path d="M22 12v-2a2 2 0 0 0-2-2h-10"/><path d="M2 18v3"/><path d="M22 18v3"/></svg>',
        'Комоды'      => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="1"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="3" y1="15" x2="21" y2="15"/><circle cx="10" cy="6" r="0.5" fill="currentColor"/><circle cx="14" cy="6" r="0.5" fill="currentColor"/><circle cx="10" cy="12" r="0.5" fill="currentColor"/><circle cx="14" cy="12" r="0.5" fill="currentColor"/><circle cx="10" cy="18" r="0.5" fill="currentColor"/><circle cx="14" cy="18" r="0.5" fill="currentColor"/></svg>',
        'Обувницы'    => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M4 17c0-2 2-3 5-3s3-3 6-3 5 2 5 5v2H4z"/><path d="M4 19h16"/></svg>',
        'Тумбы'       => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="7" width="18" height="12" rx="1"/><line x1="3" y1="13" x2="21" y2="13"/><line x1="7" y1="19" x2="7" y2="21"/><line x1="17" y1="19" x2="17" y2="21"/></svg>',
        'Стеллажи'    => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="0.5"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="3" y1="15" x2="21" y2="15"/></svg>',
        'Столы'       => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><line x1="2" y1="9" x2="22" y2="9"/><line x1="5" y1="9" x2="5" y2="20"/><line x1="19" y1="9" x2="19" y2="20"/></svg>',
    );
    $content = preg_replace_callback(
        '#(<div class="cat-icon-item__icon">)\s*(</div>)\s*(<span>)([^<]+)(</span>)#us',
        function($m) use ($cat_map) {
            $label = trim($m[4]);
            $svg = isset($cat_map[$label]) ? $cat_map[$label] : '';
            return $m[1] . $svg . $m[2] . $m[3] . $m[4] . $m[5];
        },
        $content
    );

    // Hours — prepend clock icon if wrapper present without svg.
    $clock_svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="14" height="14"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>';
    $content = preg_replace(
        '#(<div class="contact__hours">)(\s*[^<])#u',
        '$1' . $clock_svg . ' $2',
        $content
    );

    // Rebuild the contact form if its inputs were stripped.
    if (strpos($content, 'contact__form-wrapper') !== false &&
        (strpos($content, 'id="contactName"') === false || strpos($content, '<select') === false)) {
        $form_html = '<form id="contactForm" onsubmit="handleSubmit(event)">'
            . '<div class="form-row">'
            . '<div class="form-group"><label for="contactName">Имя *</label><input type="text" id="contactName" name="name" placeholder="Антон" required></div>'
            . '<div class="form-group"><label for="contactPhone">Телефон *</label><input type="tel" id="contactPhone" name="phone" placeholder="+7 (___) ___-__-__" required></div>'
            . '</div>'
            . '<div class="form-group"><label for="contactService">Что вас интересует?</label>'
            . '<select id="contactService" name="service">'
            . '<option value="">Выберите услугу</option>'
            . '<option value="kitchen">Кухня на заказ</option>'
            . '<option value="wardrobe">Шкаф / Шкаф-купе</option>'
            . '<option value="closet">Гардеробная</option>'
            . '<option value="storage">Системы хранения</option>'
            . '<option value="tvunit">Стенка под телевизор</option>'
            . '<option value="other">Другое</option>'
            . '</select></div>'
            . '<div class="form-group"><label for="contactMessage">Комментарий</label>'
            . '<textarea id="contactMessage" name="message" placeholder="Опишите ваш проект — размеры, материалы, пожелания..."></textarea></div>'
            . '<div class="form-consent"><input type="checkbox" id="contactConsent" required>'
            . '<label for="contactConsent">Нажимая кнопку, вы соглашаетесь на обработку персональных данных</label></div>'
            . '<button type="submit" class="btn btn--primary btn--lg" style="width:100%;margin-top:var(--space-md)">Отправить заявку</button>'
            . '</form>';
        $content = preg_replace(
            '#(<div class="contact__form-wrapper">\s*<h3 class="contact__form-title">[^<]*</h3>\s*<p class="contact__form-subtitle">[^<]*</p>)(.*?)(</div>\s*</div>\s*</div>\s*</div>\s*</div>\s*</div>)#us',
            '$1' . $form_html . '$3',
            $content,
            1
        );
    }

    return $content;
}
// Filter disabled — front-page.php now renders sections directly.
// add_filter('the_content', 'nc_fix_front_page_content', 20);

// Whitelist svg/form/input/select tags for future post saves so Gutenberg
// doesn't strip them again. Applies to logged-in editors only.
add_filter('wp_kses_allowed_html', function($tags, $context) {
    if ($context !== 'post') return $tags;
    $extra = array(
        'svg'      => array('xmlns' => true, 'viewbox' => true, 'width' => true, 'height' => true, 'fill' => true, 'stroke' => true, 'stroke-width' => true, 'stroke-linecap' => true, 'stroke-linejoin' => true, 'class' => true, 'aria-hidden' => true),
        'path'     => array('d' => true, 'fill' => true, 'stroke' => true, 'stroke-width' => true, 'stroke-linecap' => true, 'stroke-linejoin' => true),
        'circle'   => array('cx' => true, 'cy' => true, 'r' => true, 'fill' => true, 'stroke' => true),
        'rect'     => array('x' => true, 'y' => true, 'width' => true, 'height' => true, 'rx' => true, 'ry' => true, 'fill' => true, 'stroke' => true),
        'line'     => array('x1' => true, 'y1' => true, 'x2' => true, 'y2' => true, 'stroke' => true),
        'polyline' => array('points' => true, 'fill' => true, 'stroke' => true),
        'polygon'  => array('points' => true, 'fill' => true, 'stroke' => true),
        'g'        => array('fill' => true, 'stroke' => true, 'transform' => true),
        'form'     => array('id' => true, 'class' => true, 'action' => true, 'method' => true, 'onsubmit' => true),
        'input'    => array('type' => true, 'id' => true, 'name' => true, 'value' => true, 'placeholder' => true, 'required' => true, 'class' => true, 'checked' => true),
        'select'   => array('id' => true, 'name' => true, 'class' => true, 'required' => true),
        'option'   => array('value' => true, 'selected' => true),
        'textarea' => array('id' => true, 'name' => true, 'placeholder' => true, 'required' => true, 'class' => true, 'rows' => true, 'cols' => true),
        'button'   => array('type' => true, 'class' => true, 'id' => true, 'onclick' => true, 'style' => true),
        'label'    => array('for' => true, 'class' => true),
    );
    return array_merge($tags, $extra);
}, 10, 2);


// ====== LEAD FORM AJAX HANDLER ======
function nc_submit_lead() {
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'nc_lead')) {
        wp_send_json_error(['msg' => 'Ошибка безопасности, перезагрузите страницу.'], 403);
    }
    // Honeypot — real users leave it empty.
    if (!empty($_POST['website'])) {
        wp_send_json_success(['msg' => 'ok']);
    }
    // Rate-limit: 1 submission / 20s per IP.
    $ip = isset($_SERVER['REMOTE_ADDR']) ? preg_replace('/[^0-9a-f\.:]/i', '', $_SERVER['REMOTE_ADDR']) : 'unknown';
    $rl_key = 'nc_lead_rl_' . md5($ip);
    if (get_transient($rl_key)) {
        wp_send_json_error(['msg' => 'Слишком часто. Подождите немного.'], 429);
    }
    set_transient($rl_key, 1, 20);

    $name    = sanitize_text_field(wp_unslash($_POST['name'] ?? ''));
    $phone   = sanitize_text_field(wp_unslash($_POST['phone'] ?? ''));
    $service = sanitize_text_field(wp_unslash($_POST['service'] ?? ''));
    $message = sanitize_textarea_field(wp_unslash($_POST['message'] ?? ''));
    $source  = sanitize_text_field(wp_unslash($_POST['source'] ?? 'site'));
    $page    = esc_url_raw(wp_unslash($_POST['page_url'] ?? ''));

    if (!$name || !$phone) {
        wp_send_json_error(['msg' => 'Заполните имя и телефон.'], 400);
    }

    $to = get_option('nc_lead_email');
    if (!$to || !is_email($to)) $to = 'zakaz@novacraft-mebel.ru';

    $site = parse_url(home_url(), PHP_URL_HOST);
    $subject = 'Заявка с сайта: ' . $name . ' (' . $source . ')';
    $body  = "Новая заявка с сайта novacraft-mebel.ru\n\n";
    $body .= "Имя: {$name}\n";
    $body .= "Телефон: {$phone}\n";
    if ($service) $body .= "Услуга: {$service}\n";
    if ($message) $body .= "Комментарий: {$message}\n";
    $body .= "\nИсточник формы: {$source}\n";
    if ($page) $body .= "Страница: {$page}\n";
    $body .= "IP: {$ip}\n";
    $body .= "Время: " . current_time('Y-m-d H:i:s') . "\n";

    $headers = array(
        'From: Novacraft <noreply@' . $site . '>',
        'Reply-To: ' . $name . ' <noreply@' . $site . '>',
        'Content-Type: text/plain; charset=UTF-8',
    );

    $mailed = wp_mail($to, $subject, $body, $headers);

    // Telegram (optional — send if configured).
    $tg_token = trim((string) get_option('nc_tg_bot_token'));
    $tg_chat  = trim((string) get_option('nc_tg_chat_id'));
    if ($tg_token && $tg_chat) {
        $tg_text = "🔔 *Заявка с сайта*\n\n"
            . "*Имя:* " . $name . "\n"
            . "*Телефон:* " . $phone . "\n"
            . ($service ? "*Услуга:* " . $service . "\n" : '')
            . ($message ? "*Комментарий:* " . $message . "\n" : '')
            . "\n_Источник:_ " . $source
            . ($page ? "\n" . $page : '');
        wp_remote_post('https://api.telegram.org/bot' . $tg_token . '/sendMessage', array(
            'timeout' => 8,
            'body'    => array(
                'chat_id'    => $tg_chat,
                'text'       => $tg_text,
                'parse_mode' => 'Markdown',
            ),
        ));
    }

    // Log a lightweight audit entry.
    $log = get_option('nc_lead_log', array());
    if (!is_array($log)) $log = array();
    array_unshift($log, array(
        'time' => current_time('mysql'),
        'name' => $name, 'phone' => $phone, 'service' => $service,
        'source' => $source, 'mailed' => (bool) $mailed,
    ));
    if (count($log) > 50) $log = array_slice($log, 0, 50);
    update_option('nc_lead_log', $log, false);

    if (!$mailed) {
        wp_send_json_error(['msg' => 'Не удалось отправить письмо. Свяжитесь по телефону.'], 500);
    }
    wp_send_json_success(['msg' => 'Заявка принята']);
}
add_action('wp_ajax_nc_submit_lead', 'nc_submit_lead');
add_action('wp_ajax_nopriv_nc_submit_lead', 'nc_submit_lead');


// ====== NATIVE THEME OPTIONS PAGE ======
function nc_add_theme_menu_item() {
    add_menu_page('Настройки сайта', 'Настройки сайта', 'manage_options', 'nc-theme-options', 'nc_theme_settings_page', 'dashicons-admin-generic', 99);
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
        'map_url_nn' => 'Ссылка виджета карты (НН)',
        'lead_email' => 'Email для заявок (по умолчанию zakaz@novacraft-mebel.ru)',
        'tg_bot_token' => 'Telegram Bot Token (от @BotFather)',
        'tg_chat_id' => 'Telegram Chat ID (куда слать заявки)'
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

// ====== SHORTCODE: последние 4 проекта для главной ======
// Использование: [nc_latest_projects]
add_shortcode('nc_latest_projects', function() {
    $projects = get_posts(array(
        'post_type'      => 'project',
        'posts_per_page' => 4,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    ));

    $archive_url = get_post_type_archive_link('project');
    if ( ! $archive_url ) {
        $proj_page = get_page_by_path('projects');
        $archive_url = $proj_page ? get_permalink($proj_page->ID) : home_url('/projects/');
    }

    ob_start(); ?>
<section class="home-projects-section">
  <div class="container">
    <div class="home-projects__head">
      <h2 class="home-projects__title">Реализованные проекты</h2>
      <a href="<?php echo esc_url($archive_url); ?>" class="home-projects__all">Все проекты →</a>
    </div>
    <div class="home-projects__grid">
    <?php if ( $projects ) :
        foreach ( $projects as $p ) :
            $location = get_post_meta($p->ID, 'p_location', true) ?: '';
            $mat      = get_post_meta($p->ID, 'p_material', true) ?: '';
            $duration = get_post_meta($p->ID, 'p_duration', true) ?: '';
            $cats     = get_the_terms($p->ID, 'project_cat');
            $cat_name = ($cats && !is_wp_error($cats)) ? $cats[0]->name : '';
            $img      = get_the_post_thumbnail_url($p->ID, 'large');
            if (!$img) $img = get_template_directory_uri() . '/img/kitchen_wood_autumn.jpg';
    ?>
      <a class="proj-card" href="<?php echo esc_url(get_permalink($p->ID)); ?>">
        <div class="proj-card__image">
          <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr(get_the_title($p->ID)); ?>" loading="lazy">
          <?php if ($cat_name) : ?><span class="proj-card__tag"><?php echo esc_html($cat_name); ?></span><?php endif; ?>
        </div>
        <div class="proj-card__body">
          <h3 class="proj-card__title"><?php echo esc_html(get_the_title($p->ID)); ?></h3>
          <div class="proj-card__meta">
            <?php if ($location) : ?><span class="proj-card__meta-item"><?php echo esc_html($location); ?></span><?php endif; ?>
            <?php if ($mat) : ?><span class="proj-card__meta-sep"></span><span class="proj-card__meta-item"><?php echo esc_html($mat); ?></span><?php endif; ?>
            <?php if ($duration) : ?><span class="proj-card__meta-sep"></span><span class="proj-card__meta-item"><?php echo esc_html($duration); ?></span><?php endif; ?>
          </div>
        </div>
      </a>
    <?php endforeach; wp_reset_postdata();
    else : ?>
      <p style="color:var(--color-text-muted);grid-column:1/-1;">Проекты скоро появятся.</p>
    <?php endif; ?>
    </div>
  </div>
</section>
    <?php return ob_get_clean();
});

// ====== META BOXES: Проекты ======

add_action('add_meta_boxes', 'novacraft_project_add_meta_boxes');
function novacraft_project_add_meta_boxes() {
    add_meta_box('nc_project_details', 'Детали проекта', 'novacraft_project_meta_cb', 'project', 'normal', 'high');
}

function novacraft_project_meta_cb($post) {
    wp_nonce_field('novacraft_project_save', 'novacraft_project_nonce');
    $fields = array(
        'p_area'        => array('label' => 'Площадь (м²)',           'placeholder' => '22'),
        'p_material'    => array('label' => 'Материал',               'placeholder' => 'ЛДСП Egger + МДФ шпон ясеня'),
        'p_date'        => array('label' => 'Дата (для сортировки)',   'placeholder' => '20260201'),
        'p_date_text'   => array('label' => 'Дата (текст)',            'placeholder' => 'февраль 2026'),
        'p_location'    => array('label' => 'Город',                  'placeholder' => 'Нижний Новгород'),
        'p_duration'    => array('label' => 'Срок производства',      'placeholder' => '28 рабочих дней'),
        'p_style'       => array('label' => 'Стиль',                  'placeholder' => 'Скандинавский / эко'),
        'p_items_count' => array('label' => 'Количество изделий',     'placeholder' => '14 единиц мебели'),
    );
    echo '<table class="form-table" style="margin-top:0;">';
    foreach ($fields as $key => $f) {
        $val = get_post_meta($post->ID, $key, true);
        echo '<tr><th style="width:200px;padding:8px 10px;"><label for="' . esc_attr($key) . '">' . esc_html($f['label']) . '</label></th>';
        echo '<td style="padding:6px 10px;"><input type="text" id="' . esc_attr($key) . '" name="' . esc_attr($key) . '" value="' . esc_attr($val) . '" placeholder="' . esc_attr($f['placeholder']) . '" class="regular-text"></td></tr>';
    }
    echo '</table>';

    // Задача
    $task = get_post_meta($post->ID, 'p_task', true);
    echo '<p style="margin-top:20px;"><strong>Задача</strong> <span style="color:#888;font-weight:normal;">— текст и HTML. Для вставки фото: загрузите через «Медиафайлы» и скопируйте URL изображения, затем вставьте тег &lt;img src="URL"&gt; в текст</span></p>';
    echo '<textarea name="p_task" rows="8" style="width:100%;font-family:monospace;">' . esc_textarea($task) . '</textarea>';

    // Решение
    $solution = get_post_meta($post->ID, 'p_solution', true);
    echo '<p style="margin-top:16px;"><strong>Решение</strong> <span style="color:#888;font-weight:normal;">— текст и HTML.</span></p>';
    echo '<textarea name="p_solution" rows="8" style="width:100%;font-family:monospace;">' . esc_textarea($solution) . '</textarea>';
}

add_action('save_post_project', 'novacraft_project_save_meta');
function novacraft_project_save_meta($post_id) {
    if (!isset($_POST['novacraft_project_nonce']) || !wp_verify_nonce($_POST['novacraft_project_nonce'], 'novacraft_project_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $fields = array('p_area', 'p_material', 'p_date', 'p_date_text', 'p_location', 'p_duration', 'p_style', 'p_items_count');
    foreach ($fields as $key) {
        if (isset($_POST[$key])) {
            update_post_meta($post_id, $key, sanitize_text_field($_POST[$key]));
        }
    }
    if (isset($_POST['p_task'])) {
        update_post_meta($post_id, 'p_task', wp_kses_post($_POST['p_task']));
    }
    if (isset($_POST['p_solution'])) {
        update_post_meta($post_id, 'p_solution', wp_kses_post($_POST['p_solution']));
    }
    if (isset($_POST['p_gallery_ids'])) {
        update_post_meta($post_id, 'p_gallery_ids', sanitize_text_field($_POST['p_gallery_ids']));
    }
}

// ====== ДЕФОЛТНЫЕ ДАННЫЕ: О производстве ======
function novacraft_about_defaults() {
    $tpl = get_template_directory_uri();
    return array(
        'prod_image' => $tpl . '/img/production_hq.png',
        'prod_label' => 'Сегодня',
        'prod_title' => 'Своё производство — наш главный актив',
        'prod_text'  => '<p>Наш цех занимает более <strong>600 м²</strong> и оснащён современным форматно-раскроечным, кромкооблицовочным и присадочным оборудованием. Здесь работает слаженная команда мастеров — каждый знает своё дело до мелочей.</p><p>Мы не перекупаем готовую мебель и не отдаём заказы на субподряд. Весь цикл — от замера и проекта до производства и монтажа — проходит под одной крышей. Это даёт нам полный контроль качества и позволяет выдерживать точные сроки.</p>',
        'prod_facts' => array(
            array('v' => '600 м²',      'l' => 'производственная площадь'),
            array('v' => '30+ лет',     'l' => 'работаем на рынке'),
            array('v' => '5 000+',      'l' => 'выполненных заказов'),
            array('v' => '3 поколения', 'l' => 'мастеров в команде'),
        ),
        'tl_intro_title' => 'А вот как всё начиналось...',
        'tl_intro_text'  => 'С 1996 года — три десятилетия роста, кризисов, экспериментов и тысяч реализованных проектов. Листайте вниз, чтобы пройти этот путь вместе с нами.',
        'timeline' => array(
            array('year' => '1996', 'title' => 'Первые самостоятельные шаги',       'text' => 'Начало пути. Первые заказы на изготовление торгового оборудования для банков и магазинов Нижнего Новгорода. Небольшая мастерская, большие амбиции и огромное желание делать качественно.',         'image' => $tpl . '/img/about/about-1996.jpg'),
            array('year' => '1997', 'title' => 'Мы пойдем другим путем!',            'text' => 'Компания меняет стратегию и делает ставку на нестандартные решения. Первые эксперименты с дизайном витрин и нестандартными конструкциями для универсамов.',                                        'image' => $tpl . '/img/about/about-1997.jpg'),
            array('year' => '1998', 'title' => 'Юрченский милан',                    'text' => 'Выход на новый уровень — крупные проекты для торговых центров. Знакомство с итальянскими стандартами качества и дизайна меняет подход к работе навсегда.',                                           'image' => $tpl . '/img/about/about-1998.jpg'),
            array('year' => '1999', 'title' => 'Полосатый рейс за экономпанелями',   'text' => 'Кризис 1998 года закалил команду. Освоение новых материалов — экономпанелей. Первые постоянные клиенты, которые работают с нами до сих пор.',                                                       'image' => $tpl . '/img/about/about-1999.jpg'),
            array('year' => '2000', 'title' => 'Кодекс чести мебельщика',            'text' => 'Формируется кодекс качества компании: ни одно изделие не покидает цех без проверки. Открытие второго направления — мебель для жилых помещений.',                                                    'image' => $tpl . '/img/about/about-2000.jpg'),
            array('year' => '2001', 'title' => 'Heavy metal forever!',               'text' => 'Масштабный проект для ТЦ «Сормовские зори». Первый опыт работы с металлоконструкциями и нестандартными фасадными решениями.',                                                                        'image' => $tpl . '/img/about/about-2001.jpg'),
            array('year' => '2002', 'title' => 'Думай глобально, действуй локально', 'text' => 'Принцип «думай глобально» воплощается в жизнь — первые заказы из других регионов. Расширение производственных площадей, новое оборудование.',                                                       'image' => $tpl . '/img/about/about-2002.jpg'),
            array('year' => '2003', 'title' => 'Луч света в темном царстве',         'text' => 'Сложный проект подсветки и витрин для ТЦ «Этажи». Освоение технологий подсветки и световых коробов — новая компетенция для команды.',                                                               'image' => $tpl . '/img/about/about-2003.jpg'),
            array('year' => '2004', 'title' => 'Импровизации в стиле фьюжн',         'text' => 'Первые проекты детской мебели. Работа с магазином «Мама+Я» открывает целое направление — мебель для семей с детьми.',                                                                               'image' => $tpl . '/img/about/about-2004.jpg'),
            array('year' => '2005', 'title' => 'Подходи, не скупись: покупай Neofix','text' => 'Партнёрство с федеральной сетью. Поставки торгового оборудования в несколько городов одновременно — серьёзный логистический вызов.',                                                                'image' => $tpl . '/img/about/about-2005.jpg'),
            array('year' => '2006', 'title' => 'Город Солнца',                       'text' => 'Крупный проект для Дзержинского ЦУМ. Полная отделка торгового зала — от прилавков до стеллажей. Команда выросла до 20 человек.',                                                                    'image' => $tpl . '/img/about/about-2006.jpg'),
            array('year' => '2007', 'title' => 'Чем пахнет ваш магазин?',            'text' => 'Развитие фирменного стиля и брендирования. Первые работы по оформлению корпоративных пространств и офисов.',                                                                                        'image' => $tpl . '/img/about/about-2007.jpg'),
            array('year' => '2008', 'title' => 'Такого кризиса еще не видел свет...','text' => 'Мировой финансовый кризис. Компания устояла за счёт диверсификации — жилая мебель на заказ стала главным направлением.',                                                                             'image' => $tpl . '/img/about/about-2008.jpg'),
            array('year' => '2009', 'title' => 'Маркетинговый подход',               'text' => 'Переход к маркетинговому мышлению. Первый сайт компании, работа с отзывами, фокус на сервисе и клиентском опыте.',                                                                                  'image' => $tpl . '/img/about/about-2009.jpg'),
            array('year' => '2010', 'title' => 'В новом свете',                      'text' => 'Первый межрегиональный проект — ТЦ «Мега» в Ростове-на-Дону. Команда выезжает на монтаж в другой город — новый формат работы.',                                                                     'image' => $tpl . '/img/about/about-2010.jpg'),
            array('year' => '2011', 'title' => 'От Москвы до самых до окраин',       'text' => 'География расширяется: Москва, Подмосковье, другие регионы. Специализация на встроенной мебели для квартир и домов.',                                                                               'image' => $tpl . '/img/about/about-2011.jpg'),
            array('year' => '2012', 'title' => 'Днем согнем',                        'text' => 'Освоение гнутых фасадов и радиусных конструкций. Уникальные технологические решения, которых нет у конкурентов.',                                                                                   'image' => $tpl . '/img/about/about-2012.jpg'),
            array('year' => '2013', 'title' => 'Полистилизм',                        'text' => 'Новое направление — нестандартные интерьерные решения. Работа с дизайнерами и архитекторами.',                                                                                                      'image' => $tpl . '/img/about/about-2013.jpg'),
            array('year' => '2014', 'title' => 'Вспомнить все',                      'text' => 'Государственные проекты: оснащение музеев и культурных объектов. Высочайшие требования к качеству и точности.',                                                                                     'image' => $tpl . '/img/about/about-2014.jpg'),
            array('year' => '2015', 'title' => 'Заходите к нам на огонек',           'text' => 'Открытие шоу-рума в Нижнем Новгороде. Клиенты наконец могут увидеть образцы вживую и обсудить проект с дизайнером.',                                                                                'image' => $tpl . '/img/about/about-2015.jpg'),
        ),
    );
}

// ====== META BOXES: О производстве ======

// Показываем meta boxes только для шаблона page-about.php
add_action('add_meta_boxes_page', 'novacraft_about_add_meta_boxes');
function novacraft_about_add_meta_boxes($post) {
    if (get_post_meta($post->ID, '_wp_page_template', true) !== 'page-about.php') return;

    add_meta_box('nc_about_production', 'Производство сегодня', 'novacraft_about_production_cb', 'page', 'normal', 'default');
    add_meta_box('nc_about_timeline',   'Хронология (карточки)', 'novacraft_about_timeline_cb',   'page', 'normal', 'default');
}

// --- Секция "Производство сегодня" ---
function novacraft_about_production_cb($post) {
    wp_nonce_field('novacraft_about_save', 'novacraft_about_nonce');
    $d      = novacraft_about_defaults();
    $img    = get_post_meta($post->ID, '_about_prod_image', true) ?: $d['prod_image'];
    $label  = get_post_meta($post->ID, '_about_prod_label', true) ?: $d['prod_label'];
    $title  = get_post_meta($post->ID, '_about_prod_title', true) ?: $d['prod_title'];
    $text   = get_post_meta($post->ID, '_about_prod_text',  true) ?: $d['prod_text'];
    $facts  = get_post_meta($post->ID, '_about_prod_facts', true);
    $facts  = $facts ? json_decode($facts, true) : $d['prod_facts'];
    ?>
    <style>
    .nc-mb-row { display:flex; gap:16px; margin-bottom:14px; align-items:flex-start; }
    .nc-mb-row label { font-weight:600; min-width:160px; padding-top:6px; }
    .nc-mb-row input[type=text],.nc-mb-row textarea { flex:1; padding:6px 8px; border:1px solid #ddd; border-radius:4px; }
    .nc-mb-row textarea { min-height:90px; }
    .nc-img-preview { max-height:80px; margin-top:6px; display:block; border-radius:4px; }
    .nc-facts-table { width:100%; border-collapse:collapse; margin-bottom:8px; }
    .nc-facts-table th { text-align:left; padding:6px 8px; background:#f6f7f7; font-size:12px; border-bottom:1px solid #ddd; }
    .nc-facts-table td { padding:4px 6px; }
    .nc-facts-table input { width:100%; padding:5px 7px; border:1px solid #ddd; border-radius:3px; box-sizing:border-box; }
    .nc-btn { cursor:pointer; padding:5px 12px; border:1px solid #2271b1; color:#2271b1; background:#fff; border-radius:3px; font-size:13px; }
    .nc-btn:hover { background:#2271b1; color:#fff; }
    .nc-btn-remove { border-color:#cc1818; color:#cc1818; }
    .nc-btn-remove:hover { background:#cc1818; color:#fff; }
    </style>
    <div class="nc-mb-row">
        <label>Фото производства</label>
        <div style="flex:1">
            <input type="text" id="about_prod_image" name="about_prod_image" value="<?php echo esc_attr($img); ?>" placeholder="URL изображения или выберите из медиатеки">
            <button type="button" class="nc-btn nc-media-btn" data-target="about_prod_image" style="margin-top:6px;">Выбрать фото</button>
            <?php if ($img): ?><img src="<?php echo esc_url($img); ?>" class="nc-img-preview" id="about_prod_image_preview"><?php endif; ?>
        </div>
    </div>
    <div class="nc-mb-row">
        <label>Надпись над заголовком</label>
        <input type="text" name="about_prod_label" value="<?php echo esc_attr($label); ?>">
    </div>
    <div class="nc-mb-row">
        <label>Заголовок секции</label>
        <input type="text" name="about_prod_title" value="<?php echo esc_attr($title); ?>">
    </div>
    <div class="nc-mb-row">
        <label>Текст описания</label>
        <textarea name="about_prod_text"><?php echo esc_textarea($text); ?></textarea>
    </div>
    <div style="margin-bottom:8px;font-weight:600;">Факты / Цифры</div>
    <table class="nc-facts-table" id="nc-facts-table">
        <thead><tr><th style="width:30%">Значение (напр. 600 м²)</th><th>Описание</th><th style="width:60px"></th></tr></thead>
        <tbody>
        <?php foreach ($facts as $f): ?>
        <tr>
            <td><input type="text" name="fact_value[]" value="<?php echo esc_attr($f['v']); ?>"></td>
            <td><input type="text" name="fact_label[]" value="<?php echo esc_attr($f['l']); ?>"></td>
            <td><button type="button" class="nc-btn nc-btn-remove nc-remove-fact">✕</button></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <button type="button" class="nc-btn" id="nc-add-fact">+ Добавить факт</button>
    <?php
}

// --- Хронология ---
function novacraft_about_timeline_cb($post) {
    $d       = novacraft_about_defaults();
    $raw     = get_post_meta($post->ID, '_about_timeline', true);
    $items   = $raw ? json_decode($raw, true) : $d['timeline'];
    if (empty($items)) $items = $d['timeline'];
    $tpl_uri = get_template_directory_uri();
    ?>
    <div id="nc-timeline-items">
    <?php foreach ($items as $i => $item): ?>
    <div class="nc-tl-item" style="border:1px solid #ddd;border-radius:6px;padding:14px;margin-bottom:12px;background:#fafafa;">
        <div style="display:flex;gap:12px;margin-bottom:10px;">
            <div style="flex:0 0 100px">
                <label style="font-size:12px;font-weight:600;display:block;margin-bottom:4px;">Год</label>
                <input type="text" name="tl_year[]" value="<?php echo esc_attr($item['year']); ?>" style="width:100%;padding:5px 7px;border:1px solid #ddd;border-radius:3px;">
            </div>
            <div style="flex:1">
                <label style="font-size:12px;font-weight:600;display:block;margin-bottom:4px;">Заголовок</label>
                <input type="text" name="tl_title[]" value="<?php echo esc_attr($item['title']); ?>" style="width:100%;padding:5px 7px;border:1px solid #ddd;border-radius:3px;">
            </div>
            <div><button type="button" class="nc-btn nc-btn-remove nc-remove-tl" style="margin-top:20px;">✕ Удалить</button></div>
        </div>
        <div style="margin-bottom:10px;">
            <label style="font-size:12px;font-weight:600;display:block;margin-bottom:4px;">Текст</label>
            <textarea name="tl_text[]" rows="3" style="width:100%;padding:6px 8px;border:1px solid #ddd;border-radius:3px;box-sizing:border-box;"><?php echo esc_textarea($item['text']); ?></textarea>
        </div>
        <div>
            <label style="font-size:12px;font-weight:600;display:block;margin-bottom:4px;">Фото</label>
            <div style="display:flex;gap:8px;align-items:center;">
                <input type="text" name="tl_image[]" value="<?php echo esc_attr($item['image'] ?? ''); ?>" placeholder="URL фото" style="flex:1;padding:5px 7px;border:1px solid #ddd;border-radius:3px;" class="nc-tl-img-input">
                <button type="button" class="nc-btn nc-media-btn" data-target-class="nc-tl-img-input" data-index="<?php echo $i; ?>">Выбрать</button>
                <?php if (!empty($item['image'])): ?>
                <img src="<?php echo esc_url($item['image']); ?>" style="max-height:50px;border-radius:3px;">
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    </div>
    <button type="button" class="nc-btn" id="nc-add-tl" style="margin-top:8px;">+ Добавить карточку</button>

    <script>
    (function(){
        // Шаблон новой карточки хронологии
        var tplIdx = <?php echo count($items); ?>;
        document.getElementById('nc-add-tl').addEventListener('click', function(){
            var html = '<div class="nc-tl-item" style="border:1px solid #ddd;border-radius:6px;padding:14px;margin-bottom:12px;background:#fafafa;">'
                + '<div style="display:flex;gap:12px;margin-bottom:10px;">'
                + '<div style="flex:0 0 100px"><label style="font-size:12px;font-weight:600;display:block;margin-bottom:4px;">Год</label>'
                + '<input type="text" name="tl_year[]" value="" placeholder="2025" style="width:100%;padding:5px 7px;border:1px solid #ddd;border-radius:3px;"></div>'
                + '<div style="flex:1"><label style="font-size:12px;font-weight:600;display:block;margin-bottom:4px;">Заголовок</label>'
                + '<input type="text" name="tl_title[]" value="" style="width:100%;padding:5px 7px;border:1px solid #ddd;border-radius:3px;"></div>'
                + '<div><button type="button" class="nc-btn nc-btn-remove nc-remove-tl" style="margin-top:20px;">✕ Удалить</button></div></div>'
                + '<div style="margin-bottom:10px;"><label style="font-size:12px;font-weight:600;display:block;margin-bottom:4px;">Текст</label>'
                + '<textarea name="tl_text[]" rows="3" style="width:100%;padding:6px 8px;border:1px solid #ddd;border-radius:3px;box-sizing:border-box;"></textarea></div>'
                + '<div><label style="font-size:12px;font-weight:600;display:block;margin-bottom:4px;">Фото</label>'
                + '<div style="display:flex;gap:8px;align-items:center;">'
                + '<input type="text" name="tl_image[]" value="" placeholder="URL фото" style="flex:1;padding:5px 7px;border:1px solid #ddd;border-radius:3px;" class="nc-tl-img-input">'
                + '<button type="button" class="nc-btn nc-media-btn nc-tl-media" data-target-class="nc-tl-img-input">Выбрать</button>'
                + '</div></div></div>';
            document.getElementById('nc-timeline-items').insertAdjacentHTML('beforeend', html);
            bindEvents();
            tplIdx++;
        });

        // Добавить факт
        document.getElementById('nc-add-fact').addEventListener('click', function(){
            var tbody = document.querySelector('#nc-facts-table tbody');
            var tr = document.createElement('tr');
            tr.innerHTML = '<td><input type="text" name="fact_value[]" style="width:100%;padding:5px 7px;border:1px solid #ddd;border-radius:3px;box-sizing:border-box;"></td>'
                + '<td><input type="text" name="fact_label[]" style="width:100%;padding:5px 7px;border:1px solid #ddd;border-radius:3px;box-sizing:border-box;"></td>'
                + '<td><button type="button" class="nc-btn nc-btn-remove nc-remove-fact">✕</button></td>';
            tbody.appendChild(tr);
            bindEvents();
        });

        function bindEvents() {
            // Удалить факт
            document.querySelectorAll('.nc-remove-fact').forEach(function(btn){
                btn.onclick = function(){ btn.closest('tr').remove(); };
            });
            // Удалить карточку
            document.querySelectorAll('.nc-remove-tl').forEach(function(btn){
                btn.onclick = function(){ btn.closest('.nc-tl-item').remove(); };
            });
            // Медиа-загрузчик
            document.querySelectorAll('.nc-media-btn').forEach(function(btn){
                btn.onclick = function(){
                    var target = btn.dataset.target
                        ? document.getElementById(btn.dataset.target)
                        : btn.closest('div').querySelector('.nc-tl-img-input');
                    var frame = wp.media({ title: 'Выбрать фото', button: { text: 'Выбрать' }, multiple: false });
                    frame.on('select', function(){
                        var att = frame.state().get('selection').first().toJSON();
                        target.value = att.url;
                        var preview = target.parentNode.querySelector('img');
                        if (preview) { preview.src = att.url; }
                        else {
                            var img = document.createElement('img');
                            img.src = att.url; img.style.maxHeight = '50px'; img.style.borderRadius = '3px';
                            target.parentNode.appendChild(img);
                        }
                    });
                    frame.open();
                };
            });
        }
        bindEvents();
    })();
    </script>
    <?php
}

// --- Сохранение данных ---
add_action('save_post_page', 'novacraft_about_save_meta');
function novacraft_about_save_meta($post_id) {
    if (!isset($_POST['novacraft_about_nonce']) || !wp_verify_nonce($_POST['novacraft_about_nonce'], 'novacraft_about_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    // Производство
    update_post_meta($post_id, '_about_prod_image', sanitize_url($_POST['about_prod_image'] ?? ''));
    update_post_meta($post_id, '_about_prod_label', sanitize_text_field($_POST['about_prod_label'] ?? ''));
    update_post_meta($post_id, '_about_prod_title', sanitize_text_field($_POST['about_prod_title'] ?? ''));
    update_post_meta($post_id, '_about_prod_text',  wp_kses_post($_POST['about_prod_text'] ?? ''));

    // Факты
    $facts = array();
    $vals   = array_map('sanitize_text_field', $_POST['fact_value'] ?? array());
    $labels = array_map('sanitize_text_field', $_POST['fact_label'] ?? array());
    foreach ($vals as $i => $v) {
        if ($v !== '' || ($labels[$i] ?? '') !== '') {
            $facts[] = array('v' => $v, 'l' => $labels[$i] ?? '');
        }
    }
    update_post_meta($post_id, '_about_prod_facts', wp_json_encode($facts, JSON_UNESCAPED_UNICODE));

    // Хронология
    $items  = array();
    $years  = array_map('sanitize_text_field', $_POST['tl_year']  ?? array());
    $titles = array_map('sanitize_text_field', $_POST['tl_title'] ?? array());
    $texts  = array_map('sanitize_textarea_field', $_POST['tl_text']  ?? array());
    $images = array_map('sanitize_url', $_POST['tl_image'] ?? array());
    foreach ($years as $i => $y) {
        $items[] = array(
            'year'  => $y,
            'title' => $titles[$i] ?? '',
            'text'  => $texts[$i]  ?? '',
            'image' => $images[$i] ?? '',
        );
    }
    update_post_meta($post_id, '_about_timeline', wp_json_encode($items, JSON_UNESCAPED_UNICODE));
}

// Подключаем WP Media Uploader для страниц и товаров мебели
add_action('admin_enqueue_scripts', 'novacraft_about_admin_scripts');
function novacraft_about_admin_scripts($hook) {
    if ($hook !== 'post.php' && $hook !== 'post-new.php') return;
    $screen = get_current_screen();
    if (!$screen) return;
    if (in_array($screen->post_type, array('page', 'furniture'), true)) {
        wp_enqueue_media();
    }
}

// ====== ACF FIELDS (заглушка на случай установки ACF) ======
add_action('acf/init', 'novacraft_register_about_fields');
function novacraft_register_about_fields() {
    if (!function_exists('acf_add_local_field_group')) return;

    acf_add_local_field_group(array(
        'key'    => 'group_about_page',
        'title'  => 'О производстве — Контент',
        'fields' => array(

            // ---- Вкладка: Производство сегодня ----
            array(
                'key'   => 'field_about_prod_tab',
                'label' => 'Производство сегодня',
                'type'  => 'tab',
            ),
            array(
                'key'           => 'field_about_prod_image',
                'label'         => 'Фото производства',
                'name'          => 'about_prod_image',
                'type'          => 'image',
                'return_format' => 'url',
                'preview_size'  => 'medium',
            ),
            array(
                'key'           => 'field_about_prod_label',
                'label'         => 'Надпись над заголовком',
                'name'          => 'about_prod_label',
                'type'          => 'text',
                'default_value' => 'Сегодня',
            ),
            array(
                'key'           => 'field_about_prod_title',
                'label'         => 'Заголовок секции',
                'name'          => 'about_prod_title',
                'type'          => 'text',
                'default_value' => 'Своё производство — наш главный актив',
            ),
            array(
                'key'          => 'field_about_prod_text',
                'label'        => 'Текст (описание производства)',
                'name'         => 'about_prod_text',
                'type'         => 'wysiwyg',
                'toolbar'      => 'basic',
                'media_upload' => 0,
            ),
            array(
                'key'          => 'field_about_prod_facts',
                'label'        => 'Факты / Цифры',
                'name'         => 'about_prod_facts',
                'type'         => 'repeater',
                'button_label' => 'Добавить факт',
                'layout'       => 'table',
                'sub_fields'   => array(
                    array(
                        'key'     => 'field_fact_value',
                        'label'   => 'Значение (напр. 600 м²)',
                        'name'    => 'fact_value',
                        'type'    => 'text',
                        'wrapper' => array('width' => '30'),
                    ),
                    array(
                        'key'     => 'field_fact_label',
                        'label'   => 'Описание (напр. производственная площадь)',
                        'name'    => 'fact_label',
                        'type'    => 'text',
                        'wrapper' => array('width' => '70'),
                    ),
                ),
            ),

            // ---- Вкладка: Хронология ----
            array(
                'key'   => 'field_about_timeline_tab',
                'label' => 'Хронология',
                'type'  => 'tab',
            ),
            array(
                'key'           => 'field_about_tl_intro_title',
                'label'         => 'Заголовок блока хронологии',
                'name'          => 'about_tl_intro_title',
                'type'          => 'text',
                'default_value' => 'А вот как всё начиналось...',
            ),
            array(
                'key'           => 'field_about_tl_intro_text',
                'label'         => 'Подзаголовок хронологии',
                'name'          => 'about_tl_intro_text',
                'type'          => 'textarea',
                'rows'          => 3,
                'default_value' => 'С 1996 года — три десятилетия роста, кризисов, экспериментов и тысяч реализованных проектов. Листайте вниз, чтобы пройти этот путь вместе с нами.',
            ),
            array(
                'key'          => 'field_about_timeline',
                'label'        => 'Карточки хронологии',
                'name'         => 'about_timeline',
                'type'         => 'repeater',
                'button_label' => 'Добавить карточку',
                'layout'       => 'block',
                'sub_fields'   => array(
                    array(
                        'key'     => 'field_tl_year',
                        'label'   => 'Год',
                        'name'    => 'tl_year',
                        'type'    => 'text',
                        'wrapper' => array('width' => '15'),
                    ),
                    array(
                        'key'     => 'field_tl_title',
                        'label'   => 'Заголовок',
                        'name'    => 'tl_title',
                        'type'    => 'text',
                        'wrapper' => array('width' => '85'),
                    ),
                    array(
                        'key'   => 'field_tl_text',
                        'label' => 'Текст',
                        'name'  => 'tl_text',
                        'type'  => 'textarea',
                        'rows'  => 3,
                    ),
                    array(
                        'key'           => 'field_tl_image',
                        'label'         => 'Фото',
                        'name'          => 'tl_image',
                        'type'          => 'image',
                        'return_format' => 'array',
                        'preview_size'  => 'medium',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'page_template',
                    'operator' => '==',
                    'value'    => 'page-about.php',
                ),
            ),
        ),
        'menu_order'          => 0,
        'position'            => 'normal',
        'style'               => 'default',
        'label_placement'     => 'top',
        'instruction_placement' => 'label',
    ));
}

