<?php
get_header();

/* ----------------------------------------------------------------
 * Slug map: DB slug → English slug (используется везде одинаково)
 * ---------------------------------------------------------------- */
$_furn_slug_map = array(
    'kuhnya'    => 'kitchen',
    'shkaf'     => 'wardrobe',
    'garderobna'=> 'closet',
    'krovat'    => 'bedroom',
    'komod'     => 'dresser',
    'stellazh'  => 'storage',
    'obuvnica'  => 'hallway',
    'stol'      => 'office',
    'tumba'     => 'bedside',
);

/* ----------------------------------------------------------------
 * Fallback images per category slug (Unsplash)
 * ---------------------------------------------------------------- */
$_furn_fallback = array(
    'kitchen'  => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=800&q=80',
    'wardrobe' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&q=80',
    'closet'   => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&q=80',
    'bedroom'  => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=800&q=80',
    'dresser'  => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=800&q=80',
    'storage'  => 'https://images.unsplash.com/photo-1494438639946-1ebd1d20bf85?w=800&q=80',
    'hallway'  => 'https://images.unsplash.com/photo-1560448075-bb485b067938?w=800&q=80',
    'office'   => 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=800&q=80',
    'bedside'  => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=800&q=80',
);
$_furn_default_img = 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=200&q=70';

/* Load categories from DB — применяем slug map к ключу */
$_furn_terms = get_terms( array( 'taxonomy' => 'furniture_cat', 'hide_empty' => false, 'orderby' => 'name', 'order' => 'ASC' ) );
$furn_cats = array();
if ( ! is_wp_error( $_furn_terms ) ) {
    foreach ( $_furn_terms as $_t ) {
        $mapped = $_furn_slug_map[ $_t->slug ] ?? $_t->slug;
        $img = get_term_meta( $_t->term_id, 'furniture_cat_img', true );
        if ( ! $img ) $img = $_furn_fallback[ $mapped ] ?? $_furn_fallback[ $_t->slug ] ?? $_furn_default_img;
        $furn_cats[ $mapped ] = array( 'label' => $_t->name, 'img' => $img );
    }
}
$_furn_all_img = $furn_cats ? reset( $furn_cats )['img'] : $_furn_default_img;

