<?php
/* Template Name: Каталог */

get_header();

$u = esc_url( get_template_directory_uri() );

// Category definitions for circle filters
$categories = [
    [ 'slug' => 'all',      'label' => 'Все',          'img' => 'kitchen_020000.jpg' ],
    [ 'slug' => 'kitchen',   'label' => 'Кухни',        'img' => 'kitchen_020000.jpg' ],
    [ 'slug' => 'wardrobe',  'label' => 'Шкафы',        'img' => 'wardrobe_020000.jpg' ],
    [ 'slug' => 'closet',    'label' => 'Гардеробные',  'img' => 'wardrobe_010000.jpg' ],
    [ 'slug' => 'bedroom',   'label' => 'Кровати',      'img' => 'bedroom_010001.jpg' ],
    [ 'slug' => 'dresser',   'label' => 'Комоды',       'img' => 'bedroom_020002.jpg' ],
    [ 'slug' => 'storage',   'label' => 'Стеллажи',     'img' => 'living_room_030000.jpg' ],
    [ 'slug' => 'hallway',   'label' => 'Обувницы',     'img' => 'hallway_020000.jpg' ],
    [ 'slug' => 'office',    'label' => 'Столы',        'img' => 'kitchen_030000.jpg' ],
    [ 'slug' => 'bedside',   'label' => 'Тумбы',        'img' => 'bedroom_020002.jpg' ],
];

$current_cat = isset( $_GET['category'] ) ? sanitize_text_field( $_GET['category'] ) : 'all';
?>

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
            <?php foreach ( $categories as $cat ) :
                $active = ( $cat['slug'] === $current_cat ) ? ' cat-circle-item--active' : '';
            ?>
            <button class="cat-circle-item<?php echo esc_attr( $active ); ?>" data-cat="<?php echo esc_attr( $cat['slug'] ); ?>">
                <div class="cat-circle-item__img">
                    <img src="<?php echo $u; ?>/img/<?php echo esc_attr( $cat['img'] ); ?>" alt="<?php echo esc_attr( $cat['label'] ); ?>">
                </div>
                <span><?php echo esc_html( $cat['label'] ); ?></span>
            </button>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============ CATALOG GRID ============ -->
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
                    $product_cat   = '';
                    $terms         = get_the_terms( get_the_ID(), 'novacraft_product_cat' );
                    if ( $terms && ! is_wp_error( $terms ) ) {
                        $product_cat = $terms[0]->slug;
                    }
                    $price = get_post_meta( get_the_ID(), '_novacraft_price', true );
                    $badge = get_post_meta( get_the_ID(), '_novacraft_badge', true );
            ?>
            <a href="<?php the_permalink(); ?>" class="catalog-card" data-cat="<?php echo esc_attr( $product_cat ); ?>">
                <div class="catalog-card__image">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( 'medium_large', [ 'loading' => 'lazy', 'alt' => get_the_title() ] ); ?>
                    <?php else : ?>
                        <img src="<?php echo $u; ?>/img/kitchen_010000.jpg" alt="<?php the_title_attribute(); ?>" loading="lazy">
                    <?php endif; ?>
                    <?php if ( $badge ) : ?>
                        <span class="catalog-card__badge"><?php echo esc_html( $badge ); ?></span>
                    <?php endif; ?>
                </div>
                <div class="catalog-card__body">
                    <h3 class="catalog-card__title"><?php the_title(); ?></h3>
                    <?php if ( $price ) : ?>
                        <div class="catalog-card__price"><?php echo esc_html( $price ); ?></div>
                    <?php endif; ?>
                </div>
            </a>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
            ?>
            <div id="catalogEmpty" style="text-align: center; padding: var(--space-3xl) 0; color: var(--color-text-muted);">
                По вашему запросу ничего не найдено.
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_template_part( 'template-parts/contact-section' ); ?>

<?php get_footer(); ?>
