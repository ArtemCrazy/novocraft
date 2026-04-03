<?php
/**
 * Archive Template: Products (novacraft_product CPT)
 *
 * @package Novacraft
 */

get_header();

$u = esc_url( get_template_directory_uri() );

$categories = [
    [ 'slug' => 'all',      'label' => 'Все',          'img' => 'kitchen_020000.jpg' ],
    [ 'slug' => 'kitchen',  'label' => 'Кухни',        'img' => 'kitchen_020000.jpg' ],
    [ 'slug' => 'wardrobe', 'label' => 'Шкафы',        'img' => 'wardrobe_020000.jpg' ],
    [ 'slug' => 'closet',   'label' => 'Гардеробные',  'img' => 'wardrobe_010000.jpg' ],
    [ 'slug' => 'bedroom',  'label' => 'Кровати',      'img' => 'bedroom_010001.jpg' ],
    [ 'slug' => 'dresser',  'label' => 'Комоды',       'img' => 'bedroom_020002.jpg' ],
    [ 'slug' => 'storage',  'label' => 'Стеллажи',     'img' => 'living_room_030000.jpg' ],
    [ 'slug' => 'hallway',  'label' => 'Обувницы',     'img' => 'hallway_020000.jpg' ],
    [ 'slug' => 'office',   'label' => 'Столы',        'img' => 'kitchen_030000.jpg' ],
    [ 'slug' => 'bedside',  'label' => 'Тумбы',        'img' => 'bedroom_020002.jpg' ],
];

$current_cat = isset( $_GET['category'] ) ? sanitize_text_field( $_GET['category'] ) : 'all';
?>

<!-- PAGE TITLE -->
<section class="catalog-page-title">
    <div class="container">
        <h1 class="catalog-page-title__h">Мебель <span>для дома</span></h1>
        <p class="catalog-page-title__sub">Выберите категорию — кухни, шкафы, гардеробные, кровати, комоды и другое</p>
    </div>
</section>

<!-- CATEGORY CIRCLES -->
<section class="cat-circle-section">
    <div class="container">
        <div class="cat-circle-row" style="padding: 10px 6px 18px; overflow: visible;">
            <?php foreach ( $categories as $cat ) :
                $active = ( $cat['slug'] === $current_cat ) ? ' cat-circle-item--active' : '';
            ?>
            <button class="cat-circle-item<?php echo esc_attr( $active ); ?>"
                    data-cat="<?php echo esc_attr( $cat['slug'] ); ?>"
                    onclick="ncFilterCat('<?php echo esc_js( $cat['slug'] ); ?>')">
                <div class="cat-circle-item__img">
                    <img src="<?php echo $u; ?>/img/<?php echo esc_attr( $cat['img'] ); ?>" alt="<?php echo esc_attr( $cat['label'] ); ?>">
                </div>
                <span><?php echo esc_html( $cat['label'] ); ?></span>
            </button>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CATALOG GRID -->
<section class="catalog-section" style="padding: var(--space-2xl) 0 var(--space-4xl);">
    <div class="container">
        <div class="catalog-grid" id="catalogGrid">
            <?php
            $tax_query = [];
            if ( $current_cat && $current_cat !== 'all' ) {
                $tax_query[] = [
                    'taxonomy' => 'novacraft_product_cat',
                    'field'    => 'slug',
                    'terms'    => $current_cat,
                ];
            }

            $products = new WP_Query( [
                'post_type'      => 'novacraft_product',
                'posts_per_page' => 24,
                'orderby'        => 'date',
                'order'          => 'DESC',
                'tax_query'      => $tax_query,
            ] );

            if ( $products->have_posts() ) :
                while ( $products->have_posts() ) : $products->the_post();
                    $pid   = get_the_ID();
                    $price = get_post_meta( $pid, '_novacraft_price',    true );
                    $badge = get_post_meta( $pid, '_novacraft_badge',    true );
                    $mat   = get_post_meta( $pid, '_novacraft_material', true );
                    $dims  = get_post_meta( $pid, '_novacraft_dimensions', true );
                    $terms = get_the_terms( $pid, 'novacraft_product_cat' );
                    $cat_s = ( $terms && ! is_wp_error( $terms ) ) ? $terms[0]->slug : '';
            ?>
            <a href="<?php the_permalink(); ?>" class="catalog-card" data-cat="<?php echo esc_attr( $cat_s ); ?>">
                <div class="catalog-card__img">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( 'medium_large', [ 'loading' => 'lazy', 'alt' => get_the_title() ] ); ?>
                    <?php else : ?>
                        <img src="<?php echo $u; ?>/img/kitchen_010000.jpg" alt="<?php the_title_attribute(); ?>" loading="lazy">
                    <?php endif; ?>
                    <?php if ( $badge ) : ?>
                        <span style="position:absolute;top:var(--space-sm);left:var(--space-sm);padding:4px 10px;font-size:0.72rem;font-weight:700;color:#fff;background:var(--color-accent);border-radius:20px;z-index:2;letter-spacing:0.02em;"><?php echo esc_html( $badge ); ?></span>
                    <?php endif; ?>
                </div>
                <div class="catalog-card__body">
                    <h3 class="catalog-card__title"><?php the_title(); ?></h3>
                    <?php $excerpt = get_the_excerpt(); if ( $excerpt ) : ?>
                    <p class="catalog-card__desc"><?php echo esc_html( $excerpt ); ?></p>
                    <?php endif; ?>
                    <?php if ( $mat || $dims ) : ?>
                    <div class="catalog-card__dims">
                        <?php if ( $mat ) : ?><span><strong>Материал:</strong><?php echo esc_html( $mat ); ?></span><?php endif; ?>
                        <?php if ( $dims ) : ?><span><strong>Размеры:</strong><?php echo esc_html( $dims ); ?></span><?php endif; ?>
                    </div>
                    <?php endif; ?>
                    <?php if ( $price ) : ?>
                    <div class="catalog-card__price-row">
                        <span class="catalog-card__price"><?php echo esc_html( $price ); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="catalog-card__hover">
                    <button class="catalog-card__hover-btn" type="button">Подробнее</button>
                </div>
            </a>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
            ?>
            <div style="grid-column:1/-1;text-align:center;padding:var(--space-3xl) 0;color:var(--color-text-muted);">
                По вашему запросу ничего не найдено.
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<script>
function ncFilterCat(slug) {
    // Обновляем активный кружок
    document.querySelectorAll('.cat-circle-item').forEach(function(btn) {
        btn.classList.toggle('cat-circle-item--active', btn.dataset.cat === slug);
    });

    var grid = document.getElementById('catalogGrid');
    grid.style.opacity = '0.4';
    grid.style.pointerEvents = 'none';

    var fd = new FormData();
    fd.append('action', 'nc_catalog_filter');
    fd.append('category', slug);

    fetch(ncCatalog.ajaxurl, { method: 'POST', body: fd })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            if (data.success) {
                grid.innerHTML = data.data.html;
            }
            grid.style.opacity = '1';
            grid.style.pointerEvents = '';
        })
        .catch(function() {
            grid.style.opacity = '1';
            grid.style.pointerEvents = '';
        });

    // Обновляем URL без перезагрузки
    var url = new URL(window.location);
    if (slug === 'all') {
        url.searchParams.delete('category');
    } else {
        url.searchParams.set('category', slug);
    }
    history.pushState({}, '', url);
}
</script>

<?php get_template_part( 'template-parts/contact-section' ); ?>

<?php get_footer(); ?>
