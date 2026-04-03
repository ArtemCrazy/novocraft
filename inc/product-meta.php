<?php
/**
 * Meta Boxes для CPT novacraft_product.
 * WP Admin → Продукция → [товар] → поля под редактором.
 */

// ── Регистрация ──────────────────────────────────────────────────────────────
function novacraft_product_meta_boxes() {
    add_meta_box(
        'nc_product_main',
        'Цена и бейдж',
        'nc_product_main_cb',
        'novacraft_product',
        'side',
        'high'
    );
    add_meta_box(
        'nc_product_details',
        'Характеристики',
        'nc_product_details_cb',
        'novacraft_product',
        'normal',
        'high'
    );
    add_meta_box(
        'nc_product_specs',
        'Таблица характеристик (для страницы товара)',
        'nc_product_specs_cb',
        'novacraft_product',
        'normal',
        'default'
    );
    add_meta_box(
        'nc_product_delivery',
        'Доставка и оплата',
        'nc_product_delivery_cb',
        'novacraft_product',
        'normal',
        'default'
    );
    add_meta_box(
        'nc_product_gallery',
        'Галерея товара (ID изображений через запятую)',
        'nc_product_gallery_cb',
        'novacraft_product',
        'normal',
        'default'
    );
}
add_action( 'add_meta_boxes', 'novacraft_product_meta_boxes' );

// ── Цена и бейдж (side) ───────────────────────────────────────────────────────
function nc_product_main_cb( $post ) {
    wp_nonce_field( 'nc_save_product', 'nc_product_nonce' );
    $price     = get_post_meta( $post->ID, '_novacraft_price',     true );
    $old_price = get_post_meta( $post->ID, '_novacraft_old_price', true );
    $badge     = get_post_meta( $post->ID, '_novacraft_badge',     true );
    ?>
    <p>
        <label style="display:block;font-weight:600;margin-bottom:4px;">Цена (например: от 85 000 ₽)</label>
        <input type="text" name="_novacraft_price" value="<?php echo esc_attr( $price ); ?>" style="width:100%">
    </p>
    <p>
        <label style="display:block;font-weight:600;margin-bottom:4px;">Старая цена (опционально)</label>
        <input type="text" name="_novacraft_old_price" value="<?php echo esc_attr( $old_price ); ?>" style="width:100%">
    </p>
    <p>
        <label style="display:block;font-weight:600;margin-bottom:4px;">Бейдж (например: Хит продаж)</label>
        <input type="text" name="_novacraft_badge" value="<?php echo esc_attr( $badge ); ?>" style="width:100%">
    </p>
    <?php
}

// ── Характеристики ────────────────────────────────────────────────────────────
function nc_product_details_cb( $post ) {
    $material   = get_post_meta( $post->ID, '_novacraft_material',   true );
    $dimensions = get_post_meta( $post->ID, '_novacraft_dimensions', true );
    $color      = get_post_meta( $post->ID, '_novacraft_color',      true );
    $lead_time  = get_post_meta( $post->ID, '_novacraft_lead_time',  true );
    ?>
    <table class="form-table" style="width:100%"><tbody>
    <tr>
        <th style="width:160px"><label>Материал</label></th>
        <td><input type="text" name="_novacraft_material" value="<?php echo esc_attr( $material ); ?>" class="large-text" placeholder="ЛДСП 16мм, МДФ фасады"></td>
    </tr>
    <tr>
        <th><label>Размеры</label></th>
        <td><input type="text" name="_novacraft_dimensions" value="<?php echo esc_attr( $dimensions ); ?>" class="large-text" placeholder="По вашим размерам"></td>
    </tr>
    <tr>
        <th><label>Цвет / покрытие</label></th>
        <td><input type="text" name="_novacraft_color" value="<?php echo esc_attr( $color ); ?>" class="large-text" placeholder="На выбор из каталога"></td>
    </tr>
    <tr>
        <th><label>Срок изготовления</label></th>
        <td><input type="text" name="_novacraft_lead_time" value="<?php echo esc_attr( $lead_time ); ?>" class="large-text" placeholder="от 14 дней"></td>
    </tr>
    </tbody></table>
    <?php
}

// ── Таблица характеристик ─────────────────────────────────────────────────────
function nc_product_specs_cb( $post ) {
    $specs_raw = get_post_meta( $post->ID, '_novacraft_specs', true );
    // Храним как JSON: [["Ширина","120 см"], ...]
    $specs = [];
    if ( $specs_raw ) {
        $decoded = json_decode( $specs_raw, true );
        if ( is_array( $decoded ) ) $specs = $decoded;
    }
    ?>
    <p style="color:#666;margin-bottom:8px;">Каждая строка — одна строка таблицы. Формат: <code>Название: Значение</code></p>
    <textarea name="_novacraft_specs_text" rows="8" style="width:100%;font-family:monospace;"><?php
        foreach ( $specs as $row ) {
            echo esc_textarea( $row[0] . ': ' . $row[1] ) . "\n";
        }
    ?></textarea>
    <?php
}

