<?php
/**
 * Meta box: Год — для CPT novacraft_history
 */

function nc_history_meta_box() {
    add_meta_box(
        'nc_history_year',
        'Год',
        'nc_history_year_cb',
        'novacraft_history',
        'side',
        'high'
    );
}
add_action( 'add_meta_boxes', 'nc_history_meta_box' );

function nc_history_year_cb( $post ) {
    wp_nonce_field( 'nc_history_year_save', 'nc_history_year_nonce' );
    $year = get_post_meta( $post->ID, '_nc_history_year', true );
    echo '<label style="display:block;margin-bottom:6px;font-weight:600;">Год (например: 1996)</label>';
    echo '<input type="number" name="nc_history_year" value="' . esc_attr( $year ) . '" style="width:100%;padding:6px 10px;font-size:1rem;" min="1900" max="2100">';
    echo '<p style="margin:8px 0 0;color:#888;font-size:0.82em;">Используется для сортировки и отображения в таймлайне.</p>';
}

function nc_history_year_save( $post_id ) {
    if ( ! isset( $_POST['nc_history_year_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['nc_history_year_nonce'], 'nc_history_year_save' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    if ( isset( $_POST['nc_history_year'] ) ) {
        update_post_meta( $post_id, '_nc_history_year', intval( $_POST['nc_history_year'] ) );
    }
}
add_action( 'save_post_novacraft_history', 'nc_history_year_save' );