/* Load furniture posts */
$furn_query = new WP_Query( array(
    'post_type'      => 'furniture',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order date',
    'order'          => 'ASC',
) );
?>
<main id="primary" class="site-main">

    <!-- ============ PAGE TITLE ============ -->
    <section class="catalog-page-title">
        <div class="container">
            <h1 class="catalog-page-title__h">Мебель <span>для дома</span></h1>
            <p class="catalog-page-title__sub">Выберите категорию — кухни, шкафы, гардеробные, кровати, комоды и другое</p>
        </div>
    </section>

    <!-- ============ CATEGORY CIRCLES ============ -->
    <section class="cat-circle-section">
        <div class="container">
            <div class="cat-circle-row" id="catCircleRow">
                <button class="cat-circle-item cat-circle-item--active" data-cat="all">
                    <div class="cat-circle-item__img">
                        <img src="<?php echo esc_url( $_furn_all_img ); ?>" alt="Все" onerror="this.src='<?php echo get_template_directory_uri(); ?>/img/kitchen_wood_autumn.jpg'">
                    </div>
                    <span>Все</span>
                </button>
                <?php foreach ( $furn_cats as $mapped_slug => $info ) : ?>
                <button class="cat-circle-item" data-cat="<?php echo esc_attr( $mapped_slug ); ?>">
                    <div class="cat-circle-item__img">
                        <img src="<?php echo esc_url( $info['img'] ); ?>" alt="<?php echo esc_attr( $info['label'] ); ?>" onerror="this.src='<?php echo get_template_directory_uri(); ?>/img/kitchen_wood_autumn.jpg'">
                    </div>
                    <span><?php echo esc_html( $info['label'] ); ?></span>
                </button>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ============ CATALOG GRID ============ -->
    <section class="catalog-section" style="padding: var(--space-2xl) 0 var(--space-4xl);">
        <div class="container">
            <div class="catalog-grid" id="catalogGrid">

            <?php if ( $furn_query->have_posts() ) :
                while ( $furn_query->have_posts() ) : $furn_query->the_post();
                    $f_img_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                    if ( ! $f_img_url ) $f_img_url = get_post_meta( get_the_ID(), 'f_img_url', true );
                    $gallery_json = get_post_meta( get_the_ID(), 'f_gallery_json', true );
                    $gallery_urls = $gallery_json ? json_decode( $gallery_json, true ) : array();
                    $img   = $f_img_url ?: ( $gallery_urls[0] ?? $_furn_default_img );
                    $thumb = $gallery_urls[1] ?? '';
                    $price = get_post_meta( get_the_ID(), 'f_price', true ) ?: '';
                    $dims  = get_post_meta( get_the_ID(), 'f_dims',  true ) ?: '';
                    $excerpt = get_the_excerpt();
                    if ( ! $excerpt ) {
                        $content = get_the_content();
                        $excerpt = wp_trim_words( wp_strip_all_tags( $content ), 18, '…' );
                    }
                    $cats     = get_the_terms( get_the_ID(), 'furniture_cat' );
                    $raw_slug = ( $cats && ! is_wp_error( $cats ) ) ? $cats[0]->slug : 'other';
                    $cat_slug = $_furn_slug_map[ $raw_slug ] ?? $raw_slug;

                    /* Parse dims "2400 × 600 × 850 мм" */
                    $dims_parts = array();
                    if ( $dims ) {
                        $raw = preg_split('/[×x×\s]+/', preg_replace('/[^0-9×x×\s]/u', '', $dims));
                        $dims_parts = array_values( array_filter( array_map('trim', $raw) ) );
                    }
            ?>
                <a href="<?php echo esc_url( get_permalink() ); ?>"
                   class="furn-card"
                   data-cat="<?php echo esc_attr( $cat_slug ); ?>"
                   data-id="<?php echo get_the_ID(); ?>"
                   data-title="<?php the_title_attribute(); ?>"
                   data-img="<?php echo esc_attr( $img ); ?>"
                   data-price="<?php echo esc_attr( $price ); ?>">
                    <div class="furn-card__photo">
                        <img src="<?php echo esc_url( $img ); ?>" alt="<?php the_title_attribute(); ?>"
                             onerror="this.src='<?php echo get_template_directory_uri(); ?>/img/kitchen_wood_autumn.jpg'">
                        <div class="furn-card__heart">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                        </div>
                        <?php if ( $thumb ) : ?>
                        <div class="furn-card__thumb">
                            <img src="<?php echo esc_url( $thumb ); ?>" alt="">
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="furn-card__body">
                        <h3 class="furn-card__title"><?php the_title(); ?></h3>
                        <?php if ( $excerpt ) : ?>
                        <p class="furn-card__desc"><?php echo esc_html( $excerpt ); ?></p>
                        <?php endif; ?>
                        <?php if ( count( $dims_parts ) >= 3 ) : ?>
                        <div class="furn-card__dims">
                            <div class="furn-card__dim">
                                <span class="furn-card__dim-label">Ширина</span>
                                <span class="furn-card__dim-val"><?php echo esc_html( $dims_parts[0] ); ?> мм.</span>
                            </div>
                            <div class="furn-card__dim">
                                <span class="furn-card__dim-label">Высота</span>
                                <span class="furn-card__dim-val"><?php echo esc_html( $dims_parts[2] ); ?> мм.</span>
                            </div>
                            <div class="furn-card__dim">
                                <span class="furn-card__dim-label">Глубина</span>
                                <span class="furn-card__dim-val"><?php echo esc_html( $dims_parts[1] ); ?> мм.</span>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if ( $price ) : ?>
                        <div class="furn-card__price-row">
                            <span class="furn-card__price"><?php echo esc_html( $price ); ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="furn-card__btn">Рассчитать стоимость по вашим размерам</div>
                    </div>
                </a>
            <?php endwhile; wp_reset_postdata();
            else : ?>
                <p style="text-align:center;padding:var(--space-3xl) 0;color:var(--color-text-muted);grid-column:1/-1;">
                    Товары скоро появятся — следите за обновлениями.
                </p>
            <?php endif; ?>

            </div>

            <div id="catalogEmpty" style="display:none; text-align:center; padding:var(--space-3xl) 0; color:var(--color-text-muted);">
                По данной категории пока нет товаров.
            </div>
        </div>
    </section>

    <!-- ============ CONTACT ============ -->
    <?php get_template_part( 'template-parts/contact-section' ); ?>

</main>

<script>
(function () {
    var row   = document.getElementById('catCircleRow');
    var grid  = document.getElementById('catalogGrid');
    var empty = document.getElementById('catalogEmpty');
    if (!row || !grid) return;

    function filter(cat) {
        var cards = grid.querySelectorAll('.furn-card');
        var visible = 0;
        cards.forEach(function (card) {
            var show = (cat === 'all' || card.getAttribute('data-cat') === cat);
            if (show) {
                card.classList.remove('furn-card--hidden');
                card.style.pointerEvents = '';
                visible++;
            } else {
                card.classList.add('furn-card--hidden');
                card.style.pointerEvents = 'none';
            }
        });
        empty.style.display = visible === 0 ? 'block' : 'none';
    }

    row.querySelectorAll('.cat-circle-item').forEach(function (btn) {
        btn.addEventListener('click', function () {
            row.querySelectorAll('.cat-circle-item').forEach(function (b) { b.classList.remove('cat-circle-item--active'); });
            btn.classList.add('cat-circle-item--active');
            filter(btn.getAttribute('data-cat'));
        });
    });

    var urlCat = new URLSearchParams(window.location.search).get('category');
    if (urlCat) {
        var btn = row.querySelector('[data-cat="' + urlCat + '"]');
        if (btn) btn.click();
    }
})();
</script>

<?php get_footer(); ?>