// ── Доставка и оплата ─────────────────────────────────────────────────────────
function nc_product_delivery_cb( $post ) {
    $delivery = get_post_meta( $post->ID, '_novacraft_delivery_info', true );
    ?>
    <textarea name="_novacraft_delivery_info" rows="5" style="width:100%"><?php echo esc_textarea( $delivery ); ?></textarea>
    <p style="color:#666;margin-top:4px;">Если пусто — на странице товара отображается стандартный текст о доставке.</p>
    <?php
}

// ── Галерея ───────────────────────────────────────────────────────────────────
function nc_product_gallery_cb( $post ) {
    $gallery = get_post_meta( $post->ID, '_novacraft_gallery', true );
    $ids     = is_array( $gallery ) ? implode( ', ', $gallery ) : '';
    ?>
    <p style="color:#666;margin-bottom:8px;">Укажите ID изображений из медиатеки через запятую. Первым идёт главное фото (задаётся через «Изображение записи» в боковой панели).</p>
    <input type="text" name="_novacraft_gallery_ids" value="<?php echo esc_attr( $ids ); ?>" class="large-text" placeholder="123, 456, 789">
    <p style="margin-top:8px;">
        <button type="button" class="button" id="nc_gallery_btn">Открыть медиатеку</button>
    </p>
    <div id="nc_gallery_preview" style="display:flex;flex-wrap:wrap;gap:8px;margin-top:8px;">
        <?php
        if ( is_array( $gallery ) ) {
            foreach ( $gallery as $img_id ) {
                $thumb = wp_get_attachment_image_url( (int) $img_id, 'thumbnail' );
                if ( $thumb ) {
                    echo '<img src="' . esc_url( $thumb ) . '" style="width:80px;height:60px;object-fit:cover;border-radius:4px;">';
                }
            }
        }
        ?>
    </div>
    <script>
    jQuery(function($){
        var frame;
        $('#nc_gallery_btn').on('click', function(){
            if (frame) { frame.open(); return; }
            frame = wp.media({ title: 'Выберите фото галереи', multiple: true, library: { type: 'image' } });
            frame.on('select', function(){
                var ids = [], previews = [];
                frame.state().get('selection').each(function(att){
                    ids.push(att.id);
                    previews.push('<img src="' + att.get('sizes').thumbnail.url + '" style="width:80px;height:60px;object-fit:cover;border-radius:4px;">');
                });
                $('[name=_novacraft_gallery_ids]').val(ids.join(', '));
                $('#nc_gallery_preview').html(previews.join(''));
            });
            frame.open();
        });
    });
    </script>
    <?php
}

// ── Сохранение ────────────────────────────────────────────────────────────────
function nc_save_product_meta( $post_id ) {
    if ( ! isset( $_POST['nc_product_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['nc_product_nonce'], 'nc_save_product' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( get_post_type( $post_id ) !== 'novacraft_product' ) return;

    $text_fields = [
        '_novacraft_price', '_novacraft_old_price', '_novacraft_badge',
        '_novacraft_material', '_novacraft_dimensions', '_novacraft_color',
        '_novacraft_lead_time',
    ];
    foreach ( $text_fields as $key ) {
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, $key, sanitize_text_field( $_POST[ $key ] ) );
        }
    }

    // Specs: parse "Key: Value" lines → JSON array
    if ( isset( $_POST['_novacraft_specs_text'] ) ) {
        $lines = explode( "\n", sanitize_textarea_field( $_POST['_novacraft_specs_text'] ) );
        $specs = [];
        foreach ( $lines as $line ) {
            $line = trim( $line );
            if ( ! $line ) continue;
            $pos = strpos( $line, ':' );
            if ( $pos !== false ) {
                $specs[] = [ trim( substr( $line, 0, $pos ) ), trim( substr( $line, $pos + 1 ) ) ];
            }
        }
        update_post_meta( $post_id, '_novacraft_specs', wp_json_encode( $specs ) );
    }

    // Delivery
    if ( isset( $_POST['_novacraft_delivery_info'] ) ) {
        update_post_meta( $post_id, '_novacraft_delivery_info', sanitize_textarea_field( $_POST['_novacraft_delivery_info'] ) );
    }

    // Gallery IDs
    if ( isset( $_POST['_novacraft_gallery_ids'] ) ) {
        $raw = sanitize_text_field( $_POST['_novacraft_gallery_ids'] );
        $ids = array_map( 'intval', array_filter( array_map( 'trim', explode( ',', $raw ) ) ) );
        update_post_meta( $post_id, '_novacraft_gallery', $ids );
    }
}
add_action( 'save_post', 'nc_save_product_meta' );
